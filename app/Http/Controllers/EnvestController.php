<?php

namespace App\Http\Controllers;

use App\Models\Invest;
use App\Models\User;
use Illuminate\Http\Request;

class EnvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = User::where('role', 0)->latest()->get();
        $invests = Invest::with('user')->paginate(10);

        return view('content.invest.index', compact('partners', 'invests'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            "amount" => "required",
            'user_id' => "required",
            'date' => "required",
        ]);
        Invest::create($request->all());
        return redirect()->back()->with('success','Invested successfully.');
    }


    public function show(Invest $invest)
    {
        //
    }

    public function edit(Invest $invest)
    {
        //
    }

    public function update(Request $request, Invest $invest)
    {

        $this->validate($request, [
            "amount" => "required",
            'user_id' => "required",
            'date' => "required",
        ]);

        $invest->update($request->all());
        return redirect()->back()->with('success','Invested Updated successfully.');
    }


    public function destroy(Invest $invest)
    {
        $invest->delete();
        return redirect()->back()->with('success','Invested Id Deleted successfully.');
    }
}
