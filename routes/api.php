<?php

use App\Http\Controllers\SpatieController;
use App\Http\Controllers\UploadController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('index',[SpatieController::class,'index']);
Route::get('aes',[SpatieController::class,'aes']);
Route::post('upload',[UploadController::class,'upload']);
Route::get('show',[UploadController::class,'show']);
Route::get('encryption',[UploadController::class,'encryption']);
Route::get('decription',[UploadController::class,'decription']);


