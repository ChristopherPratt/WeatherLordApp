<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherController;
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

Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/getUserName', [DashboardController::class, 'getUserName']);

Route::get('/getCurrentWeather', [WeatherController::class, 'getCurrentWeather']);



//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
