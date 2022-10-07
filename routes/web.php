<?php

use App\Http\Controllers\RolesPermisosController;

use App\Http\Controllers\administrativoController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\UserController;

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

Route::controller(RolesPermisosController::class)->group(function(){
    Route::get('/roles/index', 'index')->name('roles.index');
    Route::get('/roles/create','create')->name('roles.create');
    Route::post('/roles/store','store')->name('roles.store');
    Route::get('/roles/show/{rol}','show')->name('roles.show');
    Route::get('/roles/asignar-rol','asignarRol')->name('roles.asignar-rol');
    Route::post('/roles/store-asignar-rol','storeAsignarRol')->name('roles.store-asignar-rol');
    Route::get('/roles/edit/{rol}','edit')->name('roles.edit');
    Route::post('/roles/update/{rol}','update')->name('roles.update');
    Route::get('/roles/destroy/{rol}','destroy')->name('roles.destroy');
});
/*---------------------------------------------------------------------------- */
Route::get('/login', [UserController::class, 'loginView'])->name('login.view')->middleware('guest:admin');
Route::post('/login', [UserController::class, 'login'])->name('login')->middleware('guest:admin');

Route::middleware('auth:admin')->group(function(){
    Route::post('/logout',[UserController::class,'logout'])->name('logout');
 
    Route::get('/menu', [UserController::class, 'menu'])->name("menu");

    // Gestionar Usuario
    Route::get('/usuario', [UserController::class, 'index'])
    ->name('usuario.index');  
    route::get('usuario.edit/{id_persona}', [UserController::class, 'edit'])
    ->name('usuario.edit');
    route::post('usuario.store', [UserController::class, 'store'])
    ->name('usuario.store');
    route::delete('usuario.destroy/{id_persona}', [UserController::class, 'destroy'])
    ->name('usuario.destroy');
    route::put('usuario.update/{id_persona}', [UserController::class, 'update'])
    ->name('usuario.update');

    //Personal administrativo
    Route::get('/administrativo', [administrativoController::class, 'index'])
    ->name('administrativo.index');
    Route::get('administrativo.create', [administrativoController::class, 'create'])
    ->name('administrativo.create');   
    route::get('administrativo.edit/{id_persona}', [administrativoController::class, 'edit'])
    ->name('administrativo.edit');
    route::post('administrativo.store', [administrativoController::class, 'store'])
    ->name('administrativo.store');
    route::delete('administrativo.destroy/{id_persona}', [administrativoController::class, 'destroy'])
    ->name('administrativo.destroy');
    route::put('administrativo.update/{id_persona}', [administrativoController::class, 'update'])
    ->name('administrativo.update');

    //Gestionar paciente
    Route::get('/paciente', [pacienteController::class, 'index'])
    ->name('paciente.index');
    Route::get('paciente.create', [pacienteController::class, 'create'])
    ->name('paciente.create');   
    route::get('paciente.edit/{id_persona}', [pacienteController::class, 'edit'])
    ->name('paciente.edit');
    route::post('paciente.store', [pacienteController::class, 'store'])
    ->name('paciente.store');
    route::delete('paciente.destroy/{id_persona}', [pacienteController::class, 'destroy'])
    ->name('paciente.destroy');
    route::put('paciente.update/{id_persona}', [pacienteController::class, 'update'])
    ->name('paciente.update'); 
    
});
