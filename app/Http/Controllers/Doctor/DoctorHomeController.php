<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class DoctorHomeController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('guardauth:doctor'),
            new Middleware('role:Doctor,doctor'),
        ];
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $doctor = Doctor::withCount([
            'subjects',
        ])
            ->find(auth()->guard('doctor')->id());

        return view('doctor.home', compact('doctor'));
    }
}
