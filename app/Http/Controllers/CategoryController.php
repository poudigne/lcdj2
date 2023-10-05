<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = new Category;
        $categories = $category->orderBy('name')->get();
        return view('dashboard/categories')->with('categoryList',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/create_category')->with('category', new Category);
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
            'category_name' => 'required'
        ]);

        $category = new Category;
        $category->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $category->name = $request->get('category_name');
        $category->description = $request->get('category_description');
        $category->save();
        Session::flash('flash_message', 'Category successfully added!');
        return view('dashboard/create_category')->with('category', new Category);
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
        $category = Category::find($id);
        return view('dashboard/edit_category')->with("category", $category);
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
            'category_name' => 'required'
        ]);
        $category = Category::find($id);

        $category->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $category->name = $request->get('category_name');
        $category->description = $request->get('category_description');
        $category->save();
        Session::flash('flash_message', 'Category successfully edited!');
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
        $category = new Category;
        try {
            Category::find($id)->delete();
            return view('dashboard/categories')->with('categoryList', $category->get())->with('deleted',1);
        }catch(\Exception $e){
            return view('dashboard/categories')->with('categoryList', $category->get())->with('deleted','Category cannot be deleted because some products are associated to it.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiple_delete(Request $request)
    {
        Category::destroy($request->ids);
        $response = ['model_type' => 'Category', 'ids' => $request->ids, 'action_type' => 'delete'];
        return json_encode($response);
    }

    public function multiple_publish(Request $request){
        return $this->dopublish($request, 1);
    }
    public function multiple_unpublish(Request $request){
        return $this->dopublish($request, 0);
    }
    private function dopublish(Request $request, $value){
        $category = Category::whereIn('id', $request->ids)->update(array('is_published' => $value));
        $response = ['model_type' => 'Category', 'ids' => $request->ids, 'action_type' => ($value == 1 ? "Publish" : "Unpublish")];
        return json_encode($response);
    }
}
