<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Basket;
use App\Models\Batch;
use App\Models\Category;
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
use App\Models\VariationCategory;

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
        //new order of a product
        $date = Carbon::today();
        $customer = Person::findOrFail($request->get('person_id'));
        $product = Item::findOrFail($request->get('product_id'));
        $order = Order::findOrFail($request->get('order_id'));

        //creates an inventory log for today if it doesn't exist
        if(InventoryLog::where('checking_date', $date)->where('item_id', $product->id)->doesntExist()){
            //sums up the batch entries for inventory
            $batch_sum = Batch::where('item_id', $request->get('product_id'))
                        ->where('amt_left_batch', '>', 0)
                        ->sum('amt_left_batch');
            
            //hasn't been adjusted to the new sale
            $new_inventory = new InventoryLog (['checking_date'=>$date, 'amount_left'=>$batch_sum,
                                                'amount_sold'=>0, 'item_id'=>$request->get('product_id'),]);
            $new_inventory->save();
        }

        //updates the inventory entry to account for the new sale
        $inventory = InventoryLog::where('checking_date', $date)
                        ->where('item_id', $request->get('product_id'))
                        ->orderBy("id", "desc")
                        ->first();
        $inventory->amount_left =  $inventory->amount_left - $request->get('quantity');
        $inventory->amount_sold = $inventory->amount_sold + $request->get('quantity');
        $inventory->save();

        //batch table update
        $batches = Batch::where('item_id', $request->get('product_id'))
                        ->where('amt_left_batch', '>', 0)
                        ->orderBy("id", "asc")
                        ->first();
        $batches->amt_left_batch = $batches->amt_left_batch - $request->get('quantity');
        $batches->save();

        $basket = new Basket(['quantity'=>$request->get('quantity'), 'order_id'=>$request->get('order_id'),
                            'item_id'=>$request->get('product_id'), 'batch_id'=>$batches->id,
                            'customize_id'=>NULL, 'variation_id'=>NULL,
                            'membership_id'=>NULL ]);
        $basket->save();

        $new_basket = Basket::orderBy("id", "desc")->first();
        if($product->has_different_prices == 0){  //price is as listed on items table
            $order->total_price = $order->total_price + ($product->price * $new_basket->quantity);
            $order->save();
        }

        return redirect()->route('orderForm', [$customer->id]);
    }
    
    public function variation(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));
        $basket = Basket::findOrFail($request->get('basket_item_id'));
        $product = Item::findOrFail($basket->item_id);
        $order = Order::findOrFail($basket->order_id);
        $variation_category = DB::table('variation_categories')->get();

        foreach($variation_category as $var_cat){
            if($request->get($var_cat->category_name) != NULL){
                $variation = Variation::findOrFail($request->get($var_cat->category_name));
                if($product->has_different_prices == 1 && $var_cat->price_priority == 1){
                    $order->total_price = $order->total_price + ($variation->price * $basket->quantity);
                    $order->save();
                }
                $variation->chosenProduct()->attach($request->get('basket_item_id'));
            } 
        }

        return redirect()->route('orderForm', [$customer->id]);
    }
    
    public function remove_variation(Request $request, $id)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));
        $basket = Basket::findOrFail($request->get('basket_item_id'));
        $product = Item::findOrFail($basket->item_id);
        $order = Order::findOrFail($basket->order_id);
        $basket_var = DB::table('basket_variation')->whereId($id)->first();
        $var = Variation::findOrFail($basket_var->variation_id);
        $var_cat = VariationCategory::findOrFail($var->variation_category_id);

        if($product->has_different_prices == 1 && $var_cat->price_priority == 1){
            $order->total_price = $order->total_price - ($var->price * $basket->quantity);
            $order->save();
        }
        $variation = DB::table('basket_variation')->whereId($id)->delete();

        return redirect()->route('orderForm', [$customer->id]);
    }

    public function customize(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));

        $customize = new Customize (['color'=>$request->get('color'), 'message'=>$request->get('message')]);
        $customize->save();
        $customize_id = Customize::orderBy("id", "desc")->first()->id;

        $basket = Basket::findOrFail($request->get('basket_item_id'));
        $basket->customize_id = $customize_id;
        $basket->save();
        
        return redirect()->route('orderForm', [$customer->id]);
    }

    public function renew(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));
        $customer_details = Customer::findOrFail($request->get('person_id'));
        $order = Order::findOrFail($request->get('order_id'));

        $membership = new Membership(['member_type_id'=>$request->get('membership_type_id'),
                                    'customer_id'=>$request->get('person_id'),
                                    'order_id'=>$request->get('order_id'),
                                    'trainer_id'=>NULL ]);
        $membership->save();

        $membership_type = DB::table('member_types')->where('id', $request->get('membership_type_id'))->first();
        $date = Carbon::today();
        $date->addDays($membership_type->length);
        $customer_details->end_date = $date;
        $customer_details->member_type_id = $membership_type->id;
        $customer_details->save();
        
        $membership_id = DB::table('memberships')->orderBy("id", "desc")->first()->id;
        $basket = new Basket(['quantity'=>1, 'order_id'=>$request->get('order_id'),
                            'item_id'=>NULL, 'batch_id'=>NULL,
                            'customize_id'=>NULL, 'variation_id'=>NULL,
                            'membership_id'=>$membership_id ]);
        $basket->save();

        $new_basket = DB::table('baskets')->orderBy("id", "desc")->first();
        $order->total_price = $order->total_price + ($membership_type->member_type_price * $new_basket->quantity);
        $order->save();

        return redirect()->route('orderForm', [$customer->id]);
    }

    public function trainer(Request $request)
    {
        //
        $customer = Customer::findOrFail($request->get('person_id'));
        $customer->assigned_employee_id = $request->get('trainer');
        $customer->save();

        $membership = Membership::findOrFail($request->get('membership_id'));
        $membership->trainer_id = $request->get('trainer');
        $membership->save();

        $trainer = Employee::findOrFail($request->get('trainer'));
        $trainer->no_of_trainees++;
        $trainer->save();
        return redirect()->route('orderForm', [$customer->id]);
    }

    public function pay(Request $request)
    {
        //
        $customer = Person::findOrFail($request->get('person_id'));
        $order = Order::findOrFail($request->get('order_id'));
        $order->amount_received = $request->get('payment');
        $order->change = $request->get('payment') - $order->total_price;
        $order->save();
        return redirect()->route('orderDetail', [$request->get('order_id')]);
    }

    public function order()
    {
        //no search has been done
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
        $variations = DB::table('variations')->get();
        $chosen_var = DB::table('variations')->join('basket_variation', 'variations.id', 'basket_variation.variation_id')->get();
        $variation_category = DB::table('variation_categories')->get();
        
        $batches = array();
        foreach($products as $key => $product){
            $batches[$product->id] = Batch::where('item_id', $product->id)
                        ->where('amt_left_batch', '>', 0)
                        ->sum('amt_left_batch');
        }
        
        if($id == NULL || $id==0){ //customer hasn't been selected yet or can't be found
            $person = NULL;
            $customer_details = NULL;
            $employee_details = NULL;
        } else {
            $person = Person::findOrFail($id);
            if(Customer::whereId($id)->exists()){
                $customer_details = Customer::findOrFail($id);
                $employee_details = NULL;
            }else{
                $employee_details = Employee::findOrFail($id);
                $customer_details = NULL;
            }
            if(DB::table('orders')->count() > 0){
                $oldOrder = DB::table('orders')->orderBy("id", "desc")->first();
                if($oldOrder->total_price == 0){  //changes customer_id in order entry from previous search if it wasn't used
                    $old = Order::findOrFail($oldOrder->id);
                    $order_id = $oldOrder->id;
                    $old->customer_id = $person->id;
                    $old->save();
                    $total_price = $old->total_price;
                } else if ($oldOrder->total_price != 0 && $oldOrder->amount_received != 0){  //new order
                    $user_id = Auth::id();
                    $now = Carbon::now();
                    $order = new Order(['amount_received'=>0, 'total_price'=>0, 'change'=>0, 'order_date'=>$now, 'customer_id'=>$person->id, 'employee_id'=>$user_id ]);
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

        return view('admin.orderForm', compact('id', 'person', 'customer_details', 'employee_details', 
                                                'variations', 'variation_category', 'chosen_var', 'trainers', 
                                                'total_price', 'products', 'order_id', 'basket', 'batches',
                                                'customizations', 'member_type', 'memberships'));
    }
    
    public function find(Request $request)
    {
        //
        $id = 0;

        if ($request->get('id') != NULL && DB::table('people')->where('id', $request->get('id'))->exists()){
            $id = DB::table('people')
                        ->where('id', $request->get('id'))
                        ->first()->id;
        } else if ($request->get('fname') != NULL && DB::table('people')->where('fname', $request->get('fname'))->exists()){
            $id = DB::table('people')
                        ->where('fname', $request->get('fname'))
                        ->first()->id;
        } else if ($request->get('lname') != NULL && DB::table('people')->where('lname', $request->get('lname'))->exists()){
            $id = DB::table('people')
                        ->where('lname', $request->get('lname'))
                        ->first()->id;
        }

        return redirect()->route('orderForm', [$id]);
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
        $order = Order::findOrFail($id);
        $customer = Person::findOrFail($order->customer_id);
        $trainer = NULL;

        if(Customer::whereId($order->customer_id)->exists()){
            $customer_details = Customer::findOrFail($order->customer_id);
            $employee_details = NULL;
            if(Person::whereId($customer_details->assigned_employee_id)->exists()){
                $trainer = Person::findOrFail($customer_details->assigned_employee_id);
            }
        }else{
            $employee_details = Employee::findOrFail($order->customer_id);
            $customer_details = NULL;
        }

        $basket = Basket::where('order_id', $order->id)->get();
        $products = DB::table('items')->get();
        $customizations = DB::table('customizes')->get();
        $member_type = DB::table('member_types')->get();
        $variations = DB::table('variations')->get();
        $chosen_var = DB::table('variations')->join('basket_variation', 'variations.id', 'basket_variation.variation_id')->get();
        $variation_category = DB::table('variation_categories')->get();
        $memberships = DB::table('memberships')->where('order_id', $order->id)->get();
        
        return view('admin.orderDetails', compact('order', 'customer', 'customer_details', 'employee_details',
                                                    'basket', 'products', 'trainer', 'member_type', 
                                                    'customizations', 'variations', 'chosen_var', 
                                                    'variation_category', 'memberships'));
    }

    public function showAll()
    {
        $orders = Order::where('amount_received', '>', 0)->get();
        $buyers = DB::table('people')->get();

        $count = array();
        foreach($orders as $key => $order){
            $count[$key] = Basket::where('order_id', $order->id)->count();
        }
        return view('admin-coreUI.orderList', compact('orders', 'buyers', 'count'));
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
        //remove item from order
        $date = Carbon::today();
        $basket_item = Basket::findOrFail($id);
        $order = Order::findOrFail($request->get('order_id'));
        $customer = Person::findOrFail($request->get('person_id'));

        if($basket_item->item_id != NULL){ //order contained a product
            $item = Item::findOrFail($basket_item->item_id);
            $batch = Batch::findOrFail($basket_item->batch_id);
            $inventory = InventoryLog::where('checking_date', $date)
                            ->where('item_id', $basket_item->item_id)
                            ->orderBy("id", "desc")
                            ->first();

            $order->total_price -= ($item->price * $basket_item->quantity);
            $order->save();

            $batch->amt_left_batch = $batch->amt_left_batch + $basket_item->quantity;
            $batch->save();

            $inventory->amount_left = $inventory->amount_left + $basket_item->quantity;
            $inventory->amount_sold = $inventory->amount_sold - $basket_item->quantity;
            $inventory->save();

            if($basket_item->customize_id != NULL){
                Customize::destroy($basket_item->customize_id);
            }
        } else if($basket_item->membership_id != NULL){ //order contained a membership
            $membership = Membership::findOrFail($basket_item->membership_id);
            $mem_type = MemberType::findOrFail($membership->member_type_id);
            $customer_details = Customer::findOrFail($request->get('person_id'));
            
            $date->subDays($mem_type->length);
            $customer_details->end_date = $date;
            $customer_details->save();

            $order->total_price -= ($mem_type->member_type_price * $basket_item->quantity);
            $order->save();

            if($membership->trainer_id != NULL){
                $trainer = Employee::findOrFail($membership->trainer_id);
                $trainer->no_of_trainees--;
                $trainer->save();
            }

            Membership::destroy($basket_item->membership_id);

            //Reverting to previous values for member_type and trainer_id
            if(DB::table('memberships')->where('customer_id', $request->get('person_id'))->exists()){
                $old_membership = DB::table('memberships')
                                ->orderBy("id", "desc")
                                ->where('customer_id', $request->get('person_id'))
                                ->first();
                $customer_details->member_type_id = $old_membership->member_type_id;

                if($old_membership->trainer_id != NULL){
                    $customer_details->assigned_employee_id = $old_membership->trainer_id;

                    $old_trainer = Employee::findOrFail($old_membership->trainer_id);
                    $old_trainer->no_of_trainees++;
                    $old_trainer->save();
                }
                
            }else{ //no previous membership record so restore to default values
                $customer_details->member_type_id = 0;
                $customer_details->assigned_employee_id = NULL;
            }
        }
        Basket::destroy($id);

        return redirect()->route('orderForm', [$customer->id]);
    }

    public function cancel(Request $request)
    {
        //
        $date = Carbon::today();
        $order = Order::findOrFail($request->get('order_id'));
        $customer = Person::findOrFail($request->get('person_id'));
        $full_basket = Basket::where('order_id', $request->get('order_id'))
                        ->get();

        //cancel each item in the basket
        foreach($full_basket as $basket_entry){
            if($basket_entry->item_id != NULL){ //order contained a product
                $batch = Batch::findOrFail($basket_entry->batch_id);
                $inventory = InventoryLog::where('checking_date', $date)
                                ->where('item_id', $basket_entry->item_id)
                                ->orderBy("id", "desc")
                                ->first();

                $batch->amt_left_batch = $batch->amt_left_batch + $basket_entry->quantity;
                $batch->save();

                $inventory->amount_left = $inventory->amount_left + $basket_entry->quantity;
                $inventory->amount_sold = $inventory->amount_sold - $basket_entry->quantity;
                $inventory->save();

                if($basket_entry->customize_id != NULL){
                    Customize::destroy($basket_entry->customize_id);
                }
            } else if($basket_entry->membership_id != NULL){ //order contained a membership
                $membership = Membership::findOrFail($basket_entry->membership_id);
                $mem_type = MemberType::findOrFail($membership->member_type_id);
                $customer_details = Customer::findOrFail($request->get('person_id'));
                
                $date->subDays($mem_type->length);
                $customer_details->end_date = $date;
                $customer_details->save();

                if($membership->trainer_id != NULL){
                    $trainer = Employee::findOrFail($membership->trainer_id);
                    $trainer->no_of_trainees--;
                    $trainer->save();
                }

                Membership::destroy($basket_entry->membership_id);

                //Reverting to previous values for member_type and trainer_id
                if(DB::table('memberships')->where('customer_id', $request->get('person_id'))->exists()){
                    $old_membership = Membership::where('customer_id', $request->get('person_id'))
                                    ->orderBy("id", "desc")
                                    ->first();
                    $customer_details->member_type_id = $old_membership->member_type_id;
                    $customer_details->save();

                    if($old_membership->trainer_id != NULL){
                        $customer_details->assigned_employee_id = $old_membership->trainer_id;
                        $customer_details->save();

                        $old_trainer = Employee::findOrFail($old_membership->trainer_id);
                        $old_trainer->no_of_trainees++;
                        $old_trainer->save();
                    }
                }else{ //no previous membership record so restore to default values
                    $customer_details->member_type_id = 0;
                    $customer_details->assigned_employee_id = NULL;
                    $customer_details->save();
                }
            }
            Basket::destroy($basket_entry->id);
        }

        //no basket entries for this order anymore
        Order::destroy($request->get('order_id'));

        return redirect('/admin/order/new');
    }

}
