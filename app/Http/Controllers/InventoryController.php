<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;
use DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = new Product;
        $products = $product->with('categories')->orderBy('title')->paginate(20);

        return view('dashboard/inventory')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category;
        $categories = $category->orderBy('name')->get();
        return view('dashboard/create_product')->with('categories', $categories)->with('product', new Product);
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

    }

    public function search(Request $request)
    {
        $keyword = $request->get('keywords');
        Session::put("keyword", $keyword);
        $product = new Product;
        $products = $product->leftJoin('inventories','products.id','=', 'inventories.product_id')
                    ->leftJoin('category_product', 'category_product.product_id', '=', 'products.id')
                    ->leftjoin('categories', 'category_product.category_id', '=', 'categories.id')
                    ->where(function ($query) {
                        $query->where('products.description', 'like', '%'.Session::get("keyword").'%')
                            ->orwhere('products.title', 'like', '%'.Session::get("keyword").'%')
                            ->orWhere('categories.name','like', '%'.Session::get("keyword").'%');
                    })
                    ->groupBy('products.id')
                    ->select("products.id as id","products.title",'products.description', 'inventories.quantity as quantity', DB::Raw('GROUP_CONCAT(categories.name SEPARATOR \', \') AS categories'));

        $products = $this->sortInventory($products);
        $view = View::make('dashboard.inventory')->with("products", $products->paginate(20));
        return json_encode($view->renderSections()['cards']);
    }
    /**
     * 0 = A to Z
     * 1 = Z to A
     * 2 = Stock Asc
     * 3 = Stock desc
     * 4 = Show out of stock only
     *
     * @param $sorttype
     * @return $this
     */
    public function sort($sorttype){
        Session::put("sort_type", $sorttype);
        $product = Product::leftJoin('inventories','products.id','=', 'inventories.product_id');
        $products = $this->sortInventory($product, $sorttype);
        return view('dashboard/inventory')->with('products', $products->paginate(20))->with('sorttype',$sorttype);
    }

    public function increase(Request $request) {
        return $this->modifyQuantity($request, 1);
    }

    public function decrease(Request $request) {
        $view = $this->modifyQuantity($request, -1);
        if ($view == false)
            return;

        $sale = new Sale;
        $sale->product_id = $request->product_id;
        $sale->quantity = 1;
        $sale->unit_price = Product::find($request->product_id)->sale_price;
        $sale->save();
        return $view;
    }

    private function modifyQuantity(Request $request, $modifier){
        $inventory = new Inventory;

        $item = $inventory->where("product_id", "=", $request->product_id)->first();
        $item->quantity = $item->quantity + $modifier;
        if($item->quantity < 0)
        {
            $item->quantity = 0;
            return false;
        }
        $item->save();
        return json_encode($item);
    }

    private function sortInventory($query){

        switch(Session::get("sort_type")){
            case 0:
                return $query->orderBy("products.title",'asc');break;
            case 1:
                return $query->orderBy("products.title",'desc');break;
            case 2:
                return $query->orderBy("inventories.quantity",'asc');break;
            case 3:
                return $query->orderBy("inventories.quantity",'desc');break;
            case 4:
                return $query->where("inventories.quantity", 0);break;
            default:
                return $query;break;
        }
    }
}
?>