<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\TowerController;
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

Route::group(['as' => 'api.'], function () {
    Route::get('phase', [PhaseController::class, 'get_list'])->name('phase.index');
    Route::get('tower', [TowerController::class, 'get_list'])->name('tower.index');
    Route::get('flat', [FlatController::class, 'get_list'])->name('flat.index');

    Route::post('phase', [PhaseController::class, 'removeImage'])->name('phase.remove');
});

Route::post('/applicant', [ApplicantController::class, 'store']);
