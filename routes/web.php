<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function(){
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

    //Getting Cities and Townships
    Route::get('/getTownships',[AdminController::class, 'getTownship'])->name('getTownships');

    //Admins
    Route::get('/admins', [AdminController::class, 'index'])->name('admins');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins/store', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/admins/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::post('/admins/update', [AdminController::class, 'update'])->name('admins.update');
    Route::get('/admins/delete', [AdminController::class, 'delete'])->name('admins.delete');
});

