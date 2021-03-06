<?php

use App\Http\Controllers\HomeController;
use App\Pocket;
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

// Route::get('/', function () {
//     $pockets = Pocket::with('contents')->get();
//     return view('pockets', compact('pockets'));
// });

Route::get('/', function () {
    return redirect('/pockets');
});

Route::get('/pockets', [HomeController::class, 'index']);
