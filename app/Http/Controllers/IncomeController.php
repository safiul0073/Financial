<?php

namespace App\Http\Controllers;

use App\Models\Incame;
use App\Models\IncameCategory;
use App\Models\IncameTitle;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    public function index()
    {
        $incams = Incame::with('income_category', 'income_title')->paginate(10);

        return view('content.income.income.index', compact('incams'));
    }


    public function create()
    {
        $categories = IncameCategory::latest()->get();
        $titles = IncameTitle::latest()->get();

        return view('content.income.income.add', compact('categories','titles'));
    }


    function dynamicFatch(Request $request)
    {
        $incameTitles = null;
        $value = $request->get('value');
        $incameTitles=IncameTitle::where('incame_categorie_id', $value)->get();


        if (count($incameTitles) > 0) {
            
            $output = '';

            foreach($incameTitles as $row)
            {
            $output .= '<option value="'.$row->id.'">'.$row->title.'</option>';
            }
            $output .= '<option value="">'."No Need".'</option>';
        }else {
            $output = '';

            $titles = IncameTitle::all();
            foreach($titles as $row)
            {
            $output .= '<option value="'.$row->id.'">'.$row->title.'</option>';
            }
            $output .= '<option value="">'."No Need".'</option>';
        }

     echo $output;

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            "incame_categorie_id" => "required",
            'amount' => "required",
            'incame_date' => 'required'
        ]);

        Incame::create($request->all());
        return redirect()->back()->with('success','Incame added successfully.');
    }


    public function show(Incame $incame)
    {

    }


    public function edit(Incame $incame)
    {
        $categories = IncameCategory::latest()->get();
        $titles = IncameTitle::latest()->get();

        return view('Content.Income.Income.add', compact('incame', 'categories', 'titles'));
    }


    public function update(Request $request, Incame $incame)
    {
        $this->validate($request, [
            "incame_categorie_id" => "required",
            'amount' => "required",
            'incame_date' => 'required'
        ]);

        $incame->update($request->all());
        return redirect()->back()->with('success','Incame Updated successfully.');
    }


    public function destroy(Incame $incame)
    {
        $incame->delete();
        return redirect()->back()->with('success','Incame Deleted successfully.');
    }
}
