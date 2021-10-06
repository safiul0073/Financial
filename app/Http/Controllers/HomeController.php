<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {

        return view('content.dashboard.dashboard');
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
}
