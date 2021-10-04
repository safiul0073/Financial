<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeController extends Controller
{

    public function categoryIndex () {
        return view('Content.Income.Category.index');
    }
}
