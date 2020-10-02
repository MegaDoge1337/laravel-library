<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function list(Request $request)
    {
        $error = $request->session()->get('error');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/books');

        return view('books.list', [
            'books' => $response->json(),
            'user' => $request->user(),
            'error' => $error ?? false
        ]);
    }

    public function single(int $id, Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->get('http://localhost:8001/api/books/' . $id);

        return view('books.single', [
            'book' => $response->json(),
            'user' => $request->user()
        ]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author' => ['required'],
            'title' => ['required'],
            'year_of_publication' => ['required'],
            'place_of_publication' => ['required'],
            'price' => ['required']
        ]);

        $data = [
            'author' => $request['author'],
            'title' => $request['title'],
            'year_of_publication' => $request['year_of_publication'],
            'place_of_publication' => $request['place_of_publication'],
            'price' => $request['price']
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->post('http://localhost:8001/api/books', $data);

        return redirect('/books')->with($response->json());
    }

    public function delete(int $id)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->delete('http://localhost:8001/api/books/' . $id);

        return redirect('/books')->with($response->json());
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
        ])->get('http://localhost:8001/api/books/' . $id);

        return view('books.edit', [
            'book' => $response->json(),
        ]);
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'author' => ['required'],
            'title' => ['required'],
            'year_of_publication' => ['required'],
            'place_of_publication' => ['required'],
            'price' => ['required']
        ]);

        $data = [
            'author' => $request['author'],
            'title' => $request['title'],
            'year_of_publication' => $request['year_of_publication'],
            'place_of_publication' => $request['place_of_publication'],
            'price' => $request['price']
        ];

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . Cookie::get('token'),
        ])->put('http://localhost:8001/api/books/' . $id, $data);
    }
}
