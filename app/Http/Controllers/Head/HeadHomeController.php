<?php

namespace App\Http\Controllers\Head;

use App\Models\Excuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class HeadHomeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('guardauth:head'),
            new Middleware('role:Head-Of-Department,head'),
        ];
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $excuses_count = Excuse::where('department_id', Auth::guard('head')->user()->department_id)
        ->where('status', 'pending')
        ->count();

        $statistics = [
            'total_excuses' => $excuses_count,
        ];

        return view('head.home', compact('statistics'));
    }
}
