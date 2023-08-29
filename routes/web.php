<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FundCollectionController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/all-collections', [DashboardController::class, 'allCollections'])->name('collections.all');
    Route::get('/collection/{id}/contributors/', [DashboardController::class, 'collectionContributors'])->name('collection.contributors');

    Route::get('/collection/{id}/edit/', [FundCollectionController::class, 'edit'])->name('collection.edit');
    Route::put('/collection/{id}/update/', [FundCollectionController::class, 'update'])->name('collection.update');
});

Route::get('/', function () {
    return redirect()->route('login');
});


