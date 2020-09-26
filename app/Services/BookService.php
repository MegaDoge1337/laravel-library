<?php

namespace App\Services;

use App\Models\Book;
use Exception;

class BookService
{
    public function rentBook(int $bookId)
    {
        $book = Book::find($bookId);

        if(!$book)
        {
            throw new Exception('Book not found', 404);
        }

        if(!$book->existence)
        {
            throw new Exception('Book already rent or lost', 400);
        }

        return $bookId;
    }
}
