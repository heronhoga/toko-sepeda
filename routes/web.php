<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\SuperviseController;
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



Route::group(['middleware'=>'guest'], function() {
    Route::get('/', [AuthController::class, 'welcome'])->name('welcome');

    //LOGIN
    Route::get('/login', [AuthController::class, 'index'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

}); 

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //SELLING
    Route::get('/selling', [SellingController::class,'index'])->name('selling');
    Route::get('/supervise', [SuperviseController::class, 'index'])->name('supervise');

    //SELLER
    Route::get('seller', [SellerController::class, 'index'])->name('seller');
});
