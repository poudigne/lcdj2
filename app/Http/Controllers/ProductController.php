<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = new Product;
        $products = $product->with('categories')->orderBy('title')->paginate(50);

        return view('dashboard/products')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category;
        $categories = $category->where('is_published', 1)->orderBy('name')->get();

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
        $this->validate($request, [
            'product_title' => 'required'
        ]);

        $product = new Product;
        $product->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $product->title = $request->get('product_title');
        $product->description = $request->get('product_description');
        $product->min_player = $request->get('product_input-players-min');
        $product->max_player = $request->get('product_input-players-max');
        $product->min_age = $request->get('product_input-age-min');
        $product->cost_price = $request->get('product_costprice');
        $product->sale_price = $request->get('product_saleprice');
        $product->save();


        if ($request->get('product_categories') != null){
            foreach ($request->get('product_categories') as $category_id) {
                $product->categories()->attach($category_id);
            }
        }

        $files = $request->product_images;
            $count = 0;
            
            foreach($files as $file) {
                if ($file == null)
                    continue;
                $imageName = $product->id. "_" . $count . "." . $file->getClientOriginalExtension();
                $product->addMedia($file)->usingFileName($imageName)->toMediaCollection('images');
                $count++;
            }


        Session::flash('flash_message', 'Product successfully added!');

        return view('dashboard/create_product')->with('categories', Category::get())->with('product', new Product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $output = "";
        $product = Product::find($id);
        foreach($product->getMedia() as $media) {
            $output = "<img src='" . $media->getPath() . "' /><br />";
        }

        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('categories')->where('id',$id)->first();
        return view('dashboard/edit_product')->with('categories', Category::get())->with("product", $product);
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
        $this->validate($request, [
            'product_title' => 'required'
        ]);

        $product = Product::find($id);
        $product->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $product->title = $request->get('product_title');
        $product->description = $request->get('product_description');
        $product->min_player = $request->get('product_input-players-min');
        $product->max_player = $request->get('product_input-players-max');
        $product->min_age = $request->get('product_input-age-min');
        $product->cost_price = $request->get('product_costprice');
        $product->sale_price = $request->get('product_saleprice');
        $product->save();

        $product->categories()->detach();

        if ($request->get('product_categories') != null){
            foreach ($request->get('product_categories') as $category_id) {
                $product->categories()->attach($category_id);
            }
        }
        
        $files = $request->file('product_images');
        if ($files != null){
            $count = 0;
            foreach($files as $file) {
                if ($file == null)
                    continue;
                $product->addMedia($file)->usingFileName($product->id. "_" . $count . "." . $file->getClientOriginalExtension())->toCollection('images');
                $count++;
            }
        }

        Session::flash('flash_message', 'Product successfully edited!');

        return $this->edit($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = new Product;
        Product::find($id)->delete();
        $products = $product->join('categories', 'products.category_id', '=', 'categories.id')
                            ->select('products.title', 'products.description', 'products.cost_price','products.id','categories.name')
                            ->orderBy('products.title',asc)
                            ->get();
        $category = new Category;
        $categories = $category->orderBy('name', asc)->get();
        return view('dashboard/products')->with('products', $products)->with('categories', $categories)->with('deleted', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiple_delete(Request $request)
    {
        Product::destroy($request->ids);
        $response = ['model_type' => 'Product', 'ids' => $request->ids, 'action_type' => 'delete'];
        return json_encode($response);
    }

    public function delete_media(Request $request){
        $media = $this->getMediaByID($request->product_id, $request->media_id);
        $media->delete();
        return $request->media_id;
    }

    private function getMediaByID($product_id,$media_id){
        $product = Product::find($product_id);

        foreach($product->getMedia() as $media){
            if ($media->id == $media_id)
                return $media;
        }
        return $media;
    }

    public function multiple_publish(Request $request){
        return $this->dopublish($request, 1);
    }
    public function multiple_unpublish(Request $request){
        return $this->dopublish($request, 0);
    }
    private function dopublish(Request $request, $value){
        $product = Product::whereIn('id', $request->ids)->update(array('is_published' => $value));
        $response = ['model_type' => 'Product', 'ids' => $request->ids, 'action_type' => ($value == 1 ? "Publish" : "Unpublish")];
        return json_encode($response);
    }
}
?>