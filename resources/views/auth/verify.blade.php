@extends('layouts.app')

@section('content')
    <h4 class="my-5">{{ __('Verify Your Email Address') }}</h4>
    <div class="col-13 col-lg-4">
        @if (session('resent'))
            <div class="alert alert-success my-3" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline my-3" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>
@endsection
