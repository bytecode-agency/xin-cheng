@extends('layouts.app_guest')

@section('content')
    <div class="container">
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="loginArea p-5 bg-light">
                <div class="w-100 logoMain text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                </div>

                <!-- Form Area -->
                <form method="POST" action="{{ route('login') }}" class="w-100 mt-5">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>

                        <input id="email" type="email"
                            class="form-control rounded-0 shadow-none @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control rounded-0 shadow-none @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-start">
                            <!-- Checkbox -->
                            <div class="form-check d-flex align-items-center">

                                <input class="form-check-input shadow-none rounded-0" type="checkbox" name="remember"
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label  ms-2" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <!-- Simple link -->
                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4 w-100 rounded-0 shadow-none">
                        Sign in</button>

                    <!-- Register buttons -->
                    <!-- <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                    
                    </div> -->
                </form>

            </div>
        </section>

    </div>
@endsection
