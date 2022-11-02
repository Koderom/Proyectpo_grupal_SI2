<?php

use App\Http\Controllers\RolesPermisosController;

use App\Http\Controllers\administrativoController;
use App\Http\Controllers\agendaController;
use App\Http\Controllers\asignacionConsultorioController;
use App\Http\Controllers\bitacoraController;
use App\Http\Controllers\citaController;
use App\Http\Controllers\consultaController;
use App\Http\Controllers\consultorioController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\sectorController;
use App\Http\Controllers\turnoController;
use App\Http\Controllers\turnoDoctorController;
use App\Http\Controllers\doctorController;
use App\Http\Controllers\internacionController;
use App\Http\Controllers\quirofanoController;
use App\Http\Controllers\salaController;
use App\Http\Controllers\tipoInternacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\especialidadController;
use App\Http\Controllers\hojaConsultaController;
use App\Http\Controllers\medicamentoController;
use App\Http\Controllers\medicamentoRecetaController;
use App\Http\Controllers\recetaController;
use App\Http\Controllers\reservaQuirofanoController;
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
    Route::get('sector/create', 'create')->name('sector.create');
    Route::post('sector/store', 'store')->name('sector.store');
    Route::get('sector/edit/{sector}', 'edit')->name('sector.edit');
    Route::put('sector/update/{sector}', 'update')->name('sector.update');
    Route::delete('sector/delete/{sector}','destroy')->name('sector.destroy');
});
Route::controller(salaController::class)->group(function(){
    Route::get('sala/index','index')->name('sala.index');
    Route::get('sala/create', 'create')->name('sala.create');
    Route::post('sala/store', 'store')->name('sala.store');
    Route::get('salas/ver-mas/{sala}','verMas')->name('sala.verMas');
});
Route::controller(consultorioController::class)->group(function(){
    Route::get('consultorio/index', 'index')->name('consultorio.index');
    Route::get('consultorio/create','create')->name('consultorio.create');
    Route::post('consultorio/store','store')->name('consultorio.store');
    Route::get('consultorio/show/{sala}', 'show')->name('consultorio.show');
    Route::get('consultorio/edit/{sala}','edit')->name('consultorio.edit');
    Route::put('consultorio/update/{sala}','update')->name('consultorio.update');
    Route::delete('consultorio/destroy/{sala}', 'destroy')->name('consultorio.destroy');
});
Route::controller(asignacionConsultorioController::class)->group(function(){
    Route::get('asignacionConsultorio/create','create')->name('asignacionConsultorio.create');
    Route::post('asignacionConsultorio/store','store')->name('asignacionConsultorio.store');
    Route::delete('asignacionConsultorio/destroy/{asignacionConsultorio}','destroy')->name('asignacionConsultorio.destroy');
});
Route::controller(quirofanoController::class)->group(function(){
    Route::get('quirofano/index', 'index')->name('quirofano.index');
    Route::get('quirofano/create','create')->name('quirofano.create');
    Route::post('quirofano/store','store')->name('quirofano.store');
    Route::get('quirofano/show/{sala}', 'show')->name('quirofano.show');    
});
Route::controller(reservaQuirofanoController::class)->group(function(){
    Route::get('reservarQuirofano/create','create')->name('reservarQuirofano.create');
    Route::post('reservarQuirofano/store','store')->name('reservarQuirofano.store');
    Route::get('reservarQuirofano/show/{reservarQuirofano}','show')->name('reservarQuirofano.show');
    Route::post('reservaQuirofano/agregar/{reservarQuirofano}','agregarDoctor')->name('reservarQuirofano.agregar');
    Route::delete('reservaQuirofano/eliminar/{doctorQuirofano}','doctorQuirofanoEliminar')->name('reservarQuirofano.eliminar');
});
Route::controller(internacionController::class)->group(function(){
    Route::get('internacion/index', 'index')->name('internacion.index');
    Route::get('internacion/show/{sala}', 'show')->name('internacion.show');
    Route::get('internacion/internar-paciente', 'internarPaciente')->name('internacion.internarPaciente');
    Route::post('internacion/internar-paciente/store','internarPacienteStore')->name('internacion.internarPaciente.store');
    Route::get('internacion/paciente/retirar/{paciente}','retirarPaciente')->name('internacion.paciente.retirar');
    Route::get('internacion/create','create')->name('internacion.create');
    Route::post('internacion/store','store')->name('internacion.store');
    Route::delete('internacion/delete/{sala}','destroy')->name('internacion.destroy');
});
Route::controller(tipoInternacionController::class)->group(function(){
    Route::post('tipoInternacion/store','store')->name('tipoInternacion.store');
});
/*-----------------------GP----------------------------------------------------- */

Route::get('/',function(){ return redirect()->route('login'); })->name('welcome')->middleware('guest');
Route::view('/home', 'menu')->name('home')->middleware('auth');
Route::view('/login','login')->name('login')->middleware('guest');

Route::post('/login-user', [UserController::class, 'login']);

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

    //Consulta
    Route::get('/consulta', [consultaController::class, 'index'])->name('consulta.index');
    Route::post('consulta.store', [consultaController::class, 'store'])->name('consulta.store');
    
    
    //Hoja de consulta
    Route::get('/hojaconsulta', [hojaConsultaController::class, 'index'])->name('hojaconsulta.index');//cambiar a hoja de consulta
    Route::post('hojaconsulta.store', [consultaController::class, 'store'])->name('hojaconsulta.store');      
    //receta
    Route::post('receta.store', [recetaController::class, 'store'])->name('receta.store');
    
    //Medicamento-receta 
    Route::get('medicamentoReceta', [medicamentoRecetaController::class, 'index'])->name('receta.medicamento.index'); 
    Route::post('medicamento.store', [medicamentoRecetaController::class, 'store'])->name('receta.medicamento.store');
    //Medicamento
    Route::post('medicamento.store',[medicamentoController::class,'store'])->name('medicamento.store');
    
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


 Route::get('/especialidad', [especialidadController::class, 'index'])->name('especialidad.index');
 Route::get('/especialidad.create',[especialidadController::class, 'create'])->name('especialidad.create');
 Route::post('/especialidad.store',[especialidadController::class, 'store'])->name('especialidad.store');
 Route::DELETE('/especialidad/{id}/destroy',[especialidadController::class, 'destroy'])->name('especialidad.destroy');
 Route::get('/especialidad/{id}/edit',[especialidadController::class, 'edit'])->name('especialidad.edit');
 Route::put('/especialidad/{especialidad}/update',[especialidadController::class, 'update'])->name('especialidad.update');
 
