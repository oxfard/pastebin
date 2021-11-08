@extends('layouts.app')

@section('content')
    <h4 class="my-5">Welcome dude!</h4>
    <p>Please enter the fields below to sign in</p>
    <div class="col-13 col-lg-4">
        <form method="post">
            @csrf
            <div class="form-group my-3">
                <label for="email-input">Email</label>
                <input id="email-input" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="password-input">Password</label>
                <input id="password-input" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group my-3">
                <a href="/vk/auth">Вход через Вк</a>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
            @if (Route::has('password.request'))
                <div class="form-group my-3">
                    <a href="{{ route('password.request') }}">
                        forgot password?
                    </a>
                </div>
            @endif
            <div class="form-group my-3">
                <button type="submit" class="btn btn-secondary px-5">Sign in</button>
            </div>
        </form>
    </div>
@endsection
