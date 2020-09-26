<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function list()
    {
        return response()->json(Book::all());
    }

    public function single(int $id)
    {
        return response()->json(Book::find($id));
    }

    public function create(Request $request)
    {
        if ($request->user()->isAdmin) {
            $attributes = [
                'author' => $request['author'],
                'title' => $request['title'],
                'year_of_publication' => $request['year_of_publication'],
                'place_of_publication' => $request['place_of_publication'],
                'price' => $request['price']
            ];

            $book = Book::create($attributes);

            return response()->json($book);
        }

        return response()->withException(
            new Exception('Forbidden', 403)
        );
    }

    public function update(Request $request)
    {

    }

    public function delete(int $id)
    {
        $book = Book::find($id);

        if($book->delete())
        {
            return response()->json($book);
        }

        return response()->json(null);
    }
}
