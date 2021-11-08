@extends('layouts.app')
@section('content')
    <h4 class="my-5">{{ __('Reset Password') }}</h4>
    <div class="col-13 col-lg-4">
        <form method="post" action="{{ route('password.email') }}">
            @csrf
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-group my-3">
                <label for="email-input">Email</label>
                <input id="email-input" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group my-3">
                <button type="submit" class="btn btn-secondary px-5">{{ __('Reset password') }}</button>
            </div>
        </form>
    </div>
@endsection
