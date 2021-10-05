<?php

namespace App\Http\Controllers;
use App\Models\IncameCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = IncameCategory::paginate(10);

        return view('content.income.category.index',compact('categories'));
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
        IncameCategory::create([
            'title' => $request->title
        ]);
        return redirect()->back()->with('success','Incame Category added successfully.');

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
        $category = IncameCategory::find($id);
        return redirect()->route('incomecategory.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => "required"
        ]);
         IncameCategory::findOrFail($id)->update([
            'title' => $request->title
        ]);
        return redirect()->back()->with('success','Incame Category Updated successfully.');
    }


    public function destroy($id)
    {
        IncameCategory::find($id)->delete();
        return redirect()->back()->with('success','Incame Category Deleted successfully.');
    }
}
