<?php

use App\Http\Controllers\Api\ApiController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//------------------------- Auth --------------
Route::controller(ApiController::class)->group(function (){
    Route::post('/auth/register','register');
    Route::post('/auth/login','login');
});


Route::middleware('isApiLoggedIn')->group(function() {
    Route::get('/categories/list', [ApiController::class, 'list']);
});
