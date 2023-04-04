<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Jetstream::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('employer', 'Colaborador', [
        ])->description('Possui permissão somente para interagir com as tarefas e finalizar a mesma');

        Jetstream::role('manager', 'Diretor', [
            'manager',
            'filterTasks',
            'dashboard',
            'read',
        ])->description('Responsável por acompanhar o andamento das demandas através do dashboard e solicitar a abertura de tarefas');

        Jetstream::role('masterManager', 'Gestor Master', [
            'managerTasks',
            'manager',
            'filterTasks',
            'managerUsers',
            'dashboard',
            'read',
            'update',
            'create',
            'addTeamMember',
            'updateTeamMember',
            'removeTeamMember',
        ])->description('Responsável para abrir, delegar e validar as tarefas.');

        Jetstream::role('admin', 'Administrador do Sistema', [
            'managerTasks',
            'manager',
            'filterTasks',
            'managerUsers',
            'dashboard',
            'read',
            'update',
            'create',
            'addTeamMember',
            'updateTeamMember',
            'removeTeamMember',
        ])->description('Os usuários administradores podem executar qualquer ação.');

    }

}
