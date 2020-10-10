<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class ContractController extends Controller
{
    public function getUserContracts()
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
        ])->get('http://localhost:8001/api/contracts');

        return view('contracts.list', [
            'contracts' => $response->json(),
        ]);
    }

    public function storeContract(Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        $request->validate([
            'book_id' => ['required'],
            'book_price' => ['required'],
        ]);

        $data = [
            'price' => $request['book_price'],
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->post('http://localhost:8001/api/wallet', $data);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        $data = [
            'book_id' => $request['book_id']
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->post('http://localhost:8001/api/contracts', $data);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/contracts')->with($response);
    }

    public function deleteContract(int $id)
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
        ])->delete('http://localhost:8001/api/contracts/' . $id);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/contracts')->with($response);
    }
}
