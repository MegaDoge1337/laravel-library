<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function getAllBooks(Request $request)
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
        ])->get('http://localhost:8001/api/books');

        return view('books.list', [
            'books' => $response->json(),
            'user' => $request->user(),
        ]);
    }

    public function getBook(int $id, Request $request)
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
        ])->get('http://localhost:8001/api/books/' . $id);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return view('books.single', [
            'book' => $response,
            'user' => $request->user()
        ]);
    }

    public function createBook(Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        if (!$request->user()->isAdmin) {
            return redirect('/error')->with('error', '403: Forbidden');
        }

        return view('books.create');
    }

    public function storeBook(Request $request)
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

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/books')->with($response);
    }

    public function deleteBook(int $id, Request $request)
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
        ])->delete('http://localhost:8001/api/books/' . $id);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/books')->with($response);
    }

    public function editBook(int $id, Request $request)
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
        ])->get('http://localhost:8001/api/books/' . $id);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return view('books.edit', [
            'book' => $response,
        ]);
    }

    public function updateBook(int $id, Request $request)
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
        ])->put('http://localhost:8001/api/books/' . $id, $data);

        $response = $response->json();

        if($response['error'] ?? null)
        {
            return redirect('/error')->with('error', $response['error']);
        }

        return redirect('/books')->with($response);
    }
}
