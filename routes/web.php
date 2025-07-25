<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\Investments;
use App\Http\Controllers\RentPropertiesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SeekersController;
use App\Http\Controllers\SpendingController;
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


// <---------------------- Rent-Property ----------------------> //
Route::middleware('auth')->group(function () {
Route::get('/',[RentPropertiesController::class,'index'])->name('analytics');
Route::get('/rentOut',[RentPropertiesController::class,'rentOut'])->name('rent-out');
Route::get('/rent/show',[RentPropertiesController::class,'rentShow'])->name('r-show');
Route::post('/rent/add',[RentPropertiesController::class,'rentProperties'])->name('rent-add');
Route::get('/rent/delete/{id}',[RentPropertiesController::class,'delRent'])->name('rent-del');
Route::patch('/rent/restore/{id}',[RentPropertiesController::class,'restore'])->name('rent-restore');
Route::delete('/rent/force-delete/{id}',[RentPropertiesController::class,'forceDelete'])->name('rent-force-delete');
Route::post('/rent/update/{id}',[RentPropertiesController::class,'editRent'])->name('editRent');
Route::get('/rent/property/show/{id}', [RentPropertiesController::class, 'showProperty'])->name('r-showProperty');
Route::post('/rent/process/{id}',[RentPropertiesController::class,'rentProcess'])->name('rentProcess');
Route::get('/rent/process/show',[RentPropertiesController::class,'RentOutDisplay'])->name('RentOutDisplay');
Route::get('/rent/process/property/show/{id}',[RentPropertiesController::class,'rentOutDisplaySingle'])->name('rentOutDisplaySingle');
Route::post('rent/process/update/{id}',[RentPropertiesController::class,'rentProcessUpdate'])->name('rentProcessUpdate');
Route::get('/rent/process/delete/{id}',[RentPropertiesController::class,'RentOutDelete'])->name('RentOutDelete');
Route::delete('/rent/process/destroy/{id}',[RentPropertiesController::class,'RentOutDestroy'])->name('RentOutDestroy');
Route::delete('/rent/process/destroy-all',[RentPropertiesController::class,'RentOutDestroyAll'])->name('RentOutDestroyAll');
Route::patch('/rent/process/restore/{id}',[RentPropertiesController::class,'RentOutRestore'])->name('RentOutRestore');
Route::get('/rent/process/trash',[RentPropertiesController::class,'RentOutTrashed'])->name('RentOutTrashed');
});

// <---------------------- Sale-Property ----------------------> //
Route::middleware('auth')->group(function () {
Route::post('/sale/add',[SaleController::class,'addProperty'])->name('s-addProperty');
Route::get('/sale/show',[SaleController::class,'showSale'])->name('showSale');
Route::get('/sale/property/show/{id}', [SaleController::class, 'singleShowSale'])->name('s-showProperty');
Route::post('/sale/update/{id}',[SaleController::class,'editSale'])->name('editSale');
Route::get('/sale/delete/{id}',[SaleController::class,'delSale'])->name('deleteSale');
Route::post('/sale/process/{id}',[SaleController::class,'saleProcess'])->name('saleProcess');
Route::get('/sale/process/show',[SaleController::class,'SaleOutDisplay'])->name('SaleOutDisplay');
Route::get('/sale/process/property/show/{id}',[SaleController::class,'soldOutDisplaySingle'])->name('soldOutDisplaySingle');
Route::post('/sale/property/process/edit/{id}',[SaleController::class,'saleProcessEdit'])->name('saleProcessEdit');
Route::get('/sale/process/delete/{id}',[SaleController::class,'SaleOutDelete'])->name('SaleOutDelete');
Route::delete('/sale/process/destroy/{id}',[SaleController::class,'SaleOutDestroy'])->name('SaleOutDestroy');
Route::delete('/sale/process/destroy-all',[SaleController::class,'SaleOutDestroyAll'])->name('SaleOutDestroyAll');
Route::patch('/sale/process/restore/{id}',[SaleController::class,'SaleOutRestore'])->name('SaleOutRestore');
Route::get('/sale/process/trash',[SaleController::class,'SaleOutTrashed'])->name('SaleOutTrashed');
});

