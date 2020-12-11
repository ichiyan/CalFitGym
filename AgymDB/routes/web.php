<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/home', function(){
    return view('home');
});

//Route::resource('/admin/employeeList', EmployeeController::class);
Route::get('/admin/employeeList/', [App\Http\Controllers\EmployeeController::class, 'showAll'])->name('employees');
//Route::get('/admin/employeeList/{$id}', [App\Http\Controllers\EmployeeController::class, show($id)]);
Route::get('/admin/employeeList/current', [App\Http\Controllers\EmployeeController::class, 'showCurrent']);
Route::get('/admin/employeeList/previous', [App\Http\Controllers\EmployeeController::class, 'showPrevious']);
Route::get('/admin/employeeList/create', [App\Http\Controllers\EmployeeController::class, 'create']);


Route::resource('/admin/customerList', CustomerController::class);
Route::get('/admin/customerList/walk_in', [App\Http\Controllers\EmployeeController::class, 'showWalk_in']);
Route::get('/admin/customerList/walk_in/active', [App\Http\Controllers\EmployeeController::class, 'showWalk_inA']);
Route::get('/admin/customerList/walk_in/inactive', [App\Http\Controllers\EmployeeController::class, 'showWalk_inI']);
Route::get('/admin/customerList/monthly', [App\Http\Controllers\EmployeeController::class, 'showMonthly']);
Route::get('/admin/customerList/monthly/active', [App\Http\Controllers\EmployeeController::class, 'showMonthlyA']);
Route::get('/admin/customerList/monthly/inactive', [App\Http\Controllers\EmployeeController::class, 'showMonthlyI']);
Route::get('/admin/customerList/premium', [App\Http\Controllers\EmployeeController::class, 'showPremium']);
Route::get('/admin/customerList/premium/active', [App\Http\Controllers\EmployeeController::class, 'showPremiumA']);
Route::get('/admin/customerList/premium/inactive', [App\Http\Controllers\EmployeeController::class, 'showPremiumI']);

Route::get('/admin/inventory', [App\Http\Controllers\InventoryLogController::class, 'show']);

Route::get('/admin/order', [App\Http\Controllers\OrderController::class, 'show']);

Route::get('/admin/rates', [App\Http\Controllers\MemberTypeController::class, 'show']);

Route::get('/admin/events', [App\Http\Controllers\EventController::class, 'show']);

?>