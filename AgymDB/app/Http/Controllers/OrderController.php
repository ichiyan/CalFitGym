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

class OrderController extends Controller
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
        $customer = Person::findOrFail($request->get('person_id'));
        $product = Item::findOrFail($request->get('product_id'));
        $order = Order::findOrFail($request->get('order_id'));

        $basket = new Basket(['quantity'=>$request->get('quantity'), 'order_id'=>$request->get('order_id'),
                            'item_id'=>$request->get('product_id'), 'customize_id'=>NULL,
                            'membership_id'=>NULL ]);
        $basket->save();

        $new_basket = DB::table('baskets')->orderBy("id", "desc")->first();
        $order->total_price += ($product->price * $new_basket->quantity);
        $order->save();

        //return redirect('/admin/order/{{$customer->id}}/form');
        return redirect()->route('orderForm', [$customer->id]);
    }

    public function trainer(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));
        $customer->assigned_employee_id = $request->get('trainer');
        $customer->save();

        $trainer = Employee::findOrFail($request->get('trainer'));
        $trainer->no_of_trainees++;
        $trainer->save();
        return redirect()->route('orderForm', [$customer->id]);
    }

    public function renew(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));
        $order = Order::findOrFail($request->get('order_id'));
        $membership_history = DB::table('membership_histories')->where('customer_id', $customer->id)->first();

        $membership = new Membership(['member_type_id'=>$request->get('membership_type_id'),
                                        'membership_history_id'=>$membership_history->id,
                                        'order_id'=>$request->get('order_id')]);
        $membership->save();

        $membership_type = DB::table('member_types')->where('id', $request->get('membership_type_id'))->first();
        $date = Carbon::today();
        $date->addDays($membership_type->length);
        $membership_history->end_date = $date;
        
        $membership_id = DB::table('memberships')->orderBy("id", "desc")->first()->id;
        $basket = new Basket(['quantity'=>$request->get('quantity'), 'order_id'=>$request->get('order_id'),
                            'item_id'=>NULL, 'customize_id'=>NULL,
                            'membership_id'=>$membership_id ]);
        $basket->save();

        $new_basket = DB::table('baskets')->orderBy("id", "desc")->first();
        $order->total_price = $order->total_price + ($membership_type->member_type_price * $new_basket->quantity);
        $order->save();

        return redirect()->route('orderForm', [$customer->id]);
    }

    public function customize(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));

        $customize = new Customize (['color'=>$request->get('color'), 'message'=>$request->get('message')]);
        $customize->save();
        $customize_id = DB::table('customizes')->orderBy("id", "desc")->first()->id;

        $basket = Basket::findOrFail($request->get('item_id'));
        $basket->customize_id = $customize_id;
        $basket->save();
        
        return redirect()->route('orderForm', [$customer->id]);
    }

    public function pay(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));
        $order = Order::findOrFail($request->get('order_id'));
        $order->amount_recieved = $request->get('payment');
        $order->change = $request->get('payment') - $order->total_price;
        return redirect()->route('orderDetail', [$customer->id]);
    }

    public function order()
    {
        //
        $id = NULL;
        return $this->form($id);
    }

    public function form($id)
    {
        //
        $order_id = NULL;
        $basket = NULL;
        $memberships = NULL;
        $customizations = NULL;
        $total_price = 0;
        
        $products = DB::table('items')->get();
        $customizations = DB::table('customizes')->get();
        $member_type = DB::table('member_types')->get();
        $trainers = DB::table('employees')->join('people', 'employees.id', '=', 'people.id')->get();

        if($id == NULL){ //customer hasn't been selected yet
            $customer = NULL;
        } else {
            $customer = Person::findOrFail($id);

            if(DB::table('orders')->count() > 0){
                $oldOrder = DB::table('orders')->orderBy("id", "desc")->first();
                if($oldOrder->total_price == 0){  //changes customer_id in order entry from previous search if it wasn't used
                    $old = Order::findOrFail($oldOrder->id);
                    $order_id = $oldOrder->id;
                    $old->customer_id = $customer->id;
                    $old->save();
                    $total_price = $old->total_price;
                } else if ($oldOrder->total_price != 0 && $oldOrder->amount_received != 0){  //new order
                    $user_id = Auth::id();
                    $now = Carbon::now();
                    $order = new Order(['amount_received'=>0, 'total_price'=>0, 'change'=>0, 'order_date'=>$now, 'customer_id'=>$customer->id, 'employee_id'=>$user_id ]);
                    $order->save();
                    $order_id = DB::table('orders')->orderBy("id", "desc")->first()->id;
                    $total_price = DB::table('orders')->orderBy("id", "desc")->first()->total_price;
                } else if ($oldOrder->total_price != 0 && $oldOrder->amount_received == 0){  //for ongoing order process
                    $order_id = $oldOrder->id;
                    $total_price = Order::findOrFail($order_id)->total_price;
                    $basket = DB::table('baskets')->where('order_id', $order_id)->get();
                    $memberships = DB::table('memberships')->where('order_id', $order_id)->get();
                    $customizations = DB::table('customizes')->get();
                }
            } else { //if table was empty
                $user_id = Auth::id();
                $now = Carbon::now();
                $order = new Order(['amount_received'=>0, 'total_price'=>0, 'change'=>0, 'order_date'=>$now, 'customer_id'=>$id, 'employee_id'=>$user_id ]);
                $order->save();
                $order_id = DB::table('orders')->orderBy("id", "desc")->first()->id;
                $total_price = DB::table('orders')->orderBy("id", "desc")->first()->total_price;
            }
        }
        

        return view('admin.orderForm', compact('id', 'customer', 'trainers', 'total_price', 'products', 'order_id', 'basket', 'customizations', 'member_type', 'memberships'));
    }
    
    public function find(Request $request)
    {
        //
        if ($request->get('id') != NULL){
            $customer = DB::table('people')
                        ->where('id', $request->get('id'))
                        ->first();
        } else if ($request->get('fname') != NULL){
            $customer = DB::table('people')
                        ->where('fname', $request->get('fname'))
                        ->first();
        } else if ($request->get('lname') != NULL){
            $customer = DB::table('people')
                        ->where('lname', $request->get('lname'))
                        ->first();
        } else {
            $customer = new Person;
            $customer->id = 0;
        }

        return redirect()->route('orderForm', [$customer->id]);
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
        $products = DB::table('items')->get();
        $customizations = DB::table('customizes')->get();
        $member_type = DB::table('member_types')->get();
        $trainers = DB::table('employees')->join('people', 'employees.id', '=', 'people.id')->get();
        return view('admin.orderForm', compact('customer', 'trainers', 'member_type', 'memberships'));
    }

    public function showAll()
    {
        return view('admin.orderForm');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $product = Basket::findOrFail($id);
        $order = Order::findOrFail($request->get('order_id'));

        if($product->item_id != NULL){
            $item = Item::findOrFail($product->item_id);
            $order->total_price -= ($item->price * $product->quantity);
            $order->save();
            if($product->customize_id != NULL){
                Customize::destroy($product->customize_id);
            }
        } else {
            $membership = Membership::findOrFail($product->membership_id);
            $mem_type = MemberType::findOrFail($membership->member_type_id);
            $history = MembershipHistory::findOrFail($membership->membership_history_id);
            
            $date = Carbon::today();
            $date->subDays($mem_type->length);
            $history->end_date = $date;
            $history->save();

            $order->total_price -= ($mem_type->member_type_price * $product->quantity);
            $order->save();
            Membership::destroy($product->membership_id);
        }
        

        Basket::destroy($id);
        $customer = Person::findOrFail($request->get('person_id'));

        return redirect()->route('orderForm', [$customer->id]);
    }
}
