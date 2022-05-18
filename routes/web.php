<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\EconomiaController;
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

Route::get('/', [SiteController::class, 'index']);

Route::post('formulario/cotacao', [EconomiaController::class, 'form']);


// Route::get('/', function () {
//     return view('welcome');
// });
