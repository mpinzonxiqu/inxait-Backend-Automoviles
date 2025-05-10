<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParticipantController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [ParticipantController::class, 'index']);
Route::post('/register', [ParticipantController::class, 'store'])->name('register');
Route::get('/winner', [ParticipantController::class, 'selectWinner'])->name('winner');
Route::get('/export', [ParticipantController::class, 'export'])->name('export');
