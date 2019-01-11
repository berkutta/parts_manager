<?php

namespace App\Http\Controllers;
use App\Component;
use App\Storage;

use Illuminate\Http\Request;

class StoragesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Storage::all();

        foreach($entries as $entry)
        {
            $entry->components = Storage::find($entry->id)->components->count();
        }

        return view('pages/storages/index', ['entries' => $entries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/storages/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entry = new Storage;

        $entry->name = $request->input('name');

        $entry->save();

        return redirect('/storages/');
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
        $entry = Storage::findOrFail($id);

        $entry->name = $request->input('name');

        $entry->save();

        return redirect('/storages/'.$request->input('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = Storage::find($id);

        return view('/pages/storages/show', ['entry' => $entry]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = Storage::findOrFail($id);

        $entry->delete();

        return redirect('/storages');
    }
}
