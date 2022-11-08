<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SettingController;

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
Route::match(['get', 'post'], '/register', function () {
    return redirect('/');
});


// Login routes
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Register routes
Route::get('/123XYZ123', [AuthController::class, 'viewRegister'])->name('register');
Route::post('/123XYZ123', [AuthController::class, 'adminRegister'])->name('register');

// Logout route
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes
Route::group(['middleware' => 'auth'], function () {
    // Analytics route
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // User routes
    Route::post('/users', [UserController::class, 'addUser'])->name('addUser');
    Route::post('/user', [UserController::class, 'updateUser'])->name('updateUser');

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}/details', [UserController::class, 'viewDetails']);
    Route::get('/user/{id}/edit', [UserController::class, 'editUser']);
    Route::get('/user/{id}/suspend', [UserController::class, 'suspend']);
    Route::get('/user/{id}/activate', [UserController::class, 'activate']);
    Route::get('/user/{id}/delete', [UserController::class, 'delete']);

    // Categories routes
    Route::post('/categories', [CategoryController::class, 'addCategory'])->name('addCategory');
    Route::post('/category', [CategoryController::class, 'updateCategory'])->name('updateCategory');

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/category/{id}/details', [CategoryController::class, 'viewDetails']);
    Route::get('/category/{id}/suspend', [CategoryController::class, 'suspend']);
    Route::get('/category/{id}/activate', [CategoryController::class, 'activate']);
    Route::get('/category/{id}/delete', [CategoryController::class, 'delete']);

    // Budget routes
    Route::post('/budgets', [BudgetController::class, 'addBudget'])->name('addBudget');
    Route::post('/budget', [BudgetController::class, 'updateBudget'])->name('updateBudget');

    Route::get('/budget', [BudgetController::class, 'index']);
    Route::get('/budget/{id}/details', [BudgetController::class, 'viewDetails']);
    Route::get('/budget/{id}/suspend', [BudgetController::class, 'suspend']);
    Route::get('/budget/{id}/activate', [BudgetController::class, 'activate']);
    Route::get('/budget/{id}/delete', [BudgetController::class, 'delete']);

    // Application routes
    Route::post('/apply', [ApplicationController::class, 'addApplication'])->name('apply');
    Route::post('/reviewStatus', [ApplicationController::class, 'changeReviewStatus'])->name('changeReviewStatus');
    Route::post('/approveStatus', [ApplicationController::class, 'changeApproveStatus'])->name('changeApproveStatus');
    Route::post('/application/pdf', [ApplicationController::class, 'createPDF'])->name('downloadPDF');

    Route::get('/apply', [ApplicationController::class, 'index']);
    Route::get('/applications', [ApplicationController::class, 'applications']);
    Route::get('/application/{id}/details', [ApplicationController::class, 'details']);
    Route::get('/application/{id}/singlepdf', [ApplicationController::class, 'createSinglePDF']);


    // Settings routes
    Route::get('/settings', [SettingController::class, 'index']);
    Route::post('/updateInfo', [SettingController::class, 'updateInfo'])->name('updateInfo');
    Route::post('/updatePassword', [SettingController::class, 'updatePassword'])->name('updatePassword');
});
