<?php

use App\Http\Controllers\RolesPermisosController;

use App\Http\Controllers\administrativoController;
use App\Http\Controllers\agendaController;
use App\Http\Controllers\bitacoraController;
use App\Http\Controllers\citaController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\sectorController;
use App\Http\Controllers\turnoController;
use App\Http\Controllers\turnoDoctorController;
use App\Http\Controllers\doctorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\especialidadController;
use App\Models\sector;
use App\Models\turnoDoctor;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

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
    Route::delete('/roles/destroy/{rol}','destroy')->name('roles.destroy');

    Route::get('/roles/revocar/rol','revocar')->name('roles.revocar');
    Route::get('/roles/revocar/rol/usuario','revocarRolAUsuario')->name('roles.revocar.usuario');
    Route::post('/roles/revocar/rol/store','revocarRoles')->name('roles.revocar.store');
});
Route::controller(turnoController::class)->group(function(){
    Route::get('/turno/index','index')->name('turno.index');
    Route::get('/turno/create','create')->name('turno.create');
    Route::post('/turno/store','store')->name('turno.store');
    Route::get('/turno/show/{turno}','show')->name('turno.show');
    Route::get('/turno/edit/{turno}','edit')->name('turno.edit');
    Route::post('/turno/update/{turno}','update')->name('turno.update');
    Route::delete('/turno/destroy/{turno}','destroy')->name('turno.destroy');
});
Route::controller(turnoDoctorController::class)->group(function(){
    Route::get('/turno-doctor/asigna/{doctor}r','asignar')->name('turno-doctor.asignar');
    Route::post('/turno-doctor/store/{doctor}','store')->name('turno-doctor.store');
    Route::get('/turno-doctor/show/{doctor}','show')->name('turno-doctor.show');
    Route::delete('/turno-doctor/destroy/{turno_doctor}','destroy')->name('turno-doctor.destroy');
});

Route::controller(agendaController::class)->group(function(){
    Route::get('/agenda/index','index')->name('agenda.index');
    Route::get('/agenda/show/{doctor}','show')->name('agenda.show');
    Route::get('/agenda/create/{doctor}','create')->name('agenda.create');
    Route::post('/agenda/store/{doctor}','store')->name('agenda.store');
    Route::get('/agenda/ver-cupos/{doctor}/{agenda}','verCupos')->name('agenda.ver-cupos');
    
});

Route::controller(citaController::class)->group(function(){
    //rutas para administrativos
    Route::get('/cita/index/{cupo}','index')->name('cita.index');
    Route::get('/cita/create/{cupo}','create')->name('cita.create');
    Route::post('/cita/store/{cupo}','store')->name('cita.store');
    Route::get('/cita/confirmar/{cupo}','confirmarCita')->name('cita.confirmar');
    Route::get('/cita/show/{cupo}','show')->name('cita.show');
    // rutas para pacientes
    Route::get('/cita/paciente/reservar','reservarCitaPaciente')->name('cita.paciente.reservar');
    Route::post('/cita/paciente/reservar/store','seleccionarEspecialidad')->name('cita.paciente.reservar.store');
    Route::get('/cita/paciente/reservar/doctor/{especialidad}','verDoctorEspecialidad')->name('cita.paciente.reservar.doctor');
    Route::get('/cita/paciente/reservar/ver-agenda','verAgenda')->name('cita.paciente.reservar.agenda');
    Route::get('/cita/paciente/reservar/ver-cupo','verCupo')->name('cita.paciente.reservar.cupo');
    Route::post('/cita/paciente/reservar/confirmar','confirmarReserva')->name('cita.paciente.reservar.confirmar');
    Route::get('/cita/paciente/mis-citas','verMiscitas')->name('cita.paciente.verCitas');
    //rutas para medico
    Route::get('/cita/medico/ver-agenda/{fecha?}','verAgendaMedico')->name('cita.medico.verAgenda');
});

