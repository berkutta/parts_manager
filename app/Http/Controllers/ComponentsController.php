<?php

namespace App\Http\Controllers;
use App\Component;
use App\Storage;

use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Component::all();

        return view('pages/components/index', ['entries' => $entries]);
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
    public function store(Request $request)
    {
        $entry = new Component;

        $entry->storage_id = Storage::where('name', $request->input('storage'))->get()->first()->id;
        $entry->name = $request->input('name');
        $entry->datasheet = $request->input('datasheet');
        $entry->category = $request->input('category');
        $entry->subcategory = $request->input('subcategory');
        $entry->package = $request->input('package');
        $entry->supplier = $request->input('supplier');
        $entry->description = $request->input('description');
        $entry->stock = $request->input('stock');

        $request->input('stock_flag') == 'on' ? $entry->stock_flag = true : $entry->stock_flag = false;

        $entry->save();

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
        $entry = Component::find($id);

        $storages = Storage::all();

        return view('/pages/components/show', ['entry' => $entry, 'storages' => $storages]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
            $entry->storage_id = Storage::where('name', $request->input('storage'))->get()->first()->id;
            $entry->name = $request->input('name');
            $entry->datasheet = $request->input('datasheet');
            $entry->category = $request->input('category');
            $entry->subcategory = $request->input('subcategory');
            $entry->package = $request->input('package');
            $entry->supplier = $request->input('supplier');
            $entry->description = $request->input('description');
            $entry->stock = $request->input('stock');

            $request->input('stock_flag') == 'on' ? $entry->stock_flag = true : $entry->stock_flag = false;
        }

        $entry->save();

        return redirect('/components/'.$request->input('id'));
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  string $searchterm
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchterm = $request->input('search');

        $component_entries = Component::where('description', 'like', "%{$searchterm}%")->get();

        $entries = $component_entries;

        return view('pages/components/index', ['entries' => $entries]);
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
