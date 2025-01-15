<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('head.home');
    }
}
