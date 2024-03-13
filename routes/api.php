<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\QrController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'as' => 'auth.',
    'prefix' => '/auth',
    'middleware' => 'throttle:5,1',
], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/profile', [ProfileController::class, 'account'])->name('profile.index');
    Route::get('/inventory', [InventoryController::class, 'inventory'])->name('profile.inventory');
    Route::group(['as' => 'inventory.', 'prefix' => '/inventory'], function () {
        Route::get('/find-by-qr', [InventoryController::class, 'findByQr'])->name('find-by-qr');
        Route::get('/{id}', [InventoryController::class, 'show'])->name('show');
    });
});

Route::get('/qr', QrController::class)->name('qr.index');