Route::controller(bitacoraController::class)->group(function(){
    Route::get('/bitacora','index')->name('bitacora.index');
    Route::get('/bitacora/show/{bitacora}','show')->name('bitacora.show');
});
/*---------------------------------Modulo Ambientes------------------------------*/
Route::controller(sectorController::class)->group(function(){
    Route::get('sector/index','index')->name('sector.index');
});

/*-----------------------GP----------------------------------------------------- */
Route::get('/',function(){ return redirect()->route('login'); })->name('welcome');
Route::view('/menu', 'menu')->name('home')->middleware('auth');
Route::view('/login','login')->name('login')->middleware('guest');

Route::post('/login', [UserController::class, 'login']);

//Route::get('/login', [UserController::class, 'loginView'])->name('login.view')->middleware('guest:admin');
//Route::post('/login', [UserController::class, 'login'])->name('login')->middleware('guest:admin');

Route::middleware('auth')->group(function(){
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    //Route::post('/logout',[UserController::class,'logout'])->name('logout');
 
    //Route::get('/menu', [UserController::class, 'menu'])->name("menu");

    // Gestionar Usuario
    Route::get('/usuario', [UserController::class, 'index'])->name('usuario.index');  
    //Route::post('usuario.store', [UserController::class, 'store'])->name('usuario.store');
    Route::get('usuario.show/{usuario}',[UserController::class,'show'])->name('usuario.show');
    Route::get('usuario.edit/{usuario}', [UserController::class, 'edit'])->name('usuario.edit');
    Route::put('usuario.update/{usuario}', [UserController::class, 'update'])->name('usuario.update');
    route::delete('usuario.destroy/{usuario}', [UserController::class, 'destroy'])->name('usuario.destroy');

    //Personal administrativo
    Route::get('/administrativo', [administrativoController::class, 'index'])->name('administrativo.index');
    Route::get('administrativo.create', [administrativoController::class, 'create'])->name('administrativo.create');   
    Route::post('administrativo.store', [administrativoController::class, 'store'])->name('administrativo.store');
    Route::get('administrativo.show/{administrativo}', [administrativoController::class, 'show'])->name('administrativo.show');
    Route::get('administrativo.edit/{administrativo}', [administrativoController::class, 'edit'])->name('administrativo.edit');
    Route::put('administrativo.update/{administrativo}', [administrativoController::class, 'update'])->name('administrativo.update');
    Route::delete('administrativo.destroy/{administrativo}', [administrativoController::class, 'destroy'])->name('administrativo.destroy');
  
    //Gestionar paciente
    Route::get('/paciente', [pacienteController::class, 'index'])->name('paciente.index');
    Route::get('paciente.create', [pacienteController::class, 'create'])->name('paciente.create');   
    Route::post('paciente.store', [pacienteController::class, 'store'])->name('paciente.store');
    Route::get('paciente.show/{paciente}', [pacienteController::class, 'show'])->name('paciente.show');
    Route::get('paciente.edit/{paciente}', [pacienteController::class, 'edit'])->name('paciente.edit');
    Route::put('paciente.update/{paciente}', [pacienteController::class, 'update'])->name('paciente.update'); 
    Route::delete('paciente.destroy/{paciente}', [pacienteController::class, 'destroy'])->name('paciente.destroy');
});
 //Gestionar Doctores
 Route::get('/doctores', [doctorController::class, 'index'])->name('doctores.index');
 Route::get('/doctores.create', [doctorController::class, 'create'])->name('doctores.create');
 Route::get('doctores.show/{id_doctor}',[doctorController::class, 'show'])->name('doctores.show');
 Route::post('doctores', [doctorController::class, 'store'])->name('doctores.store');
 Route::get('doctores/{id_doctor}/edit', [doctorController::class, 'edit'])->name('doctores.edit');
 Route::delete('doctores.destroy/{id_doctor}', [doctorController::class, 'destroy'])->name('doctores.destroy');
 Route::put('doctores.update/{id_doctor}', [doctorController::class, 'update'])->name('doctores.update');

 //especialidades
 Route::get('/especialidad', [doctorController::class, 'index'])->name('especialidad.index');
 Route::get('/especialidad.create',[especialidadController::class, 'create'])->name('especialidad.create');