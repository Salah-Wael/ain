<?php

namespace App\Http\Controllers\Doctor\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\DoctorLoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('doctor.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(DoctorLoginRequest $request): RedirectResponse
    {
        // Authenticate with ID and password
        $request->authenticate('doctor');

        // Regenerate session after successful login
        $request->session()->regenerate();

        // Redirect to the intended dashboard
        return redirect()->route('doctor.index');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('doctor.login');
    }
}
