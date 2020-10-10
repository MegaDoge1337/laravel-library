<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    public function getUserWallet(Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/wallet');

        return view('wallet.wallet', [
            'wallet' => $response->json(),
        ]);
    }

    public function makeUserPayment(Request $request)
    {
        $request->validate([
            'price' => ['required']
        ]);

        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->post('http://localhost:8001/api/wallet', ['price' => $request->price]);

        $response = $response->json();

        if($response['error'])
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/books')->with('message', 'Book successfully rented!');
    }
}
