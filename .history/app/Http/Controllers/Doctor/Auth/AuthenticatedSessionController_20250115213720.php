<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(DLoginRequest $request): RedirectResponse
    {
        // Authenticate with ID and password
        $request->authenticate();

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
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
