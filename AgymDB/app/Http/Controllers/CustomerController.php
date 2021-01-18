<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        $person = new Person(['fname'=>$request->get('fname'), 'lname'=>$request->get('lname'),
                                'birthday'=>$request->get('birthday'), 'street_address'=>$request->get('street_address'),
                                'city'=>$request->get('city'), 'email_address'=>$request->get('email_address'),
                                'phone_number'=>$request->get('phone_number'), 'emergency_contact_name'=>$request->get('emergency_contact_name'),
                                'emergency_contact_number'=>$request->get('emergency_contact_number'), 'emergency_contact_relationship'=>$request->get('emergency_contact_relationship'),
                                'photo'=>NULL, 'user_id'=>$request->get('user_id') ]);
        $person->save();

        $person_id = DB::table('people')->orderBy("id", "desc")->first()->id;

        $customer = new Customer(['id'=>$person_id, 'height'=>$request->get('height'), 'weight'=>$request->get('weight'),
                                    'pre_existing_conditions'=>$request->get('pre_existing_conditions'), 'person_id'=>$person_id ]);
        $customer->save();

        $membershipHistory = new MembershipHistory (['start_date'=>$today, 'end_date'=>$today, 'customer_id'=>$person_id]);
        $membershipHistory->save();

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
                        ->get();
        return view('admin.detailCustomer', compact('customer'));
    }

    public function showAll()
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->get();

        $count = 0;
        $count = DB::table('customers')->count();

        $age = array();
        foreach ($customers as $num => $customer) {
            $age[$num] = Carbon::parse($customer->birthday)->age;
        }

        $member_type = DB::table('member_types')->get();

        $today = Carbon::today();
        $membershipStatus = array();
        foreach ($customers as $value => $customer) {
            $status = DB::table('membership_histories')->where('customer_id', $customer->id)->get();
            if($today->diffInDays($status[0]->end_date, false) > 0){
                $membershipStatus[$value] = 'ACTIVE';
            } else {
                $membershipStatus[$value] = 'INACTIVE';
            }
        }

        $log = array();
        foreach ($customers as $key => $customer) {
            $log[$key] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
        }

        return view('admin.customerList', compact('customers', 'age', 'log', 'count', 'member_type', 'membershipStatus'));
    }

    public function showWalk_in($filter)
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('member_type_id', 1)
                        ->get();

        $today = Carbon::today();
        $membershipStatus = array();
        foreach ($customers as $value => $customer) {
            $status = DB::table('membership_histories')->where('customer_id', $customer->id)->get();
            if($today->diffInDays($status[0]->end_date, false) > 0){
                $membershipStatus[$value] = 'ACTIVE';
            } else {
                $membershipStatus[$value] = 'INACTIVE';
            }
        }

        $count = 0;
        $count = DB::table('customers')->where('member_type_id', 1)->count();

        $log = array();
        foreach ($customers as $value => $customer) {
            $log[$value] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
        }

        if($filter == 'inactive'){
            $file = 'admin.walkinCustomerListI';
        } else if($filter == 'active'){
            $file = 'admin.walkinCustomerListA';
        } else {
            $file = 'admin.walkinCustomerList';
        }

        return view($file, compact('customers', 'log', 'count', 'membershipStatus'));
    }

    public function showMonthly($filter)
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('member_type_id', 2)
                        ->get();

        $count = 0;
        $count = DB::table('customers')->where('member_type_id', 2)->count();

        $age = array();
        foreach ($customers as $value => $customer) {
            $age[$value] = Carbon::parse($customer->birthday)->age;
        }

        $today = Carbon::today();
        $membershipStatus = array();
        $status = DB::table('membership_histories')->get();
        foreach($status as $value => $stat){
            if($today->diffInDays($stat->end_date, false) > 0){
                $membershipStatus[$value] = 'ACTIVE';
            } else {
                $membershipStatus[$value] = 'INACTIVE';
            }
        }

        $log = array();
        foreach ($customers as $value => $customer) {
            $log[$value] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
        }

        if($filter == 'inactive'){
            $file = 'admin.monthlyCustomerListI';
        } else if($filter == 'active'){
            $file = 'admin.monthlyCustomerListA';
        } else {
            $file = 'admin.monthlyCustomerList';
        }

        return view($file, compact('customers', 'age', 'log', 'count', 'membershipStatus'));
    }

    public function showPremium($filter)
    {
        //
        $customers = DB::table('customers')
                        ->join('people', 'customers.id', '=', 'people.id')
                        ->where('member_type_id', 3)
                        ->get();

        $count = 0;
        $count = DB::table('customers')->where('member_type_id', 3)->count();

        $age = array();
        foreach ($customers as $value => $customer) {
            $age[$value] = Carbon::parse($customer->birthday)->age;
        }

        $today = Carbon::today();
        $membershipStatus = array();
        $status = DB::table('membership_histories')->get();
        foreach($status as $value => $stat){
            if($today->diffInDays($stat->end_date, false) > 0){
                $membershipStatus[$value] = 'ACTIVE';
            } else {
                $membershipStatus[$value] = 'INACTIVE';
            }
        }

        $log = array();
        $trainers = array();
        foreach ($customers as $value => $customer) {
            $log[$value] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
            $trainers[$value] = DB::table('people')->where('id', $customer->assigned_employee_id)->first();
        }

        if($filter == 'inactive'){
            $file = 'admin.premiumCustomerListI';
        } else if($filter == 'active'){
            $file = 'admin.premiumCustomerListA';
        } else {
            $file = 'admin.premiumCustomerList';
        }

        return view($file, compact('customers', 'age', 'log', 'trainers', 'count', 'membershipStatus'));
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
                        ->get();
        return view('admin.editCustomerForm', compact('customer'));
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
        $person->city = $request->get('city');
        $person->email_address = $request->get('email_address');
        $person->phone_number = $request->get('phone_number');
        $person->emergency_contact_name = $request->get('emergency_contact_name');
        $person->emergency_contact_number = $request->get('emergency_contact_number');
        $person->emergency_contact_relationship = $request->get('emergency_contact_relationship');
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
