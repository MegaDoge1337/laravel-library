<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class ContractController extends Controller
{
    public function list(Request $request)
    {
        $error = $request->session()->get('error');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/contracts');

        return view('contracts.list', [
            'contracts' => $response->json(),
            'error' => $error ?? false
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => ['required'],
        ]);

        $data = [
            'book_id' => $request['book_id']
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->post('http://localhost:8001/api/contracts', $data);

        return redirect('/contracts')->with($response->json());
    }

    public function delete(int $id)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->delete('http://localhost:8001/api/contracts/' . $id);

        return redirect('/contracts')->with($response->json());
    }
}
