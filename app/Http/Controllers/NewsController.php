<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('categories')->paginate(50);
        return view('dashboard/news')->with('news', $news);
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
        return view('dashboard/create_news')->with('categories', $categories)->with("news", new News);
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
            'news_title' => 'required',
            'news_text' => 'required'
        ]);

        $news = new News;
        $news->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $news->title = $request->get('news_title');
        $news->text = $request->get('news_text');
        $news->save();

        if ($request->get('product_categories') != null) {
            foreach ($request->get('news_categories') as $category_id) {
                $news->categories()->attach($category_id);
            }
        }
        Session::flash('flash_message', 'Event successfully added!');
        return view('dashboard/create_news')->with('success', 1)->with('categories', Category::get())->with('news', new News);
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
        $news = News::with('categories')->where('id',$id)->first();
        return view('dashboard/edit_news')->with('categories', Category::get())->with("news", $news);
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
            'news_title' => 'required',
            'news_text' => 'required'
        ]);

        $news = News::find($id);
        $news->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $news->title = $request->get('news_title');
        $news->text = $request->get('news_text');
        $news->save();

        $news->categories()->detach();
        if ($request->get('news_categories') != null) {
            foreach ($request->get('news_categories') as $category_id) {
                $news->categories()->attach($category_id);
            }
        }

        Session::flash('flash_message', 'Event successfully added!');
        return view('dashboard/create_news')->with('success', 1)->with('categories', Category::get())->with('news', $news);
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiple_delete(Request $request)
    {
        News::destroy($request->ids);
        $response = ['model_type' => 'News', 'ids' => $request->ids, 'action_type' => 'delete'];
        return json_encode($response);
    }

    public function multiple_publish(Request $request){
        return $this->dopublish($request, 1);
    }

    public function multiple_unpublish(Request $request){
        return $this->dopublish($request, 0);
    }

    private function dopublish(Request $request, $value){
        $product = News::whereIn('id', $request->ids)->update(array('is_published' => $value));
        $response = ['model_type' => 'News', 'ids' => $request->ids, 'action_type' => ($value == 1 ? "Publish" : "Unpublish")];
        return json_encode($response);
    }
}
?>