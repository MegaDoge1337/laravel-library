<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function list(Request $request)
    {
        if(!$request->user()->isAdmin)
        {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        return response()->json(Discount::all());
    }

    public function single(int $id, Request $request)
    {
        if(!$request->user()->isAdmin)
        {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        try {
            $discount = Discount::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        return response()->json($discount);
    }

    public function create(Request $request)
    {
        if(!$request->user()->isAdmin)
        {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        $request->validate([
            'user_id' => ['required'],
            'discount' => ['required']
        ]);

        $attributes = [
            'user_id' => $request->user_id,
            'discount' => $request->discount
        ];

        return response()->json(Discount::create($attributes));
    }

    public function update(int $id, Request $request)
    {
        if(!$request->user()->isAdmin)
        {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        $request->validate([
            'user_id' => ['required'],
            'discount' => ['required']
        ]);

        $attributes = [
            'user_id' => $request->user_id,
            'discount' => $request->discount
        ];

        Discount::find($id)->update($attributes);

        return response()->json(Discount::find($id));
    }

    public function delete(int $id, Request $request)
    {
        if(!$request->user()->isAdmin)
        {
            return response()->json([
                'error' => '403: Forbidden'
            ]);
        }

        try {
            $discount = Discount::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        try {
            $deleted = $discount->delete();
        } catch (Exception $exception) {
            return response()->json([
                'error' => "{$exception->getCode()}: {$exception->getMessage()}"
            ]);
        }

        if($deleted)
        {
            return response()->json($discount);
        }

        return response()->json(null);
    }
}
