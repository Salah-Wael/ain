<?php

namespace App\Http\Controllers\Head\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\HeadLoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('head.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(HeadLoginRequest $request): RedirectResponse
    {
        // Authenticate with ID and password
        $request->authenticate();

        // Regenerate session after successful login
        $request->session()->regenerate();

        // Redirect to the intended dashboard
        return redirect()->route('head.index');
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
