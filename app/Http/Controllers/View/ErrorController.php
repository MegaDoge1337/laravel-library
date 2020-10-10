<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function showErrorMessage(Request $request)
    {
        if($request->session()->get('error'))
        {
            return view('error.error', ['error' => $request->session()->get('error')]);
        }

        return view('error.error', [
            'error' => '500: Error is undefined'
        ]);
    }
}
