<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;

class DoctorHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('doctor.home');
    }
}
