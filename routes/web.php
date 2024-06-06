<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\InvoiceController;
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
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/config', function () {
    return view('config');
});

Route::get('/invoice', function () {
    return view('invoice');
});

Route::post('/invoice', [InvoiceController::class, 'store']);


Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/fetch-data', [ApiController::class, 'fetchData']);

Route::get('/invoiceData', [InvoiceController::class, 'fetchInvoice']);