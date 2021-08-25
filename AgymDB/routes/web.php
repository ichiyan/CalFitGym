<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();


Route::view('/admin/employeeList', 'admin.employeeList');
Route::view('/facility', 'facility');
Route::get('/products/{item_category}', [App\Http\Controllers\ItemController::class, 'show']);


Route::get('/', [App\Http\Controllers\MemberTypeController::class, 'showAll']);


//test registration
Route::view('/registration', 'auth.register');
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
                ->middleware('guest');

//direct to different pages according to user type after logging in
Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'home']);
});


Route::view('/admin-test/customerList', 'admin.customerList');

// Route::resource('/admin/employeeList/', EmployeeController::class);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function(){
    Route::get('employeeList/all/{stat}', [App\Http\Controllers\EmployeeController::class, 'showAll'])->name('employees');
    Route::get('employeeList/current', [App\Http\Controllers\EmployeeController::class, 'showCurrent']);
    Route::get('employeeList/previous', [App\Http\Controllers\EmployeeController::class, 'showPrevious']);
    Route::get('employee/{id}/detail', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employeeDetail');
    Route::post('employee/create', [App\Http\Controllers\EmployeeController::class, 'create']);
    Route::get('employee/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employeeEdit');
    Route::put('employee/{id}/update', [App\Http\Controllers\EmployeeController::class, 'update']);
    Route::get('employee/{id}/delete', [App\Http\Controllers\EmployeeController::class, 'destroy']);
    Route::get('employee/{id}/rehire', [App\Http\Controllers\EmployeeController::class, 'rehire']);
    Route::get('new/form/employee', function(){
        return view('admin.newEmployeeForm');
    })->name('newEmployee');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin|employee']], function(){
    Route::get('customerList/all/{stat}', [App\Http\Controllers\CustomerController::class, 'showAll']);
    Route::get('customerList/walk_in/{stat}', [App\Http\Controllers\CustomerController::class, 'showWalk_in']);
    Route::get('customerList/monthly/{stat}', [App\Http\Controllers\CustomerController::class, 'showMonthly']);
    Route::get('customerList/premium/{stat}', [App\Http\Controllers\CustomerController::class, 'showPremium']);
    Route::get('customer/{id}/detail', [App\Http\Controllers\CustomerController::class, 'show'])->name('customerDetail');
    Route::post('customer/create', [App\Http\Controllers\CustomerController::class, 'create']);
    Route::get('customer/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customerEdit');
    Route::put('customer/{id}/update', [App\Http\Controllers\CustomerController::class, 'update']);
    Route::get('new/form/customer', function(){
        return view('admin.newCustomerForm');
    })->name('newCustomer');

    Route::get('log/{id}/create', [App\Http\Controllers\EntryLogController::class, 'create'])->name('new_entryLog');
    Route::get('log/{id}/edit', [App\Http\Controllers\EntryLogController::class, 'edit'])->name('close_entryLog');

    Route::get('inventoryList/{category}', [App\Http\Controllers\InventoryLogController::class, 'showAll']);
    Route::get('inventory/create', [App\Http\Controllers\InventoryLogController::class, 'create']);
    Route::get('inventory/{id}/edit', [App\Http\Controllers\InventoryLogController::class, 'edit']);
    Route::put('inventory/{id}/update', [App\Http\Controllers\InventoryLogController::class, 'update']);
    Route::delete('inventory/{id}/delete', [App\Http\Controllers\InventoryLogController::class, 'destroy']);


    Route::get('orderList', [App\Http\Controllers\OrderController::class, 'showAll']);
    Route::get('order/new', [App\Http\Controllers\OrderController::class, 'order']);
    Route::get('order/create', [App\Http\Controllers\OrderController::class, 'create']);
    Route::get('order/renew', [App\Http\Controllers\OrderController::class, 'renew']);
    Route::get('order/customize', [App\Http\Controllers\OrderController::class, 'customize']);
    Route::get('order/variation', [App\Http\Controllers\OrderController::class, 'variation']);
    Route::get('order/trainer', [App\Http\Controllers\OrderController::class, 'trainer']);
    Route::get('order/pay', [App\Http\Controllers\OrderController::class, 'pay'])->name('completeTransaction');
    Route::get('order/find', [App\Http\Controllers\OrderController::class, 'find']);
    Route::get('order/{id}/form', [App\Http\Controllers\OrderController::class, 'form'])->name('orderForm');
    Route::get('order/{id}/show', [App\Http\Controllers\OrderController::class, 'show'])->name('orderDetail');
    Route::get('order/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit']);
    Route::put('order/{id}/update', [App\Http\Controllers\OrderController::class, 'update']);
    Route::delete('order/{id}/delete', [App\Http\Controllers\OrderController::class, 'destroy']);
    Route::delete('order/{id}/cancel', [App\Http\Controllers\OrderController::class, 'cancel']);
    Route::delete('order/{id}/remove_variation', [App\Http\Controllers\OrderController::class, 'remove_variation']);
});


Route::group(['middleware' => ['auth', 'role:admin|employee']], function(){
    // Route::get('/products/{item_category}', [App\Http\Controllers\ItemController::class, 'show']);
    Route::get('/productsList/all', [App\Http\Controllers\ItemController::class, 'showAll'])->name('allProducts');
    Route::post('/products/new/create', [App\Http\Controllers\ItemController::class, 'create']);
    Route::get('/products/new/form', [App\Http\Controllers\ItemController::class, 'form'])->name('productForm');
    Route::get('/products/new/varForm/{id}', [App\Http\Controllers\ItemController::class, 'varForm'])->name('productVarForm');
    Route::post('/products/new/var', [App\Http\Controllers\ItemController::class, 'var'])->name('productVar');
    Route::post('/products/new/create', [App\Http\Controllers\ItemController::class, 'create']);
    Route::post('/remark/new/create', [App\Http\Controllers\RemarkController::class, 'create'])->name('addRemark');
});

Route::group(['prefix' => 'employee', 'middleware' => ['auth', 'role:employee']], function(){
    Route::get('profile', [App\Http\Controllers\EmployeeController::class, 'showProfile'])->name('employeeProfile');
});


Route::group(['middleware' => ['auth', 'role:customer']], function(){
    Route::post('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'changePass'])->name('changePassword');
    Route::get('/cust_prof/{id}', [App\Http\Controllers\CustomerController::class, 'customerShow'])->name('customerProf');
    Route::get('/cust_edit/{id}', [App\Http\Controllers\CustomerController::class, 'customerEdit']);
    Route::put('/cust_edit/{id}/update', [App\Http\Controllers\CustomerController::class, 'customerUpdate'])->name('custUpdate');
    Route::get('/customer/cust_edit', function(){
        return view('customer.cust_edit');
    });
});



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


Route::group(['middleware' => ['auth', 'role:admin|employee']], function(){
    Route::post('/remark/new/create', [App\Http\Controllers\RemarkController::class, 'create']);
});

?>
