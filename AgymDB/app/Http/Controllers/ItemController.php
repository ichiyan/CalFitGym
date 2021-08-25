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
        $category = 0;
        $category = Category::findOrFail($request->get('category'))->id;

        if($request->hasFile('prod_image')){
            $filenameWithExt = $request->file('prod_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('prod_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('prod_image')->storeAs('public/items', $fileNameToStore);

        }else{
            $fileNameToStore = 'default-profile.png'; //CHANGE TO DEFAULT PRODUCT PIC
        }

        $newItem = new Item (['item_name'=>$request->get('item_name'),
                            'is_customizable'=>$request->get('customizable'),
                            'has_variations'=>$request->get('variations'),
                            'has_different_prices'=>$request->get('diff_prices'),
                            'price'=>$request->get('price'),
                            'description'=>$request->get('description'),
                            'measurement'=>$request->get('measurement'),
                            'weight_volume'=>$request->get('weight_volume'),
                            'category_id'=>$category,
                            'item_pic'=>$fileNameToStore,
                            ]);
        $newItem->save();

        $itemID = DB::table('items')->orderBy("id", "desc")->first()->id;

        if($request->get('variations') == 1){
            return redirect()->route('productVarForm', [$itemID]);
        }else{
            return redirect()->route('allProducts');
        }
        
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
        $categories = DB::table('categories')->get();
        return view('admin.newProductForm' , compact('categories'));
    }

    public function varForm($id)
    {
        $variation_categories = DB::table('variation_categories')->get();
        $item = Item::findOrFail($id);
        $variations = DB::table('variations')->get();
        return view('admin.newProductVarForm' , compact('variation_categories', 'item', 'variations'));
    }

    public function var(Request $request)
    {
        $item = Item::findOrFail($request->get('item_id'));
        $variation_categories_id = VariationCategory::findOrFail('variation_categories')->id;

        if($item->has_different_prices == 1){
            $price = $request->get('price');
        }else{
            $price = NULL;
        }
        

        $newVar = new Variation ([ 'name'=>$request->get('var_name'),
                                    'price'=>$price,
                                    'description'=>$request->get('description'),
                                    'item_id'=>$item->id,
                                    'variation_category_id'=>$variation_categories_id,
                                ]);
        $newVar->save();

        return redirect()->route('productVarForm', [$item->id]);
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
