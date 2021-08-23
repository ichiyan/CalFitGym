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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function index()
    // {
    //     return view('admin.home');
    // }

    public function home(){
        //


        if(Auth::user()->hasRole('customer')){

            $personId = Person::where('user_id', Auth::user()->id)->pluck('id');

            $customer = DB::table('customers')
                ->join('people', 'customers.person_id', '=', 'people.id')
                ->where('customers.id', $personId)
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

        }elseif(Auth::user()->hasRole('admin')){
            $today = Carbon::today();
            $tomorrow = Carbon::tomorrow();
            $monthAgo = Carbon::today()->subMonth();
            $yearAgo = Carbon::today()->subYear();

            //for pie chart
            $member_type = DB::table('member_types')->get();
            $data = [];
            foreach($member_type as $type){
                $data['label'][] = $type->member_type_name;
                $data['data'][] = DB::table('customers')->where('member_type_id', $type->id)->where('end_date', '>', $today)->count();
            }
            $data['chart_data'] = json_encode($data);
            //end of pie chart data

            //for line graph
            $graph = [];
            $start = Carbon::today()->subMonths(10);
            $end = Carbon::today()->subMonths(9);
            for($x=0; $x<12; $x++){
                $graph['label'][$x] = $start->shortEnglishMonth;
                $graph['data'][$x] = Order::whereBetween('order_date', [$start, $end])->sum('total_price');
                $start = $end;
                $end = $end->addMonth();
            }
            $graph['chart_data'] = json_encode($graph);
            //end of line graph data

            $day_earnings = Order::whereBetween('order_date', [$today, $tomorrow])->sum('total_price');
            $monthly_earnings = Order::whereBetween('order_date', [$monthAgo, $today])->sum('total_price');
            $annual_earnings = Order::whereBetween('order_date', [$yearAgo, $today])->sum('total_price');

            $customers = Customer::get();
            $logged_customer = 0;
            foreach($customers as $customer){ //to exclude entry log of employees
                if(EntryLog::whereBetween('entry', [$today, $tomorrow])->where('person_id', $customer->id)->exists()){
                    $logged_customer++;
                }
            }

            $near_expiry = DB::table('customers')
                            ->join('people', 'customers.id', '=', 'people.id')
                            ->get();
            $log = array();
            foreach ($near_expiry as $key => $customer) {
                $log[$key] = DB::table('entry_logs')->orderBy('id', 'desc')->where('person_id', $customer->id)->first();
            }

            $products = DB::table('items')->get();
            $batches = Batch::where('amt_left_batch', '>', 0)
                            ->orderBy("item_id", "asc")
                            ->get();
            $small_stock = Batch::where('amt_left_batch', '>', 0)
                            ->orderBy("item_id", "asc")
                            ->get();

            return view('admin.dashboard', compact('day_earnings', 'monthly_earnings', 'annual_earnings',
                                                    'logged_customer', 'today', 'graph',
                                                    'data', 'near_expiry', 'member_type', 'log', 'batches', 'products',
                                                    'small_stock'));
        }
    }
}
