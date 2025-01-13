@extends('front.partials.masterAuth')

@section('title', 'Login')

@section('content')

            <h4 class="mb-2">Welcome to Login Page! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form id="formAuthentication" class="mb-3" action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="id" class="form-label">Student ID</label>
                  <input
                    type="text"
                    class="form-control"
                    id="id"
                    name="id"
                    :value="old('id')"
                    placeholder="Enter your id"
                    autofocus
                    />
                    <x-input-error :messages="$errors->get('id')" class="mt-2" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        <a href="{{ route('password.request') }}">
                        <small>Forgot Password?</small>
                        </a>
                    </div>
                    <div class="input-group input-group-merge">
                        <input
                            type="password"
                            id="password"
                            class="form-control"
                            name="password"
                            placeholder="Enter Your Password"
                            aria-describedby="password"
                        />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" name="remember" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>New on our platform?</span>
                <a href="{{ route('register') }}">
                  <span>Create an account</span>
                </a>
              </p>
@endsection
