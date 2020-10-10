<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class DiscountController extends Controller
{
    public function getAllDiscounts(Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        if (!$request->user()->isAdmin) {
            return redirect('/error')->with('error', '403: Forbidden');
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/discounts');

        return view('discounts.list', [
            'discounts' => $response->json(),
            'user' => $request->user(),
        ]);
    }

    public function createDiscount(Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        if (!$request->user()->isAdmin) {
            return redirect('/error')->with('error', '403: Forbidden');
        }

        return view('discounts.create', [
            'users' => User::all()
        ]);
    }

    public function storeDiscount(Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        if (!$request->user()->isAdmin) {
            return redirect('/error')->with('error', '403: Forbidden');
        }

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

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/discounts')->with($response);
    }

    public function deleteDiscount(int $id, Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        if (!$request->user()->isAdmin) {
            return redirect('/error')->with('error', '403: Forbidden');
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->delete('http://localhost:8001/api/discounts/' . $id);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/discounts')->with($response);
    }

    public function editDiscount(int $id, Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        if (!$request->user()->isAdmin) {
            return redirect('/error')->with('error', '403: Forbidden');
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/discounts/' . $id);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return view('discounts.edit', [
            'discount' => $response,
            'users' => User::all()
        ]);
    }

    public function updateDiscount(int $id, Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        if (!$request->user()->isAdmin) {
            return redirect('/error')->with('error', '403: Forbidden');
        }

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

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/discounts')->with($response);
    }
}
