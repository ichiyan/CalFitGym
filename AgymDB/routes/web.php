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
    return view('admin.dashboard');
});

Route::get('/dashboard1', function(){
    return view('admin-coreUI.dashboard');
});

Route::get('/dashboard2', function(){
    return view('admin.dashboard');
});

Route::view('/admin/employeeList', 'admin.employeeList');
Route::view('/facility', 'facility');

/* test */
Route::get('/admin/dashboard', [HomeController::class, 'adminHome'])->name('admin-dashboard')->middleware('is_admin');

// Route::resource('/admin/employeeList/', EmployeeController::class);
Route::get('/admin/employeeList/', [App\Http\Controllers\EmployeeController::class, 'showAll'])->name('employees');
Route::get('/admin/employeeList/current', [App\Http\Controllers\EmployeeController::class, 'showCurrent']);
Route::get('/admin/employeeList/previous', [App\Http\Controllers\EmployeeController::class, 'showPrevious']);
Route::get('/admin/employee/{id}/detail', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employeeDetail');
Route::get('/admin/employee/create', [App\Http\Controllers\EmployeeController::class, 'create']);
Route::get('/admin/employee/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employeeEdit');
Route::put('/admin/employee/{id}/update', [App\Http\Controllers\EmployeeController::class, 'update']);
Route::get('/admin/employee/{id}/delete', [App\Http\Controllers\EmployeeController::class, 'destroy']);
Route::get('/admin/employee/{id}/rehire', [App\Http\Controllers\EmployeeController::class, 'rehire']);
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
Route::get('/admin/customerList/walk_in/{stat}', [App\Http\Controllers\CustomerController::class, 'showWalk_in']);
Route::get('/admin/customerList/monthly/{stat}', [App\Http\Controllers\CustomerController::class, 'showMonthly']);
Route::get('/admin/customerList/premium/{stat}', [App\Http\Controllers\CustomerController::class, 'showPremium']);
Route::get('/admin/customer/{id}/detail', [App\Http\Controllers\CustomerController::class, 'show'])->name('customerDetail');
Route::get('/admin/customer/create', [App\Http\Controllers\CustomerController::class, 'create']);
Route::get('/admin/customer/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customerEdit');
Route::put('/admin/customer/{id}/update', [App\Http\Controllers\CustomerController::class, 'update']);

Route::get('/admin/log/{id}/create', [App\Http\Controllers\EntryLogController::class, 'create'])->name('new_entryLog');
Route::get('/admin/log/{id}/edit', [App\Http\Controllers\EntryLogController::class, 'edit'])->name('close_entryLog');

Route::get('/admin/inventoryList', [App\Http\Controllers\InventoryLogController::class, 'showAll']);
Route::get('/admin/inventory/create', [App\Http\Controllers\InventoryLogController::class, 'create']);
Route::get('/admin/inventory/{id}/edit', [App\Http\Controllers\InventoryLogController::class, 'edit']);
Route::put('/admin/inventory/{id}/update', [App\Http\Controllers\InventoryLogController::class, 'update']);
Route::delete('/admin/inventory/{id}/delete', [App\Http\Controllers\InventoryLogController::class, 'destroy']);

Route::get('/admin/orderList', [App\Http\Controllers\OrderController::class, 'order']); 
Route::get('/admin/order/new', [App\Http\Controllers\OrderController::class, 'order']);
Route::get('/admin/order/create', [App\Http\Controllers\OrderController::class, 'create']);
Route::get('/admin/order/renew', [App\Http\Controllers\OrderController::class, 'renew']);
Route::get('/admin/order/customize', [App\Http\Controllers\OrderController::class, 'customize']);
Route::get('/admin/order/trainer', [App\Http\Controllers\OrderController::class, 'trainer']);
Route::get('/admin/order/pay', [App\Http\Controllers\OrderController::class, 'pay']);
Route::get('/admin/order/find', [App\Http\Controllers\OrderController::class, 'find']);
Route::get('/admin/order/{id}/form', [App\Http\Controllers\OrderController::class, 'form'])->name('orderForm');
Route::get('/admin/order/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit']);
Route::put('/admin/order/{id}/update', [App\Http\Controllers\OrderController::class, 'update']);
Route::delete('/admin/order/{id}/delete', [App\Http\Controllers\OrderController::class, 'destroy']);

//for the rates and plans
Route::get('/admin/ratesList', [App\Http\Controllers\MemberTypeController::class, 'showAll']);
Route::get('/admin/rates/create', [App\Http\Controllers\MemberTypeController::class, 'create']);
Route::get('/admin/rates/{id}/edit', [App\Http\Controllers\MemberTypeController::class, 'edit']);
Route::put('/admin/rates/{id}/update', [App\Http\Controllers\MemberTypeController::class, 'update']);
Route::delete('/admin/rates/{id}/delete', [App\Http\Controllers\MemberTypeController::class, 'destroy']);

Route::get('/admin/eventsList', [App\Http\Controllers\EventController::class, 'showAll']);
Route::get('/admin/events/create', [App\Http\Controllers\EventController::class, 'create']);
Route::get('/admin/events/{id}/edit', [App\Http\Controllers\EventController::class, 'edit']);
Route::put('/admin/events/{id}/update', [App\Http\Controllers\EventController::class, 'update']);
Route::delete('/admin/events/{id}/delete', [App\Http\Controllers\EventController::class, 'destroy']);

?>
