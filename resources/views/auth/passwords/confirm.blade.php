@extends('layouts.app')
@section('content')
    <h4 class="my-5">{{ __('Confirm Password') }}</h4>
    <p>{{ __('Please confirm your password before continuing.') }}</p>
    <div class="col-13 col-lg-4">
        <form method="post" action="{{ route('password.confirm') }}">
            @csrf
            <div class="form-group my-3">
                <label for="password-input">Password</label>
                <input id="password-input" type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group my-3">
                <button type="submit" class="btn btn-secondary px-5">{{ __('Confirm password') }}</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
@endsection
