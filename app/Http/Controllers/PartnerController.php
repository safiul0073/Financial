<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    public function index()
    {
        $partners = User::with('invest')->latest()->get();

        return view('content.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('content.partner.add');
    }


    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            "name" => "min:2|unique:users",
            'email' => "unique:users| email",
            'initial_amount' => 'regex:/^\d+(\.\d{1,2})?$/',
            'phone' => "max:11",
            'address' => 'max:256',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::create($attributes);
        $user->invest()->create([
            'amount' => $request->initial_amount,
            'date' => $request->date,
            'comment' => $request->comment
            ]);
        return redirect()
               ->route('partner.index')
               ->with('success','Partner added successfully.');
    }


    public function show($id)
    {
        $user = User::with("invests")->findOrFail($id);
        $comments = [];
        $date = [];
        foreach ($user->invests as $inv) {
            $comments[] = $inv->comment;
            $date[] = $inv->date;
        }
        $partner = [
            'Perner Name' => $user->name,
            'Email' => $user->email,
            'Phone' => $user->phone,
            'Total Invest Amount' => floatval($user->invests->sum('amount')),
            'Total Invest' => $user->invests->count('amount'),
            'Comments' => implode(', ',$comments),
            'Invests Date' => implode(', ',$date),
            'Address' => $user->address,
        ];
        return view('content.partner.show',['user' => $partner]);
    }


    public function edit($id)
    {

        $user = User::with('invest')->findOrFail($id);

        return view('content.partner.add', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => "min:2",
            'email' => "email",
            'initial_amount' => 'regex:/^\d+(\.\d{1,2})?$/',
            'phone' => "max:11",
            'address' => 'max:256'

        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        $invest = $user->invests()->first();

         $invest->update([
            'amount' => $request->initial_amount,
            'date' => $request->date,
            'comment' => $request->comment
        ]);
        return redirect()
                ->back()
                ->with('success','Partner Updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->invest()->delete();
        $user->delete();
        return redirect()
              ->back()
              ->with('success','Partner Deleted successfully.');
    }
}
