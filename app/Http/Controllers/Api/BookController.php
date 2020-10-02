<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function list()
    {
        return response()->json(Book::orderByDesc('id')->get()->all());
    }

    public function single(int $id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        return response()->json($book);
    }

    public function create(Request $request)
    {
        if (!$request->user()->isAdmin) {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        $request->validate([
            'author' => ['required'],
            'title' => ['required'],
            'year_of_publication' => ['required'],
            'place_of_publication' => ['required'],
            'price' => ['required']
        ]);

        $attributes = [
            'author' => $request['author'],
            'title' => $request['title'],
            'year_of_publication' => $request['year_of_publication'],
            'place_of_publication' => $request['place_of_publication'],
            'price' => $request['price'],
            'existence' => 1
        ];

        $book = Book::create($attributes);

        return response()->json($book);
    }

    public function update(int $id, Request $request)
    {
        if (!$request->user()->isAdmin) {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        $request->validate([
            'author' => ['required'],
            'title' => ['required'],
            'year_of_publication' => ['required'],
            'place_of_publication' => ['required'],
            'price' => ['required']
        ]);

        $attributes = [
            'author' => $request['author'],
            'title' => $request['title'],
            'year_of_publication' => $request['year_of_publication'],
            'place_of_publication' => $request['place_of_publication'],
            'price' => $request['price']
        ];

        Book::find($id)->update($attributes);

        return response()->json(Book::find($id));
    }

    public function delete(int $id, Request $request)
    {
        if (!$request->user()->isAdmin) {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        $book = Book::find($id);

        if ($book->delete()) {
            return response()->json($book);
        }

        return response()->json(null);
    }
}
