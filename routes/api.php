<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
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
Route::post('/extract_zip', [UploadController::class, 'extract_zip']);
Route::post('/delete_file', [UploadController::class, 'delete_file']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
