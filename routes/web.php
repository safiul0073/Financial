<?php

use App\Http\Controllers\EnvestController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpensTitleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\CategoryController ;
use App\Http\Controllers\IncomeTitleController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Profilecontroller;
use App\Http\Controllers\ProfiteRequestcontroller;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/register', [HomeController::class, 'registerIndex'])->name('register.index');
Route::post('/user-regiseter', [HomeController::class, 'register'])->name('register');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    // profile panel here...
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile-password-change', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/profile-avater-update', [Profilecontroller::class, 'avaterUpdate'])->name('profile.avater.update');
    Route::get('/profile-delete', [Profilecontroller::class, 'delete'])->name('profile.delete');
    // partner profite request setion here ....
    Route::get('/request-index', [ProfiteRequestcontroller::class, 'index'])->name('request.index');
    Route::get('/request-store', [ProfiteRequestcontroller::class, 'store'])->name('request.store');

    Route::get('/setting-index', [HomeController::class, 'settingIndex'])->name('setting.index');
    Route::get('/cache-clear', [HomeController::class, 'clearCache'])->name('cache.clear');
    Route::get('/route-clear', [HomeController::class, 'routeClear'])->name('route.clear');
    Route::get('/view-clear', [HomeController::class, 'clearViews'])->name('view.clear');
    Route::resource('category', CategoryController::class);
    Route::resource('incometitle', IncomeTitleController::class);
    Route::resource('expenstitle', ExpensTitleController::class);
    Route::resource('incame', IncomeController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('partner', PartnerController::class);
    Route::resource('invest', EnvestController::class);

    // dependent show for Incame and Expense
    Route::post('dynamic_dependent_expense/fetch', [ExpenseController::class,'dynamicFatch'])
           ->name('dynamicdependent.expense.fetch');
    Route::post('dynamic_dependent/fetch', [IncomeController::class,'dynamicFatch'])
           ->name('dynamicdependent.fetch');

    // report section here....
    Route::get('expense-report-index', [ReportController::class, 'expenseIndex'])->name('expenses.report.index');
    Route::get('income-report-index', [ReportController::class, 'incomeIndex'])->name('income.report.index');
    Route::post('expense-report-get', [ReportController::class, 'expenseReport'])->name('expense.report.get');
    Route::post('income-report-get', [ReportController::class, 'incomeReport'])->name('income.report.get');

    // Route::get('exort-excel', [ReportController::class, 'exortIncame'])->name('incame.export');

    // partner Report Section here...
    Route::get('partner-report-index', [ReportController::class, 'partnerRepotIndex'])->name('report.partner.index');
    Route::post('get-partner-report', [ReportController::class, 'partnerRepot'])->name('report.partner.get');

});
