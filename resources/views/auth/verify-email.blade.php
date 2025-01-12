@extends('front.partials.masterAuth')

@section('title', 'Verify Email')

@section('content')
    <h4 class="mb-2">Email Verification Required 📧</h4>
    <p class="mb-4">
        {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just sent to your inbox. If you didn\'t receive the email, we can send you another.') }}
    </p>

    {{-- <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="btn btn-primary d-grid w-100">{{ __('Resend Verification Email') }}</button>
    </form>

    <div class="text-center mt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary w-100">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
@endsection
