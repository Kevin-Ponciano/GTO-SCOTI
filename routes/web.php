<?php

use App\Http\Controllers\RedirectHomeController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Enterprise;
use App\Http\Livewire\NewUser;
use App\Http\Livewire\ScheduledTasks;
use App\Http\Livewire\TaskDetail;
use App\Http\Livewire\Tasks;
use App\Http\Livewire\Users;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(callback: function () {
    Route::get('/', [RedirectHomeController::class,'index'])->name('home');

    Route::get('dashboard/', Dashboard::class)->middleware(['dashboardAccess', config('jetstream.auth_session'), 'verified'])->name('dashboard');

    Route::middleware(['masterManager'])->group(callback: function () {
        Route::get('usuarios', Users::class)->name('users');
        Route::get('empresas', Enterprise::class)->name('enterprises');

    });

    Route::get('tarefas/', Tasks::class)->name('tasks');
    #Route::get('tarefas-agendadas/', ScheduledTasks::class)->name('tasks-scheduled');
    Route::get('tarefas/{task_id}', TaskDetail::class)->name('task_detail');

    Route::post('redefine-password/', [PasswordResetLinkController::class, 'store'])->name('redefine-password');
});

Route::get('register/{email}', [RegisteredUserController::class, 'create'])->middleware(['guest:' . config('fortify.guard')])->name('registerWithEmail');

Route::post('register', [RegisteredUserController::class, 'store'])->middleware(['guest:' . config('fortify.guard')]);

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware(['guest:' . config('fortify.guard')])->name('password.email');
