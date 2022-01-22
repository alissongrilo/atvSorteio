<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/grupoSorteio', [App\Http\Controllers\GrupoSorteioController::class, 'index']);
Route::get('/grupoSorteio/novo', [App\Http\Controllers\GrupoSorteioController::class, 'create']);
Route::post('/grupoSorteio', [App\Http\Controllers\GrupoSorteioController::class, 'store']);
Route::get('/grupoSorteio/editar/{id}', [App\Http\Controllers\GrupoSorteioController::class, 'edit']);
Route::post('/grupoSorteio/{id}', [App\Http\Controllers\GrupoSorteioController::class, 'update']);
Route::get('/grupoSorteio/apagar/{id}', [App\Http\Controllers\GrupoSorteioController::class, 'destroy']);
Route::get('/grupoSorteio/sortear/{id}', [App\Http\Controllers\GrupoSorteioController::class, 'sortear']);
Route::get('/grupoSorteio/deletarSorteio/{id}', [App\Http\Controllers\GrupoSorteioController::class, 'deletarSorteio']);

Route::get('/membro/{id}', [App\Http\Controllers\MembroController::class, 'index']);
Route::get('/membro/inscrever/{id}', [App\Http\Controllers\MembroController::class, 'create']);
Route::post('/membro/{id}', [App\Http\Controllers\MembroController::class, 'store']);
Route::get('/membro/editar/{id}', [App\Http\Controllers\MembroController::class, 'edit']);
Route::post('/membro/atualizar/{id}', [App\Http\Controllers\MembroController::class, 'update']);
Route::get('/membro/apagar/{id}', [App\Http\Controllers\MembroController::class, 'destroy']);
Route::get('/membro/verAmigo/{id}', [App\Http\Controllers\MembroController::class, 'verAmigo']);