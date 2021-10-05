<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    public function index()
    {
        $partners = User::where('role', 0)->paginate(10);
        return view('content.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('content.partner.add');
    }


    public function store(Request $request)
    {
        $user = $this->validate($request, [
            "name" => "min:2|unique:users",
            'email' => "unique:users| email",
            'initial_amount' => 'regex:/^\d+(\.\d{1,2})?$/',
            'phone' => "max:11",
            'address' => 'max:256'

        ]);
        // dd($request->all());
        User::create($user);
        return redirect()
               ->route('partner.index')
               ->with('success','Partner added successfully.');
    }


    public function show(User $user)
    {

    }


    public function edit($id)
    {

        $user = User::findOrFail($id);

        return view('content.partner.add', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = $this->validate($request, [
            "name" => "min:2",
            'email' => "email",
            'initial_amount' => 'regex:/^\d+(\.\d{1,2})?$/',
            'phone' => "max:11",
            'address' => 'max:256'

        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()
                ->back()
                ->with('success','Partner Updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','Partner Deleted successfully.');
    }
}
