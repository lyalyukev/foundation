<?php

use App\Http\Controllers\ContributorController;
use App\Http\Controllers\FundCollectionController;
use App\Http\Resources\FundCollectionCollection;
use App\Models\FundCollection;
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
//Protect by token, for generating token use "php artisan token:generate"

Route::middleware('token.protect')->group(function () {

//Creating Collection
    Route::post('/collection/create/', [FundCollectionController::class, 'store']);

//Creating Contributor
    Route::post('/{collection_id}/contributor/create/', [ContributorController::class, 'store']);

});

//Get detail Collection
Route::get('/collection/{id}/', [FundCollectionController::class, 'show']);

// Get list of collections
Route::get('/collections/', [FundCollectionController::class, 'index']);

// Get list of collections where sum contributes less target amount
Route::get('/collections-with-remainder/', [FundCollectionController::class, 'collectionWithRemainder']);

//Get list of collections with contributors
Route::get('/collections-with-contributors/', [FundCollectionController::class, 'indexWithContributors']);

//Get list of collection with filter and order parameters (filter=>10000&order=desc)
Route::get('/collections/filter/{filter}/', [FundCollectionController::class, 'filterCollections']);

//If we don`t have route
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found'], 404);
});
