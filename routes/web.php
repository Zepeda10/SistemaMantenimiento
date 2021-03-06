<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TelecomunicacionController;
use App\Http\Controllers\VerificacionController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\CronogramaPreventivoController;
use App\Http\Controllers\CalendarioPreventivoController;
use App\Http\Controllers\CalendarioCorrectivoController;
use App\Http\Controllers\CorrectivoController;
use App\Http\Controllers\OrdenCorrectivoController;
use App\Http\Controllers\PreventivosController;
use App\Http\Controllers\GraficaController;
use App\Http\Controllers\EquipoController;

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
    return redirect('/login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::resource('admin/solicitudes',RegistroController::class);
Route::resource('admin/usuarios',UserController::class);
Route::resource('admin/telecomunicaciones',TelecomunicacionController::class);
Route::resource('admin/verificaciones',VerificacionController::class);
Route::resource('admin/ordenes',OrdenController::class);
Route::resource('admin/oficios',CronogramaPreventivoController::class);
Route::resource('admin/correctivo',CorrectivoController::class);
Route::resource('admin/orden-correctivo',OrdenCorrectivoController::class);
Route::resource('admin/graficos',GraficaController::class);
Route::resource('admin/equipos',EquipoController::class);

Route::get('admin/internet', [TelecomunicacionController::class, 'internet'])->name('admin.internet'); 
Route::get('admin/correo', [TelecomunicacionController::class, 'correo'])->name('admin.correo'); 
Route::get('admin/telefono', [TelecomunicacionController::class, 'telefono'])->name('admin.telefono'); 

Route::get('admin/agregar-internet', [TelecomunicacionController::class, 'formInternet'])->name('jefe.internet'); 
Route::get('admin/agregar-correo', [TelecomunicacionController::class, 'formCorreo'])->name('jefe.correo'); 
Route::get('admin/agregar-telefono', [TelecomunicacionController::class, 'formTelefono'])->name('jefe.telefono'); 

Route::get('admin/ver-solicitudes', [TelecomunicacionController::class, 'verSolicitudes'])->name('admin.versolicitudes'); 
Route::get('admin/solicitudes-atendidas', [TelecomunicacionController::class, 'verAtendidas'])->name('admin.veratendidas'); 

Route::get('admin/atendidas-correo', [TelecomunicacionController::class, 'atendidoCorreo'])->name('admin.atencorreo');
Route::get('admin/atendidas-internet', [TelecomunicacionController::class, 'atendidoInternet'])->name('admin.ateninternet');
Route::get('admin/atendidas-telefono', [TelecomunicacionController::class, 'atendidoTelefono'])->name('admin.atentelefono');
Route::get('admin/atendidas-eliminar', [TelecomunicacionController::class, 'eliminaAtendida'])->name('admin.eliminatendida');

Route::get('admin/cronograma', [CalendarioPreventivoController::class, 'index'])->name('admin.cronograma'); 
Route::get('admin/cronograma/{month}', [CalendarioPreventivoController::class, 'index_month'])->name('admin.mes');

Route::get('admin/lista-correctivos', [CorrectivoController::class, 'correctivos'])->name('correctivo.listacorrectivo'); 

Route::get('admin/cronograma-correctivo', [CalendarioCorrectivoController::class, 'index'])->name('correctivo.cronograma'); 
Route::get('admin/cronograma-correctivo/{month}', [CalendarioCorrectivoController::class, 'index_month'])->name('correctivo.cronogramames');
Route::get('admin/cronograma-actualizar-fecha/{id}', [CalendarioCorrectivoController::class, 'actualizar_fecha'])->name('cronograma.addfecha'); 

Route::post('enviar-correo', [CronogramaPreventivoController::class, 'enviarCorreo'])->name('enviar.correo');

Route::get('admin/preventivo', [PreventivosController::class, 'index'])->name('admin.preventivo');
Route::get('admin/orden-preventivo', [PreventivosController::class, 'orden'])->name('admin.prevorden');
Route::get('admin/verificacion-preventivo', [PreventivosController::class, 'verificacion'])->name('admin.preverificacion');

Route::get('admin/subir-firma', [VerificacionController::class, 'createFirmadas'])->name('admin.subirfirma');
Route::post('admin/guarda-firma', [VerificacionController::class, 'storeFirmada'])->name('admin.guardafirma');
Route::get('admin/ver-firmas', [VerificacionController::class, 'firmadas'])->name('admin.verfirmas');




//Route::post('Evento/calendario', [CalendarioPreventivoController::class, 'calendario']); 







