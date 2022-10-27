<?php

use App\Http\Controllers\API\RouteController;
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

Route::get('category/list', [RouteController::class, 'site_data']);

//category add
Route::post('create/category',[RouteController::class, 'categoryCreate']);

//delete category
Route::post('category/delete',[RouteController::class, 'deleteCategory']);

//category detail
Route::get('category/list/{id}', [RouteController::class, 'categoryDetail']);

//category update
Route::post('category/update', [RouteController::class, 'categoryUpdate']);
