<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get API data list
Route::get('data/list', [RouteController::class, 'productsList']);

// post API data list
Route::post('create/category',[RouteController::class, 'createCategory']);

//create contact
Route::post('create/contact',[RouteController::class, 'createContact']);

//delete category
Route::post('delete/category',[RouteController::class, 'deleteCategory']);

//category details
Route::get('category/details/{id}',[RouteController::class, 'categoryDetails']);

// category update
Route::post('category/update', [RouteController::class, 'categoryUpdate']);


/**
 *  get all data
 * localhost:8000/api/data/list   (get)
 *
 *  createCategory
 * localhost:8000/api/create/category
 *
 * add contact
 * localhost:8000/api/create/contact
 *
 * delete category
 * localhost:8000/api/delete/category
 *
 * category details
 * localhost:8000/api/category/details/{id}
 *
 * category update
 * localhost:8000/api/category/update
 *
 */
