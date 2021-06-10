<?php

use App\Http\Controllers\Api\PocketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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
Route::get('test', [PocketController::class, 'test']);

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {

    Route::post('pockets', [PocketController::class, 'store']);
    Route::post('pockets/{id}/contents', [PocketController::class, 'storeContents']);
    Route::get('pockets/{id}/contents', [PocketController::class, 'viewContents']);

    Route::delete('contents/{id}', [PocketController::class, 'deleteContent']);
});
