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

Route::get('admin/internet', [TelecomunicacionController::class, 'internet'])->name('admin.internet'); 
Route::get('admin/correo', [TelecomunicacionController::class, 'correo'])->name('admin.correo'); 
Route::get('admin/telefono', [TelecomunicacionController::class, 'telefono'])->name('admin.telefono'); 

Route::get('admin/agregar-internet', [TelecomunicacionController::class, 'formInternet'])->name('jefe.internet'); 
Route::get('admin/agregar-correo', [TelecomunicacionController::class, 'formCorreo'])->name('jefe.correo'); 
Route::get('admin/agregar-telefono', [TelecomunicacionController::class, 'formTelefono'])->name('jefe.telefono'); 

Route::get('admin/cronograma', [CalendarioPreventivoController::class, 'index'])->name('admin.cronograma'); 
Route::get('admin/cronograma/{month}', [CalendarioPreventivoController::class, 'index_month']);

Route::get('admin/lista-correctivos', [CorrectivoController::class, 'correctivos'])->name('correctivo.listacorrectivo'); 

Route::get('admin/cronograma-correctivo', [CalendarioCorrectivoController::class, 'index'])->name('correctivo.cronograma'); 
Route::get('admin/cronograma-correctivo/{month}', [CalendarioCorrectivoController::class, 'index_month']);
Route::get('admin/cronograma-actualizar-fecha/{id}', [CalendarioCorrectivoController::class, 'actualizar_fecha'])->name('cronograma.addfecha'); 




//Route::post('Evento/calendario', [CalendarioPreventivoController::class, 'calendario']); 







