<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invoice;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $invoiceData = ([
            'duration' => $request->duration,
            'price' => $request->price,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        $validateData['password'] = bcrypt($request->password);

        $request->session()->put([
            'email' => $validateData["email"],
            'name' => $validateData["name"],
            'isLoggedIn' => true
        ]);
        User::create($validateData);
        Invoice::create($invoiceData);
        return redirect('/invoice');
    }
}
// 