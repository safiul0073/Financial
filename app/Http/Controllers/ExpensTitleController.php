<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ExpenseTitle;
use Illuminate\Http\Request;

class ExpensTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expens = ExpenseTitle::with('category')->paginate(10);
        $expensCategorys = Category::latest()->get();
        return view('content.expens.title.index',compact('expens', 'expensCategorys'));
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
        ExpenseTitle::create($request->all());
        return redirect()->back()->with('success','Expens Title added successfully.');
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

    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => "required"
        ]);

        // dd($request->all());
        ExpenseTitle::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success','Expens Title Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExpenseTitle::find($id)->delete();
        return redirect()->back()->with('success','Expens Title Deleted successfully.');
    }
}
