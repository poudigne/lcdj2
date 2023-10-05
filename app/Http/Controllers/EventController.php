<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = new Event;
        $events = $event->orderBy('name')->get();
        return view('dashboard/events')->with('events', $events)->with('event', new Event);
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
        return view('dashboard/create_event')->with('categories', $categories)->with('event', new Event);
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
            'event_name' => 'required',
            'event_description' => 'required',
            'event_datetime' => 'required'
        ]);

        $event = new Event;
        $event->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $event->name = $request->event_name;
        $event->description = $request->event_description;
        $event->datetime = Carbon::parse($request->event_datetime);
        $event->save();
        if ($request->get('event_categories') != null){
            foreach ($request->get('event_categories') as $category_id) {
                $event->categories()->attach($category_id);
            }
        }

        $category = new Category;
        $categories = $category->orderBy('name')->get();
        return view('dashboard/create_event')->with('categories', $categories)->with('event', new Event);
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
        $event = Event::find($id);
        return view('dashboard/edit_event')->with('categories', Category::get())->with("event", $event);
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
            'event_name' => 'required',
            'event_description' => 'required',
            'event_datetime' => 'required'
        ]);

        $event = Event::find($id);
        $event->is_published = ($request->get('is_published') == 'on' ? 1 : 0);
        $event->name = $request->event_name;
        $event->description = $request->event_description;
        $event->datetime = Carbon::parse($request->event_datetime);
        $event->save();

        $event->categories()->detach();

        if ($request->get('event_categories') != null){
            foreach ($request->get('event_categories') as $category_id) {
                $event->categories()->attach($category_id);
            }
        }

        Session::flash('flash_message', 'Event successfully edited!');

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiple_delete(Request $request)
    {
        Event::destroy($request->ids);
        $response = ['model_type' => 'Event', 'ids' => $request->ids, 'action_type' => 'delete'];
        return json_encode($response);
    }

    public function multiple_publish(Request $request){
        return $this->dopublish($request, 1);
    }
    public function multiple_unpublish(Request $request){
        return $this->dopublish($request, 0);
    }
    private function dopublish(Request $request, $value){
        $event = Event::whereIn('id', $request->ids)->update(array('is_published' => $value));
        $response = ['model_type' => 'Event', 'ids' => $request->ids, 'action_type' => ($value == 1 ? "Publish" : "Unpublish")];
        return json_encode($response);
    }
}
?>