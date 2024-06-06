<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $data = ([
            'duration' => $request->duration,
            'price' => $request->price,
            'email' => $request->email,
            'description' => $request->description,
        ]);
        Invoice::create($data);
        return redirect('/invoice');
    }

    public function fetchInvoice(Request $request)
    {
        $email = session('email');
        $invoice = Invoice::where('email', $email)->latest()->first();
        return response()->json($invoice);
    }
}
