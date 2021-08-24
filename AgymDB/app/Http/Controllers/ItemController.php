<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $date = Carbon::today();
        

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

    public function form()
    {
        $variations = DB::table('variations')->get();
        $variation_category = DB::table('variation_categories')->get();
        $categories = DB::table('categories')->get();

        return view('admin.newProductForm' , compact('variations', 'variation_category', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($filter)
    {
        if ($filter == 1){
            $products = DB::table('items')
                        ->where('category_id', '<=', 2)
                        ->get();

        }else{
            $products = DB::table('items')->where('category_id', '=', $filter)->get();
        }

        $variations = DB::table('variations')->get();

        $variation_category = DB::table('variation_categories')->get();

        $items = DB::table('items')->get();

        $batches = array();
        foreach($items as $key => $item){
            $batches[$item->id] = Batch::where('item_id', $item->id)
                        ->where('amt_left_batch', '>', 0)
                        ->sum('amt_left_batch');
        }

        if($filter == 1){
            return view('products', compact('products', 'variations', 'variation_category', 'batches'));
        }else{
            return view( 'products' , compact('products', 'variations', 'variation_category', 'batches'));
        }

    }

    public function showAll()
    {
        //
        $products = DB::table('items')->get();

        $stock = array();
        foreach($products as $key => $product){
            $stock[$key] = Batch::where('item_id', $product->id)->sum('amt_left_batch');
        }

        return view('admin.productList', compact('products', 'stock'));
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
    public function destroy($id)
    {
        //
    }
}
