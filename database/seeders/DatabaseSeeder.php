<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Contracts\AddsTeamMembers;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $password = env('app_env') == 'local' ? 'ponciano' : 'HiwnPy4G#f3m%sB&nv5pZn';
        $user = User::factory()->create(['name' => 'Kevin', 'email' => 'kevinmonteiro2014@live.com', 'password' => Hash::make($password), 'role' => 'admin']);
        $team = Team::factory()->create(['user_id' => $user->id, 'name' => 'SCOTI Sistemas', 'personal_team' => 0]);

    }
}
