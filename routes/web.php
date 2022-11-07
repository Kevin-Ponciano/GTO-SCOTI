<?php

use App\Http\Controllers\TasksController;
use App\Http\Livewire\TaskDetail;
use App\Http\Livewire\Tasks;
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
    Route::get('/', function () {
        return view('components.dashboard');
    })->name('dashboard');

    Route::get('tarefas/', Tasks::class)->name('tasks');
    // Route::post('tarefas', Tasks::class);
    Route::get('tarefas/{task_id}', TaskDetail::class)->name('task_detail');


    Route::get('/perfil', function () {
        return view('profile.show');
    })->name('profile');


});
Route::get('/reg', function () {
    return view('auth.register');
});
