@extends('layouts.app')
@section('content')
    <h4 class="my-5">{{ __('Reset Password') }}</h4>
    <div class="col-13 col-lg-4">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group my-3">
                <label for="email-input">Email</label>
                <input id="email-input" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="password-input">Password</label>
                <input id="password-input" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="password-confirm-input">Confirm password</label>
                <input id="password-confirm-input" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group my-3">
                <button type="submit" class="btn btn-secondary px-5"> {{ __('Reset Password') }}</button>
            </div>
        </form>
    </div>
@endsection
