<?php

use App\Http\Controllers\RolesPermisosController;

use App\Http\Controllers\administrativoController;
use App\Http\Controllers\agendaController;
use App\Http\Controllers\citaController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\turnoDoctorController;
use App\Http\Controllers\UserController;
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
});
Route::controller(TurnoController::class)->group(function(){
    Route::get('/turno/index','index')->name('turno.index');
    Route::get('/turno/create','create')->name('turno.create');
    Route::post('/turno/store','store')->name('turno.store');
    Route::get('/turno/show/{turno}','show')->name('turno.show');
    Route::get('/turno/edit/{turno}','edit')->name('turno.edit');
    Route::post('/turno/update/{turno}','update')->name('turno.update');
    Route::delete('/turno/destroy/{turno}','destroy')->name('turno.destroy');
});
Route::controller(turnoDoctorController::class)->group(function(){
    //Route::get('/turno-doctor/index','index')->name('turno-doctor.index');
    Route::get('/turno-doctor/asigna/{doctor}r','asignar')->name('turno-doctor.asignar');
    Route::post('/turno-doctor/store/{doctor}','store')->name('turno-doctor.store');
    Route::get('/turno-doctor/show/{doctor}','show')->name('turno-doctor.show');
    //Route::get('/turno-doctor/edit/{turno}/{doctor}','edit')->name('turno-doctor.edit');
    //Route::post('/turno-doctor/update/{turno_doctor}','update')->name('turno-doctor.update');
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
    //Route::post('/cita/store-confirmar/{cupo}','storeConfirmarCita')->name('cita.store-confirmar');
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
