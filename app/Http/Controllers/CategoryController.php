<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('content.category.index',compact('categories'));
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
        Category::create([
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
        $category = Category::find($id);
        return redirect()->route('incomecategory.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => "required"
        ]);
         Category::findOrFail($id)->update([
            'title' => $request->title
        ]);
        return redirect()->back()->with('success','Incame Category Updated successfully.');
    }


    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success','Incame Category Deleted successfully.');
    }
}
