<?php

namespace App\Http\Controllers;

use App\Models\Incame;
use App\Models\User;
use App\Services\Calculation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index(Calculation $calculation)
    {
        $users = Incame::select('amount', 'incame_date')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->incame_date)->format('m');
        });

        $amount = [];
        $userArr = [];

        foreach ($users as  $key =>$value) {
            $hell = null;
            foreach ($value as  $val) {
                $hell += $val->amount;
            }
             $amount[(int)$key] = $hell;
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($amount[$i])) {
                $userArr[] = $amount[$i];

            } else {
                $userArr[] = 0;
            }

        }

        return view('content.dashboard.dashboard',
        ['totalEnvest' => $calculation->TotalInvestAmount(),
         'totalPartner' => $calculation->TotalPartners(),
         'totalIncomeAmount' => $calculation->TotalIncomeAmount(),
         'totalExpensAmount' => $calculation->TotalExpensAmount(),
         'chartData' => json_encode($userArr,JSON_NUMERIC_CHECK)
        ]);
    }

    public function registerIndex()
    {
        return view('auth.register');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function register (Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            'role' => 1
        ]);

        auth()->login($user);
        return redirect('/');
    }

    public function settingIndex () {

        return view('content.settings.index');
    }

    public function clearViews()
    {
        Artisan::call('view:clear');
        return redirect()->back()->with('status','Views Cleared!');
    }
    public function clearCache()
    {
        Artisan::call('cache:clear');
        return redirect()->back()->with('status','Cache Cleared!');
    }
    public function routeClear()
    {
        Artisan::call('route:clear');
        return redirect()->back()->with('status','Route Cleared!');
    }

}
