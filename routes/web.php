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

Route::get('/participante/{id}', [App\Http\Controllers\ParticipanteController::class, 'index']);
Route::get('/participante/inscrever/{id}', [App\Http\Controllers\ParticipanteController::class, 'create']);
Route::post('/participante/{id}', [App\Http\Controllers\ParticipanteController::class, 'store']);
Route::get('/participante/editar/{id}', [App\Http\Controllers\ParticipanteController::class, 'edit']);
Route::post('/participante/atualizar/{id}', [App\Http\Controllers\ParticipanteController::class, 'update']);
Route::get('/participante/apagar/{id}', [App\Http\Controllers\ParticipanteController::class, 'destroy']);
Route::get('/participante/verAmigo/{id}', [App\Http\Controllers\ParticipanteController::class, 'verAmigo']);