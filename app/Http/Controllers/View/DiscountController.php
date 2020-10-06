<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class DiscountController extends Controller
{
    public function list(Request $request)
    {
        $error = $request->session()->get('error');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/discounts');

        return view('discounts.list', [
            'discounts' => $response->json(),
            'user' => $request->user(),
            'error' => $error ?? false
        ]);
    }

    public function create()
    {
        return view('discounts.create', [
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'discount' => ['required']
        ]);

        $data = [
            'user_id' => $request['user_id'],
            'discount' => $request['discount']
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->post('http://localhost:8001/api/discounts', $data);

        return redirect('/discounts')->with($response->json());
    }

    public function delete(int $id)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->delete('http://localhost:8001/api/discounts/' . $id);

        return redirect('/discounts')->with($response->json());
    }

    public function edit(int $id, Request $request)
    {
        if (!$request->user()->isAdmin) {
            return view('error.error', [
                'code' => 403,
                'message' => 'Forbidden'
            ]);
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/discounts/' . $id);

        return view('discounts.edit', [
            'discount' => $response->json(),
            'users' => User::all()
        ]);
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'discount' => ['required']
        ]);

        $data = [
            'user_id' => $request['user_id'],
            'discount' => $request['discount']
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->put('http://localhost:8001/api/discounts/' . $id, $data);

        return redirect('/discounts')->with($response->json());
    }
}
