<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Head extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('head.home');
    }
}
