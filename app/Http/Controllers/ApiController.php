<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function fetchData(Request $request)
    {
        $domain = $request->query('domain');
        $response = Http::get("https://portal.qwords.com/apitest/whois.php?domain={$domain}");

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch data from API'], 500);
        }
    }


}