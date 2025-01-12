@extends('back.partials.masterAuth')

@section('title', 'Confirm Password')

@section('content')
    <h4 class="mb-2">Confirm Password 🔒</h4>
    <p class="mb-4">This is a secure area of the application. Please confirm your password before continuing.</p>

    <form id="formAuthentication" class="mb-3" action="{{ route('back.password.confirm') }}" method="POST">
        @csrf

        <!-- Password -->
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" required autocomplete="current-password"
                    placeholder="Enter Your Password" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <button class="btn btn-primary d-grid w-100">Confirm</button>
    </form>

    <div class="text-center">
        <a href="{{ route('back.login') }}" class="d-flex align-items-center justify-content-center">
            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
            Back to login
        </a>
    </div>
@endsection
