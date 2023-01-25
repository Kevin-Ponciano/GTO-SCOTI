<?php

namespace App\Traits\Jetstream;

use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Jetstream\OwnerRole;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\Jetstream;

trait HasTeams
{
    /**
     * Determine if the given team is the current team.
     *
     * @param mixed $team
     * @return bool
     */
    public function isCurrentTeam($team)
    {
        return $team->id === $this->currentTeam->id;
    }

    /**
     * Get the current team of the user's context.
     *
     * @return BelongsTo
     */
    public function currentTeam()
    {
//        if (is_null($this->current_team_id) && $this->id) {
//            $this->switchTeam($this->personalTeam());
//        }
        return $this->belongsTo(Jetstream::teamModel(), 'current_team_id');
    }

    /**
     * Switch the user's context to the given team.
     *
     * @param mixed $team
     * @return bool
     */
    public function switchTeam($team)
    {
        if (!$this->belongsToTeam($team)) {
            return false;
        }

        $this->forceFill([
            'current_team_id' => $team->id,
        ])->save();

        $this->setRelation('currentTeam', $team);

        return true;
    }

    /**
     * Determine if the user belongs to the given team.
     *
     * @param mixed $team
     * @return bool
     */
    public function belongsToTeam($team)
    {
        if (is_null($team)) {
            return false;
        }

        return $this->ownsTeam($team) || $this->teams->contains(function ($t) use ($team) {
                return $t->id === $team->id;
            });
    }

    /**
     * Determine if the user owns the given team.
     *
     * @param mixed $team
     * @return bool
     */
    public function ownsTeam($team)
    {
        if (is_null($team)) {
            return false;
        }

        return $this->id == $team->{$this->getForeignKey()};
    }

    /**
     * Get the user's "personal" team.
     *
     * @return Team
     */
    public function personalTeam()
    {
        return $this->ownedTeams->where('personal_team', true)->first();
    }

    /**
     * Get all of the teams the user owns or belongs to.
     *
     * @return Collection
     */
    public function allTeams()
    {
        return $this->ownedTeams->merge($this->teams)->sortBy('name');
    }

    /**
     * Get all of the teams the user owns.
     *
     * @return HasMany
     */
    public function ownedTeams()
    {
        return $this->hasMany(Jetstream::teamModel());
    }

    /**
     * Get all of the teams the user belongs to.
     *
     * @return BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Jetstream::teamModel(), Jetstream::membershipModel())
            ->withPivot('role')
            ->withTimestamps()
            ->as('membership');
    }

    /**
     * Determine if the user has the given role on the given team.
     *
     * @param mixed $team
     * @param string $role
     * @return bool
     */
    public function hasTeamRole($team, string $role)
    {
        if ($this->ownsTeam($team)) {
            return true;
        }

        return $this->belongsToTeam($team) && optional(Jetstream::findRole($team->users->where(
                'id', $this->id
            )->first()->membership->role))->key === $role;
    }

    /**
     * Determine if the user has the given permission on the given team.
     *
     * @param mixed $team
     * @param string $permission
     * @return bool
     */
    public function hasTeamPermission($team, string $permission)
    {
        if ($this->ownsTeam($team)) {
            return true;
        }

        if (!$this->belongsToTeam($team)) {
            return false;
        }

        if (in_array(HasApiTokens::class, class_uses_recursive($this)) &&
            !$this->tokenCan($permission) &&
            $this->currentAccessToken() !== null) {
            return false;
        }

        $permissions = $this->teamPermissions($team);

        return in_array($permission, $permissions) ||
            in_array('*', $permissions) ||
            (Str::endsWith($permission, ':create') && in_array('*:create', $permissions)) ||
            (Str::endsWith($permission, ':update') && in_array('*:update', $permissions));
    }

    /**
     * Get the user's permissions for the given team.
     *
     * @param mixed $team
     * @return array
     */
    public function teamPermissions($team)
    {
        if ($this->ownsTeam($team)) {
            return ['*'];
        }

        if (!$this->belongsToTeam($team)) {
            return [];
        }

        return (array)optional($this->teamRole($team))->permissions;
    }

    /**
     * Get the role that the user has on the team.
     *
     * @param mixed $team
     * @return OwnerRole
     */
    public function teamRole($team)
    {
        if ($this->ownsTeam($team)) {
            return new OwnerRole;
        }

        if (!$this->belongsToTeam($team)) {
            return;
        }

        $role = $team->users
            ->where('id', $this->id)
            ->first()
            ->membership
            ->role;

        return $role ? Jetstream::findRole($role) : null;
    }
}
