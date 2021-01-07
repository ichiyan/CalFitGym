<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\BasketController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomizeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EntryLogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MembershipHistoryController;
use App\Http\Controllers\MemberTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\HomeController;

use App\Models\Basket;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Customize;
use App\Models\Employee;
use App\Models\EntryLog;
use App\Models\Event;
use App\Models\InventoryLog;
use App\Models\Item;
use App\Models\Membership;
use App\Models\MembershipHistory;
use App\Models\MemberType;
use App\Models\Order;
use App\Models\Person;
use App\Models\Remark;
use App\Models\User;
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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function(){
    return view('admin.home');
});

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});

//Route::resource('/admin/employeeList', EmployeeController::class);
Route::get('/admin/employeeList/', [App\Http\Controllers\EmployeeController::class, 'showAll'])->name('employees');
Route::get('/admin/employeeList/current', [App\Http\Controllers\EmployeeController::class, 'showCurrent']);
Route::get('/admin/employeeList/previous', [App\Http\Controllers\EmployeeController::class, 'showPrevious']);
Route::get('/admin/employee/{id}/detail', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employeeDetail');
Route::get('/admin/employee/create', [App\Http\Controllers\EmployeeController::class, 'create']);
Route::get('/admin/employee/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit']);
Route::put('/admin/employee/{id}/update', [App\Http\Controllers\EmployeeController::class, 'update']);
Route::delete('/admin/employee/{id}/delete', [App\Http\Controllers\EmployeeController::class, 'destroy']);
Route::get('/new/form', function(){ //after submitting the registration, this redirects it to the next form
    $user_id = DB::table('users')->orderBy("id", "desc")->first()->id;
    $user = User::findOrFail($user_id);

    if($user->user_type == 3){
        return view('admin.newCustomerForm', compact('user'));
    } else {
        return view('admin.newEmployeeForm', compact('user'));
    }
})->name('form');


//Route::resource('/admin/customerList', CustomerController::class);
Route::get('/admin/customerList/', [App\Http\Controllers\CustomerController::class, 'showAll']);
Route::get('/admin/customerList/walk_in', [App\Http\Controllers\CustomerController::class, 'showWalk_in']);
Route::get('/admin/customerList/walk_in/active', [App\Http\Controllers\CustomerController::class, 'showWalk_inA']);
Route::get('/admin/customerList/walk_in/inactive', [App\Http\Controllers\CustomerController::class, 'showWalk_inI']);
Route::get('/admin/customerList/monthly', [App\Http\Controllers\CustomerController::class, 'showMonthly']);
Route::get('/admin/customerList/monthly/active', [App\Http\Controllers\CustomerController::class, 'showMonthlyA']);
Route::get('/admin/customerList/monthly/inactive', [App\Http\Controllers\CustomerController::class, 'showMonthlyI']);
Route::get('/admin/customerList/premium', [App\Http\Controllers\CustomerController::class, 'showPremium']);
Route::get('/admin/customerList/premium/active', [App\Http\Controllers\CustomerController::class, 'showPremiumA']);
Route::get('/admin/customerList/premium/inactive', [App\Http\Controllers\CustomerController::class, 'showPremiumI']);
Route::get('/admin/customer/{id}/detail', [App\Http\Controllers\CustomerController::class, 'show']);
Route::get('/admin/customer/create', [App\Http\Controllers\CustomerController::class, 'create']);
Route::get('/admin/customer/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit']);
Route::put('/admin/customer/{id}/update', [App\Http\Controllers\CustomerController::class, 'update']);
Route::delete('/admin/customer/{id}/delete', [App\Http\Controllers\CustomerController::class, 'destroy']);

Route::get('/admin/inventoryList', [App\Http\Controllers\InventoryLogController::class, 'showAll']);
Route::get('/admin/inventory/create', [App\Http\Controllers\InventoryLogController::class, 'create']);
Route::get('/admin/inventory/{id}/edit', [App\Http\Controllers\InventoryLogController::class, 'edit']);
Route::put('/admin/inventory/{id}/update', [App\Http\Controllers\InventoryLogController::class, 'update']);
Route::delete('/admin/inventory/{id}/delete', [App\Http\Controllers\InventoryLogController::class, 'destroy']);

Route::get('/admin/orderList', [App\Http\Controllers\OrderController::class, 'showAll']);
Route::get('/admin/order/create', [App\Http\Controllers\OrderController::class, 'create']);
Route::get('/admin/order/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit']);
Route::put('/admin/order/{id}/update', [App\Http\Controllers\OrderController::class, 'update']);
Route::delete('/admin/order/{id}/delete', [App\Http\Controllers\OrderController::class, 'destroy']);

Route::get('/admin/rates', [App\Http\Controllers\MemberTypeController::class, 'showAll']);

Route::get('/admin/events', [App\Http\Controllers\EventController::class, 'showAll']);

?>