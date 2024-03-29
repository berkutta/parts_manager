<?php

namespace App\Http\Controllers;
use App\Component;
use App\Storage;

use Illuminate\Http\Request;

use App\Http\Requests\Components;

use App\Plugins\PluginFunctions;

class ComponentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Component::paginate(25);

        $plugins = new PluginFunctions();
        $custom_buttons = $plugins->get_custom_buttons();

        return view('pages/components/index', ['entries' => $entries, 'custom_buttons' => $custom_buttons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $storages = Storage::all();

        return view('pages/components/create', ['storages' => $storages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Components $request)
    {
        $entry = new Component;

        $entry->fill($request->all());
        $entry->storage_id = Storage::where('name', $request->input('storage'))->get()->first()->id;
        $request->input('stock_flag') == 'on' ? $entry->stock_flag = true : $entry->stock_flag = false;

        $entry->extra_attributes = [];
        foreach(array_combine($request->input('key'), $request->input('attribute')) as $key => $attribute) {
            if(!empty($key)) {
                $entry->extra_attributes[$key] = $attribute;
            }
        }

        // We need to already save the entry here so we are able to attach tags to it later
        $entry->save();

        if(!empty($request->input('tags'))) {
            $entry->syncTags(explode(',', $request->input('tags')));

            $entry->save();
        }

        return redirect('/components/');
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
        $entry = Component::find($id);

        $storages = Storage::all();
        
        $keys = Component::all()->map(function($item) {
            return array_keys($item->extra_attributes->all());
        })->flatten()->unique();

        return view('/pages/components/show', ['entry' => $entry, 'storages' => $storages, 'keys' => $keys]);     
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Components $request, $id)
    {
        $entry = Component::findOrFail($id);

        if(preg_match('/\+(.*)/', $request->input('stock'), $output))
        {
            $entry->stock += $output[1];
        }
        else if(preg_match('/\-(.*)/', $request->input('stock'), $output))
        {
            $entry->stock -= $output[1];
        }
        else
        {
            $entry->fill($request->all());
            $entry->storage_id = Storage::where('name', $request->input('storage'))->get()->first()->id;
            $request->input('stock_flag') == 'on' ? $entry->stock_flag = true : $entry->stock_flag = false;

            
            if(!empty($request->input('tags'))) {
                $entry->syncTags(explode(',', $request->input('tags')));
            }

            $entry->extra_attributes = [];
            foreach(array_combine($request->input('key'), $request->input('attribute')) as $key => $attribute) {
                if(!empty($key)) {
                    $entry->extra_attributes[$key] = $attribute;
                }
            }
        }

        $entry->save();

        return redirect()->back();
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  string $searchterm
     * @return \Illuminate\Http\Response
     */
    public function search(Components $request)
    {
        $searchterm = $request->input('search');

        $entries = Component::search($searchterm)->paginate(15);

        $plugins = new PluginFunctions();
        $custom_buttons = $plugins->get_custom_buttons();

        return view('pages/components/index', ['entries' => $entries, 'custom_buttons' => $custom_buttons]);
    }

    public function action(Request $request)
    {        
        $plugins = new PluginFunctions();

        $custom_function = $plugins->get_custom_command($request->input('command'));

        if($custom_function != null)    $custom_function(Component::find($request->input('component')));

        return redirect()->back();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = Component::findOrFail($id);

        $entry->delete();

        return redirect('/components');
    }
}
