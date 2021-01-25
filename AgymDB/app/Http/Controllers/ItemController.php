<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

use App\Models\Category;
use App\Models\Item;
use App\Models\Variation;
use App\Models\VariationCategory;
use App\Models\Batch;

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
    public function create()
    {
        //
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
