<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Services\BookService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function getUserContracts(Request $request)
    {
        $userId = $request->user()->id;
        return response()->json(Contract::where('user_id', $userId)->get()->all());
    }

    public function createContract(Request $request)
    {
        $request->validate([
            'book_id' => ['required']
        ]);

        try {
            $bookId = $this->bookService->rentBook($request['book_id']);
        } catch (Exception $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        $attributes = [
            'user_id' => $request->user()->id,
            'book_id' => $bookId,
        ];

        return response()->json(Contract::create($attributes));
    }

    public function deleteContract(int $id)
    {
        try {
            $contract = Contract::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        try {
            $deleted = $contract->delete();
        } catch (Exception $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        if ($deleted) {
            $this->bookService->returnBook($contract->book_id);
            return response()->json($contract);
        }

        return response()->json(null);
    }
}
