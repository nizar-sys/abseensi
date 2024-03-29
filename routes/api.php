<?php

use App\Http\Controllers\Api\RayonCrudController;
use App\Http\Controllers\Api\RombelCrudController;
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

// greeting to api
Route::get('/', function(){
    return response()->json([
        'author' => config('app.author'),
        'message' => 'Selamat datang di aplikasi Abseensi!'
    ]);
});

Route::middleware('auth.session')->group(function(){

    // students groups api
    Route::resource('rayons', RayonCrudController::class);
    Route::resource('rombels', RombelCrudController::class);
});