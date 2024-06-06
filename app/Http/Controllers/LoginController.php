<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validateData = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($validateData)) {
            $username = Auth::user()->name;
            
            $request->session()->put([
                'email' => $validateData["email"],
                'name' => $username,
                'isLoggedIn' => true
            ]);
            $request->session()->regenerate();
            return redirect('/config');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
