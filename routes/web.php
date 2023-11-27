<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BikeController;
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
    Route::get('/seller', [SellerController::class, 'index'])->name('seller');
    //-CREATE SELLER
    Route::get('/createseller', [SellerController::class, 'createSellerPage'])->name('createSellerPage');
    Route::post('/createseller', [SellerController::class, 'createSeller'])->name('createSeller');
    //-UPDATE SELLER
    Route::get('/editseller/{id}', [SellerController::class, 'editSellerPage'])->name('editSellerPage');
    Route::put('/editseller/{id}', [SellerController::class, 'editSeller'])->name('editSeller');

    //-DELETE (SOFT) SELLER
    Route::put('/deleteseller/{id}', [SellerController::class, 'deleteSeller'])->name('deleteSeller');

    //-TRASH SELLER GET
    Route::get('/trashseller', [SellerController::class, 'trashSellerIndex'])->name('trashSellerIndex');
    Route::put('/trashseller/{id}', [SellerController::class, 'recover'])->name('recover');
    Route::delete('/trashseller/{id}', [SellerController::class, 'hardDelete'])->name('hardDelete');

    //BIKE
    Route::get('/bike', [BikeController::class, 'index'])->name('bikeIndex');
    //-CREATE BIKE
    Route::get('/createbike', [BikeController::class, 'createBikePage'])->name('createBikePage');
    Route::post('/createbike', [BikeController::class, 'createBike'])->name('createBike');
    //-UPDATE BIKE
    Route::get('/editbike/{id}', [BikeController::class, 'editBikePage'])->name('editBikePage');
    Route::put('/editbike/{id}', [BikeController::class, 'editBike'])->name('editBike');

    //-DELETE (SOFT) SEPEDA
    Route::put('/deletebike/{id}', [BikeController::class, 'deleteBike'])->name('deleteBike');

    //-TRASH BIKE GET
    Route::get('/trashbike', [BikeController::class, 'trashBikeIndex'])->name('trashBikeIndex');
    Route::put('/trashbike/{id}', [BikeController::class, 'recoverBike'])->name('recoverBike');
    Route::delete('/trashbike/{id}', [BikeController::class, 'hardDeleteBike'])->name('hardDeleteBike');
});
