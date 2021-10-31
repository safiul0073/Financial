<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfiteRequestcontroller extends Controller
{
    public function index () {
        return view('content.profite-request.index');
    }
    public function store (Request $request) {
        $att = $this->validate($request, [
            'amount' => 'required',
        ]);

        // if ($request->amount )
    }
}
