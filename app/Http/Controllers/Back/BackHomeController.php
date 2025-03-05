<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\HeadOfDepartment;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class BackHomeController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('guardauth:admin'),
            // new Middleware('role:Admin'),
        ];
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $statistics = [
            'total_students' =>User::count(),
            'total_subjects' => Subject::count(),
            'total_doctors' => Doctor::count(),
            'total_head_of_departments' => HeadOfDepartment::count(),
        ];

        return view('back.home', compact('statistics'));
    }
}
