<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Investment;
use App\Http\Controllers\Investments;
use App\Http\Controllers\RentPropertiesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SpendingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


