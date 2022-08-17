<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;

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
    Route::get('/admins/details', [AdminController::class, 'details'])->name('admins.details');

    //Employees
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('/employees/update', [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('/employees/delete', [EmployeeController::class, 'delete'])->name('employees.delete');
    Route::get('/employees/details', [EmployeeController::class, 'details'])->name('employees.details');

    //Foods
    Route::get('/foods', [InventoryController::class, 'foodIndex'])->name('foods');
    Route::get('/foods/create', [InventoryController::class, 'foodCreate'])->name('foods.create');
    Route::post('/foods/store', [InventoryController::class, 'foodStore'])->name('foods.store');
    Route::get('/foods/edit', [InventoryController::class, 'foodEdit'])->name('foods.edit');
    Route::post('/foods/update', [InventoryController::class, 'foodUpdate'])->name('foods.update');
    Route::get('/foods/delete', [InventoryController::class, 'foodDelete'])->name('foods.delete');

    //Drinks
    Route::get('/drinks', [InventoryController::class, 'drinkIndex'])->name('drinks');
    Route::get('/drinks/create', [InventoryController::class, 'drinkCreate'])->name('drinks.create');
    Route::post('/drinks/store', [InventoryController::class, 'drinkStore'])->name('drinks.store');
    Route::get('/drinks/edit', [InventoryController::class, 'drinkEdit'])->name('drinks.edit');
    Route::post('/drinks/update', [InventoryController::class, 'drinkUpdate'])->name('drinks.update');
    Route::get('/drinks/delete', [InventoryController::class, 'drinkDelete'])->name('drinks.delete');
});

