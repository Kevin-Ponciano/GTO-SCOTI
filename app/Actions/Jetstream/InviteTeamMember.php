<?php

namespace App\Actions\Jetstream;

use App\Mail\TeamInvitation;
use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Contracts\InvitesTeamMembers;
use Laravel\Jetstream\Events\InvitingTeamMember;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;

class InviteTeamMember implements InvitesTeamMembers
{
    /**
     * Invite a new team member to the given team.
     *
     * @param mixed $user
     * @param mixed $team
     * @param string $email
     * @param string|null $role
     * @return void
     * @throws AuthorizationException
     */
    public function invite($user, $team, string $email, string $role = null)
    {
        #Gate::forUser($user)->authorize('addTeamMember', $team);

        $this->validate($team, $email, $role);

        InvitingTeamMember::dispatch($team, $email, $role);

        $invitation = $team->teamInvitations()->create([
            'email' => $email,
            'role' => $role,
        ]);

        Mail::to($email)->send(new TeamInvitation($invitation));
    }

    /**
     * Validate the invite member operation.
     *
     * @param mixed $team
     * @param string $email
     * @param string|null $role
     * @return void
     */
    protected function validate($team, string $email, ?string $role)
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules($team), [
            'email.unique' => __('This user has already been invited to the team.'),
        ])->after(
            $this->ensuringThatTheUserHasNoTeam($email)
        )->validateWithBag('addTeamMember');
    }

    /**
     * Get the validation rules for inviting a team member.
     *
     * @param mixed $team
     * @return array
     */
    protected function rules($team)
    {
        return array_filter([
            'email' => ['required', 'email', Rule::unique('team_invitations')->where(function ($query) use ($team) {
                $query->where('team_id', $team->id);
            })],
            'role' => Jetstream::hasRoles()
                ? ['required', 'string', new Role]
                : null,
        ]);
    }

    /**
     * Ensure that the user is not already on the team.
     *
     * @param mixed $team
     * @param string $email
     * @return Closure
     */
    protected function ensureUserIsNotAlreadyOnTeam($team, string $email)
    {
        return function ($validator) use ($team, $email) {
            $validator->errors()->addIf(
                $team->hasUserWithEmail($email),
                'email',
                __('This user already belongs to the team.')
            );
        };
    }

    protected function ensuringThatTheUserHasNoTeam(string $email)
    {
        return function ($validator) use ($email) {
            $validator->errors()->addIf(
                $this->userExist($email),
                'email',
                __('Este usuário já pertence à uma empresa.')
            );
        };
    }

    private function userExist(string $email){
        $user = User::where('email','=',$email)->first();
        if($user == null){
            return false;
        }elseif($user->teams->count() == 0){
            return false;
        }else{
            return true;
        }
    }
}
