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

class InventoryLogController extends Controller
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
        $now = Carbon::now();
        $user_id = Auth::id();
        $logger = Person::where('user_id', $user_id)->first();

        $batch = new Batch (['batch_amount'=>$request->get('batch_amount'), 'amt_left_batch'=>$request->get('batch_amount'),
                            'expiry_date'=>$request->get('expiry_date'), 'date_received'=>$now,
                            'item_id'=>$request->get('product_id'),'employee_id'=>$logger->id ]);
        $batch->save();

        return redirect('/admin/inventoryList/all');
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
    }

    public function showAll($filter)
    {
        //
        if($filter == 'all'){
            $batches = Batch::where('amt_left_batch', '>', 0)
                        ->orderBy("item_id", "asc")
                        ->join('items', 'batches.item_id', 'items.id')
                        ->get();
        } else if ($filter == 1){
            $batches = Batch::where('amt_left_batch', '>', 0)
                        ->orderBy("item_id", "asc")
                        ->join('items', 'batches.item_id', 'items.id')
                        ->where('category_id','<=', 2)
                        ->get();
        }else{
            $batches = Batch::where('amt_left_batch', '>', 0)
                        ->orderBy("item_id", "asc")
                        ->join('items', 'batches.item_id', 'items.id')
                        ->where('category_id', $filter)
                        ->get();
        }

        $products = DB::table('items')->get();

        return view('admin.inventory', compact('batches', 'products'));
       // return view('admin-coreUI.inventory', compact('batches', 'products'));
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
