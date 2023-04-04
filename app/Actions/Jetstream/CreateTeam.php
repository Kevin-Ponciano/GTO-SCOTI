<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;

class CreateTeam implements CreatesTeams
{
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Obrigatório',
            'cnpj.required' => 'Obrigatório',
            'cnpj'.'unique' => 'CNPJ Cadastrado no Sistema'
        ];
    }

    /**
     * Validate and create a new team for the given user.
     *
     * @param mixed $user
     * @param array $input
     * @return mixed
     */
    public function create($user, array $input)
    {
        Gate::forUser($user)->authorize('create', Jetstream::newTeamModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'unique:teams,cnpj']
        ])->validateWithBag('createTeam');

        AddingTeam::dispatch($user);

        return $user->ownedTeams()->create([
            'name' => $input['name'],
            'personal_team' => false,
            'cnpj' => $input['cnpj']
        ]);
    }
}
