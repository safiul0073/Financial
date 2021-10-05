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
        $partners = User::latest()->get();
        $invests = Invest::with('user')->paginate(10);

        return view('content.invest.index', compact('partners', 'invests'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $invest = $this->validate($request, [
            "amount" => "required",
            'user_id' => "required",
        ]);
        Invest::create($invest);
        return redirect()->back()->with('success','Invested successfully.');
    }


    public function show(Invest $invest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function edit(Invest $invest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invest  $invest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invest $invest)
    {

        $att = $this->validate($request, [
            "amount" => "required",
            'user_id' => "required",
        ]);

        $invest->update($att);
        return redirect()->back()->with('success','Invested Updated successfully.');
    }


    public function destroy(Invest $invest)
    {
        $invest->delete();
        return redirect()->back()->with('success','Invested Id Deleted successfully.');
    }
}
