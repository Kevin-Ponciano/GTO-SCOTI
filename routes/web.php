<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Enterprise;
use App\Http\Livewire\TaskDetail;
use App\Http\Livewire\Tasks;
use App\Http\Livewire\Users;
use App\Http\Livewire\UserTask;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(callback: function () {
    Route::get('dashboard/', Dashboard::class)->name('dashboard');
    Route::redirect('/', 'dashboard/');

    Route::get('/perfil', function () {
        return view('profile.show');
    })->name('profile');

    Route::get('minhas-tarefas/', UserTask::class)->name('user-tasks');
    Route::get('tarefas/', Tasks::class)->name('tasks');
    Route::get('tarefas/{task_id}', TaskDetail::class)->name('task_detail');

    Route::get('enterprise', Enterprise::class)->name('enterprise');
    Route::get('users', Users::class)->name('users');

    Route::get('/navi', function () {
        return view('navigation-menu');
    });


});
