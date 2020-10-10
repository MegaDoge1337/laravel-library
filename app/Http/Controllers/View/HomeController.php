<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(!Cookie::get('token'))
        {
            Auth::logout();
            return redirect('/login');
        }

        return view('home');
    }
}
