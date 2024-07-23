<?php

use App\Http\Controllers\Match\DispatcherController;
use App\Http\Controllers\Match\MatchController;
use App\Http\Controllers\UserController;
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


Route::middleware(['api', 'cors.disabled'])->group(function () {
    Route::post('/match/create', [MatchController::class, 'store'])->name('api-match.store');
});







