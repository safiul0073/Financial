<?php

use App\Http\Controllers\ExpensCategoryController;
use App\Http\Controllers\ExpensTitleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeCategoryController ;
use App\Http\Controllers\IncomeTitleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index']);

    // income section here...
   // Route::get('/category', [IncomeController::class, 'categoryIndex'])->name('category.index');
    Route::resource('incomecategory', IncomeCategoryController::class);
    Route::resource('incometitle', IncomeTitleController::class);
    Route::resource('expenscategory', ExpensCategoryController::class);
    Route::resource('expenstitle', ExpensTitleController::class);


});
