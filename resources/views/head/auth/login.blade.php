@extends('head.partials.masterAuth')

@section('title', __('messages.head_of_department_login'))

@section('content')

    <h4 class="mb-2">{{ __('messages.welcome_login') }}</h4>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form id="formAuthentication" class="mb-3" action="{{ route('head.login.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">{{ __('messages.id') }}</label>
            <input type="text" class="form-control" id="id" name="id" :value="old('id')"
                placeholder="{{ __('messages.enter_your_id') }}" autofocus />
            <x-input-error :messages="$errors->get('id')" class="mt-2" />
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">{{ __('messages.password') }}</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="{{ __('messages.enter_your_password') }}"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" name="remember" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me">{{ __('messages.remember') }}</label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">{{ __('messages.login') }}</button>
        </div>

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('back.login') }}" class="btn btn-primary w-100 mx-1">{{ __('messages.admin') }}</a>
            <a href="{{ route('doctor.login') }}" class="btn btn-primary w-100 mx-1">{{ __('messages.doctor') }}</a>
            <a href="{{ route('login') }}" class="btn btn-primary w-100 mx-1">{{ __('messages.student') }}</a>
        </div>
    </form>
@endsection
