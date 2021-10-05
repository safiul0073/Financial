<?php

namespace App\Http\Controllers;

use App\Models\Incame;
use App\Models\IncameTitle;
use Illuminate\Http\Request;

class IncomeTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = IncameTitle::latest()->get();
        return view('Content.Income.Title.index',compact('titles'));
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
        $this->validate($request, [
            "title" => "required"
        ]);
        IncameTitle::create([
            'title' => $request->title
        ]);
        return redirect()->back()->with('success','Incame Title added successfully.');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = IncameTitle::find($id);
        return redirect()->route('incomecategory.index');
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
            "title" => "required"
        ]);
        IncameTitle::findOrFail($id)->update([
            'title' => $request->title
        ]);
        return redirect()->back()->with('success','Incame Title Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IncameTitle::find($id)->delete();
        return redirect()->back()->with('success','Incame Title Delete successfully.');
    }
}
