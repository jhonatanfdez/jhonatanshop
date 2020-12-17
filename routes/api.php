<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AutocompleteController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('category',CategoryController::class)->names('api.category');


Route::apiResource('product', ProductController::class)->names('api.product');


Route::delete('/eliminarimagen/{id}',[ProductController::class,'eliminarimagen'])->name('api.eliminarimagen');

Route::get('/autocomplete', [AutocompleteController::class,'autocomplete'])->name('autocomplete');