// <---------------------- Investment ----------------------> //
Route::middleware('auth')->group(function () {
Route::post('/investment/add',[Investments::class,'addInvestment'])->name('addInvestment');
Route::get('/investment/show',[Investments::class,'showInvestment'])->name('showInvestment');
Route::get('/investment/property/show/{id}', [Investments::class, 'showProperty'])->name('showProperty');
Route::get('/investment/hold',[Investments::class,'showHold'])->name('showHold');
Route::get('/investment/sold', [Investments::class, 'showSold'])->name('showSold');
Route::get('/investment/property/delete/{id}',[Investments::class,'delInvestment'])->name('deleteInvestment');
Route::patch('/investment/property/restore/{id}',[Investments::class,'restoreInvestment'])->name('restoreInvestment');
Route::delete('/investment/property/force-delete/{id}',[Investments::class,'forceDeleteInvestment'])->name('forceDeleteInvestment');
Route::patch('/investment/update/{id}',[Investments::class,'editInvestment'])->name('editInvestment');
Route::delete('/investment/destroy-all',[Investments::class,'forceDeleteAllInvestment'])->name('forceDeleteAllInvestment');
Route::post('/investment/disposed/{id}',[Investments::class,'investDisposed'])->name('investDisposed');
Route::get('/investment/disposed/show',[Investments::class,'investDisposedShow'])->name('investDisposedShow');
Route::get('/investment/disposed/property/show/{id}',[Investments::class,'investDisposedShowSingle'])->name('investDisposedPropertyShow');
Route::delete('/investment/disposed/delete/{id}',[Investments::class,'investDisposedDelete'])->name('investDisposedDelete');
Route::delete('/investment/disposed/destroy/{id}',[Investments::class,'investDisposedDestroy'])->name('investDisposedDestroy');
Route::patch('/investment/disposed/restore/{id}',[Investments::class,'investDisposedRestore'])->name('investDisposedRestore');
Route::delete('/investment/disposed/destroy-all',[Investments::class,'investDisposedDestroyAll'])->name('investDisposedDestroyAll');
});

// <---------------------- Spending ----------------------> //
Route::middleware('auth')->group(function () {
Route::post('/spending/add',[SpendingController::class,'addSpending'])->name('addSpending');
Route::get('/spending/show',[SpendingController::class,'showSpending'])->name('showSpending');
Route::patch('/spending/update/{id}',[SpendingController::class,'editSpending'])->name('editSpending');
Route::get('/spending/delete/{id}',[SpendingController::class,'delSpending'])->name('delSpending');
Route::get('/spending/profit/{month}',[SpendingController::class,'getProfit'])->name('getProfit');
Route::get('/spending/total',[SpendingController::class,'totalSpending'])->name('totalSpending');
});

//<---------------------- User ---------------------->//
Route::get('/register',[AuthController::class,'registerPage'])->name('registerPage')->middleware('auth');
Route::post('/register',[AuthController::class,'addUser'])->name('addUser')->middleware('auth');
Route::get('/login',[AuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

//<--------------------- Add Business Details --------------------//
Route::middleware('auth')->group(function () {
    Route::get('business-details',[BusinessController::class,'index'])->name('businessDetails');
    Route::post('business-details/add',[BusinessController::class,'store'])->name('storeBusiness');
});

//<-------------------- Property Seekers -----------------------//
Route::middleware('auth')->group(function () {
Route::get('/property-seekers',[SeekersController::class,'index'])->name('showSeekers');
Route::post('/property-seekers/add',[SeekersController::class,'store'])->name('storeSeeker');
Route::get('/property-seekers/delete/{id}',[SeekersController::class,'delete'])->name('deleteSeeker');
Route::get('/property-seekers/show/{id}',[SeekersController::class,'show'])->name('seekerDetails');
Route::post('/property-seekers/edit{id}',[SeekersController::class,'edit'])->name('editSeeker');
Route::get('/property-seekers/contacted/{id}',[SeekersController::class,'contacted'])->name('seekerContacted');
Route::get('/property-seeker/closed/{id}',[SeekersController::class,'closed'])->name('seekerClosed');
});

//<------------------------- Forget Password -----------------//
Route::get('/forget-password',[ForgetPasswordController::class,'showEmailForm'])->name('showEmailForm');
Route::post('/forgot-password', [ForgetPasswordController::class, 'checkEmail'])->name('checkEmail');
Route::get('/reset-password/{email}', [ForgetPasswordController::class, 'showResetForm'])->name('reset.form');
Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword'])->name('reset.password');