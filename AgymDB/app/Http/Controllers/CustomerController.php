<?php 
    namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Basket;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Customize;
use App\Models\Description;
use App\Models\Employee;
use App\Models\EntryLog;
use App\Models\Event;
use App\Models\InventoryLog;
use App\Models\Item;
use App\Models\Membership;
use App\Models\MemberType;
use App\Models\Order;
use App\Models\Person;
use App\Models\Remark;
use App\Models\User;
use App\Models\Variation;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $today = Carbon::today();
        $now = Carbon::now();

        if($request->hasFile('cust_image')){
            $filenameWithExt = $request->file('cust_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cust_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cust_image')->storeAs('public/customers', $fileNameToStore);

        }else{
            $fileNameToStore = null;
        }

        $person = new Person(['fname'=>$request->get('fname'), 'lname'=>$request->get('lname'),
                                'birthday'=>$request->get('birthday'), 'street_address'=>$request->get('street_address'),
                                'barangay'=>$request->get('barangay'),'city'=>$request->get('city'),
                                'email_address'=>$request->get('email_address'),
                                'phone_number'=>$request->get('phone_number'), 'emergency_contact_name'=>$request->get('emergency_contact_name'),
                                'emergency_contact_number'=>$request->get('emergency_contact_number'), 'emergency_contact_relationship'=>$request->get('emergency_contact_relationship'),
                                'photo'=>$fileNameToStore]);
        $person->save();

        $person_id = DB::table('people')->orderBy("id", "desc")->first()->id;

        $customer = new Customer(['id'=>$person_id, 'height'=>$request->get('height'), 'weight'=>$request->get('weight'),
                                    'pre_existing_conditions'=>$request->get('pre_existing_conditions'),
                                    'start_date'=>$today, 'end_date'=>NULL,
                                    'person_id'=>$person_id ]);
        $customer->save();

        $user_id = Auth::id();
        $logger = DB::table('people')->where('user_id', $user_id)->first();
        $init_log = new EntryLog(['entry'=>$now, 'exit'=>$now, 'person_id'=>$person_id, 'logger_id'=>$logger->id]);
        $init_log->save();

        return redirect()->route('orderForm', [$person_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $customer = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('customers.id', $id)
                        ->first();



        $trainer = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->where('employees.id', $customer->assigned_employee_id)
                        ->first();

        $member_type = DB::table('member_types')->where('member_types.id', $customer->member_type_id)->first();


         return view('admin.detailCustomer', compact('customer', 'trainer', 'member_type'));
        //return view('admin-coreUI.detailCustomer', compact('customer'));
    }

    public function customerShow($id)
    {
        //
        
        $customer = DB::table('customers')
                        ->join('people', 'customers.person_id', '=', 'people.id')
                        ->where('customers.id', $id)
                        ->first();
        $orderss = DB::table('orders')
                        ->where('orders.customer_id','=',$customer->id)
                        ->orderBy('order_date', 'desc')
                        ->paginate(5);

        
        $trainer = NULL;
        $member_type = DB::table('member_types')->get();
        $remaining_days = Carbon::now()->diffInDays(Carbon::parse($customer->end_date));
        

        if(Customer::whereId($customer->id)->exists()){
            $customer_details = Customer::findOrFail($customer->id);
            $employee_details = NULL;
            if(Person::whereId($customer_details->assigned_employee_id)->exists()){
                $trainer = Person::findOrFail($customer_details->assigned_employee_id);
            }
        }else{
            $employee_details = Employee::findOrFail($orderss->customer_id);
            $customer_details = NULL;
        }

        

            $basket = DB::table('baskets')->get();
            $memberships = DB::table('memberships')->get();
        
        $products = DB::table('items')->get();
        $customizations = DB::table('customizes')->get();
        $variations = DB::table('variations')->get();
        $chosen_var = DB::table('variations')->join('basket_variation', 'variations.id', 'basket_variation.variation_id')->get();
        $variation_category = DB::table('variation_categories')->get();
        

         return view('/customer/customer_profile', compact(  'customer', 'trainer', 'member_type','remaining_days','orderss','customer_details', 'employee_details',
                                                    'basket', 'products', 'trainer','customizations', 'variations', 'chosen_var',
                                                    'variation_category', 'memberships'));
        //return view('admin-coreUI.detailCustomer', compact('customer'));
    }

    public function customerEdit($id)
    {
        //
        $customer = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('customers.id', $id)
                        ->first();


         return view('/customer/cust_edit', compact('customer'));
        //return view('admin-coreUI.editCustomerForm', compact('customer'));
    }

    public function customerUpdate($id, Request $request)
    {


        $customer = Customer::findOrFail($id);
        $customer->height = $request->get('height');
        $customer->weight = $request->get('weight');
        $customer->save();

        $person = Person::findOrFail($id);
        $person->fname = $request->get('fname');
        $person->lname = $request->get('lname');
        $person->birthday = $request->get('birthday');
        $person->street_address = $request->get('street_address');
        $person->barangay = $request->get('barangay');
        $person->city = $request->get('city');
        $person->email_address = $request->get('email_address');
        $person->phone_number = $request->get('phone_number');

        if($request->hasFile('cust_image')){
            $filenameWithExt = $request->file('cust_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cust_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cust_image')->storeAs('public/customers', $fileNameToStore);
            $person->photo = $fileNameToStore;
        }


        $person->save();

        return redirect()->route('customerProf',[$id]);
    }

    public function showAll($filter)
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->get();

        $age = array();
        foreach ($customers as $num => $customer) {
            $age[$num] = Carbon::parse($customer->birthday)->age;
        }

        $member_type = DB::table('member_types')->get();

        $today = Carbon::today();

        $log = array();
        foreach ($customers as $key => $customer) {
            $log[$key] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
        }


        $countAll = $countWalkIn = $countMonthly = $countPremium = $count = 0;

        $countAll = DB::table('customers')->count();
        $countWalkIn = DB::table('customers')->where('member_type_id', 1)->count();
        $countMonthly = DB::table('customers')->where('member_type_id', 2)->count();
        $countPremium = DB::table('customers')->where('member_type_id', 3)->count();

        if($filter == 'inactive'){
             $file = 'admin.allCustomerListI';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) <= 0){
                    $count++;
                }
            }
        } else if($filter == 'active'){
             $file = 'admin.allCustomerListA';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) > 0){
                    $count++;
                }
            }
        } else if($filter == 'logged_in') {
            $file = 'admin.allCustomerListLI';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) > 0 && $log[$key]->exit == NULL){
                    $count++;
                }
            }

        } else if($filter == 'logged_out') {
            $file = 'admin.allCustomerListLO';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) > 0 && $log[$key]->exit != NULL){
                    $count++;
                }
            }

        }else{
            $file = 'admin.allCustomerList';
        }

        return view($file, compact('customers', 'age', 'log', 'member_type' ,'countAll', 'countWalkIn', 'countMonthly' ,'countPremium', 'count', 'today'));
        //return view('admin.customerList', compact('customers', 'age', 'log', 'countAll', 'member_type', 'today'));
        // return view('admin-coreUI.customerList', compact('customers', 'age', 'log', 'count', 'member_type', 'today'));
    }

    public function showWalk_in($filter)
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('member_type_id', 1)
                        ->get();

        $today = Carbon::today();

        $log = array();
        foreach ($customers as $value => $customer) {
            $log[$value] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
        }

        $countAll = $countWalkIn = $countMonthly = $countPremium = $count = 0;

        $countAll = DB::table('customers')->count();
        $countWalkIn = DB::table('customers')->where('member_type_id', 1)->count();
        $countMonthly = DB::table('customers')->where('member_type_id', 2)->count();
        $countPremium = DB::table('customers')->where('member_type_id', 3)->count();

        if($filter == 'inactive'){
             $file = 'admin.walkinCustomerListI';
            // $file = 'admin-coreUI.walkinCustomerListI';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) <= 0){
                    $count++;
                }
            }
        } else if($filter == 'active'){
             $file = 'admin.walkinCustomerListA';
            // $file = 'admin-coreUI.walkinCustomerListA';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) > 0){
                    $count++;
                }
            }
        } else {
            $file = 'admin.walkinCustomerList';
            // $file = 'admin-coreUI.walkinCustomerList';
        }

        return view($file, compact('customers', 'log', 'countAll', 'countWalkIn', 'countMonthly' ,'countPremium', 'count',  'today'));
    }

    public function showMonthly($filter)
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('member_type_id', 2)
                        ->get();

        $age = array();
        foreach ($customers as $value => $customer) {
            $age[$value] = Carbon::parse($customer->birthday)->age;
        }

        $today = Carbon::today();

        $log = array();
        foreach ($customers as $value => $customer) {
            $log[$value] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
        }

        $countAll = $countWalkIn = $countMonthly = $countPremium = $count = 0;

        $countAll = DB::table('customers')->count();
        $countWalkIn = DB::table('customers')->where('member_type_id', 1)->count();
        $countMonthly = DB::table('customers')->where('member_type_id', 2)->count();
        $countPremium = DB::table('customers')->where('member_type_id', 3)->count();

        if($filter == 'inactive'){
            $file = 'admin.monthlyCustomerListI';
           // $file = 'admin-coreUI.monthlyCustomerListI';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) <= 0){
                    $count++;
                }
            }
        } else if($filter == 'active'){
             $file = 'admin.monthlyCustomerListA';
            //$file = 'admin-coreUI.monthlyCustomerListA';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) > 0){
                    $count++;
                }
            }
        } else {
            $file = 'admin.monthlyCustomerList';
            //$file = 'admin-coreUI.monthlyCustomerList';
        }

        return view($file, compact('customers', 'age', 'log', 'countAll', 'countWalkIn', 'countMonthly' ,'countPremium', 'count', 'today'));
    }

    public function showPremium($filter)
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('member_type_id', 3)
                        ->get();

        $age = array();
        foreach ($customers as $value => $customer) {
            $age[$value] = Carbon::parse($customer->birthday)->age;
        }

        $today = Carbon::today();

        $log = array();
        $trainers = array();
        foreach ($customers as $value => $customer) {
            $log[$value] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
            $trainers[$value] = DB::table('people')->where('id', $customer->assigned_employee_id)->first();
        }

        $countAll = $countWalkIn = $countMonthly = $countPremium = $count = 0;

        $countAll = DB::table('customers')->count();
        $countWalkIn = DB::table('customers')->where('member_type_id', 1)->count();
        $countMonthly = DB::table('customers')->where('member_type_id', 2)->count();
        $countPremium = DB::table('customers')->where('member_type_id', 3)->count();

        if($filter == 'inactive'){
            $file = 'admin.premiumCustomerListI';
            //$file = 'admin-coreUI.premiumCustomerListI';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) <= 0){
                    $count++;
                }
            }
        } else if($filter == 'active'){
            $file = 'admin.premiumCustomerListA';
            //$file = 'admin-coreUI.premiumCustomerListA';
            foreach ($customers as $customer){
                if($today->diffInDays($customer->end_date, false) > 0){
                    $count++;
                }
            }
        } else {
            $file = 'admin.premiumCustomerList';
            //$file = 'admin-coreUI.premiumCustomerList';
        }

        return view($file, compact('customers', 'age', 'log', 'trainers', 'countAll', 'countWalkIn', 'countMonthly' ,'countPremium','count', 'today'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $customer = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('customers.id', $id)
                        ->first();

        $trainer = DB::table('employees')
                        ->join('people', 'employees.id', '=', 'people.id')
                        ->where('employees.id', $customer->assigned_employee_id)
                        ->first();


         return view('admin.editCustomerForm', compact('customer', 'trainer'));
        //return view('admin-coreUI.editCustomerForm', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $customer = Customer::findOrFail($id);
        $customer->height = $request->get('height');
        $customer->weight = $request->get('weight');
        $customer->pre_existing_conditions = $request->get('pre_existing_conditions');
        $customer->save();

        $person = Person::findOrFail($id);
        $person->fname = $request->get('fname');
        $person->lname = $request->get('lname');
        $person->birthday = $request->get('birthday');
        $person->street_address = $request->get('street_address');
        $person->barangay = $request->get('barangay');
        $person->city = $request->get('city');
        $person->email_address = $request->get('email_address');
        $person->phone_number = $request->get('phone_number');
        $person->emergency_contact_name = $request->get('emergency_contact_name');
        $person->emergency_contact_number = $request->get('emergency_contact_number');
        $person->emergency_contact_relationship = $request->get('emergency_contact_relationship');

        if($request->hasFile('cust_image')){
            $filenameWithExt = $request->file('cust_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cust_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cust_image')->storeAs('public/customers', $fileNameToStore);
            $person->photo = $fileNameToStore;
        }


        $person->save();

        return redirect()->route('customerDetail', [$id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
