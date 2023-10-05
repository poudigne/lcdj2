<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Inventory;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $first = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $last = date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date('Y')));

        $inventory_value = Inventory::select(DB::Raw('SUM(products.cost_price * inventories.quantity) as total_value'))
            ->join('products', 'products.id','=','inventories.product_id')
            ->get();

        $top_product = Sale::select('products.title','sales.product_id', DB::raw('count(sales.product_id) as sales_count'))
            ->join('products','products.id', '=','sales.product_id')
            ->whereBetween('sales.created_at',array($first,$last))
            ->groupBy('sales.product_id')
            ->orderBy('sales_count', 'desc')
            ->take(10)
            ->get();
        return view('dashboard/dashboard')->with('top_product',$top_product)->with('total_value',$inventory_value);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
