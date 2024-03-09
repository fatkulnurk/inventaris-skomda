<?php

use chillerlan\QRCode\QRCode;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', fn() => redirect()->to('/admin'))->name('login');

Route::get('/qr', function () {
    return (new QRCode())->render(request()->query('data'));
});
