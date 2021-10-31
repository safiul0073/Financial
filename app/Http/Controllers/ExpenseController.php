<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\ExpenseTitle;
use App\Models\IncameCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $incams = Expense::with('category', 'expense_title')
                           ->paginate(10);

        return view('content.expens.expens.index', compact('incams'));
    }


    public function create()
    {
        $categories = Category::latest()->get();
        $titles = ExpenseTitle::latest()->get();

        return view('content.expens.expens.add', compact('categories','titles'));
    }


    function dynamicFatch(Request $request)
    {

        $value = $request->get('value');
        $incameTitles=ExpenseTitle::where('categorie_id', $value)->get();


        if (count($incameTitles) > 0) {
            $output = '';

            foreach($incameTitles as $row)
            {
            $output .= '<option value="'.$row->id.'">'.$row->title.'</option>';
            }
            $output .= '<option value="">'."No Need".'</option>';
        }else {
            $output = '';

            $titles = ExpenseTitle::all();
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
            "categorie_id" => "required",
            'amount' => "required",
            'expense_date' => 'required'
        ]);

        Expense::create($request->all());
        return redirect()
               ->back()
               ->with('success','Expense added successfully.');
    }


    public function show(Expense $incame)
    {

    }


    public function edit(Expense $expense)
    {
        $categories = Category::latest()->get();
        $titles = ExpenseTitle::latest()->get();

        return view('Content.Expens.Expens.add', compact('expense', 'categories', 'titles'));
    }


    public function update(Request $request, Expense $expense)
    {
        $this->validate($request, [
            "categorie_id" => "required",
            'amount' => "required",
            'expense_date' => 'required'
        ]);

        $expense->update($request->all());
        return redirect()->back()->with('success','Expense Updated successfully.');
    }


    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->back()->with('success','Expense Deleted successfully.');
    }
}
