<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FelvagottsController;
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

Route::post("/register",[AuthController::class,"signup"]);
Route::post("/login",[AuthController::class,"signin"]);
Route::post("/logout",[AuthController::class,"logout"]);
Route::get("/felvagott",[FelvagottsController::class,"index"]);
Route::get("/felvagott/show/{id}",[FelvagottsController::class,"show"]);
Route::get( "/felvagott/search/{felvagott_neve}", [ FelvagottsController::class, "felvagott_search" ]);
Route::get( "/felvagott/alapanyag/{alapanyag_neve}", [ FelvagottsController::class, "alapanyag_search" ]);


Route::group( ["middleware" => ["auth:sanctum"]], function(){
    Route::post("/felvagott",[FelvagottsController::class,"store"]);
    Route::put("/felvagott/{uj}",[FelvagottsController::class,"update"]);
    Route::delete("/felvagott/{id}",[FelvagottsController::class,"destroy"]);
});