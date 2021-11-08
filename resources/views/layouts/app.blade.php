<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <span class="fs-4 text-info">Pastebin</span>
        </a>
        @guest
            <div class="col-md-3 text-end">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">{{ __('Sign in') }}</a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Sign up') }}</a>
                @endif
            </div>
        @else
            <div class="col-md-3 text-end">
                @if (Route::has('logout'))
                    <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Sign out') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endif
            </div>
        @endguest
    </header>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-10">
            @yield('content')
        </div>
        <div class="col-12 col-lg-2">
            @if (count($recent_pastes) > 0)
                <h6>Public pastes</h6>
                @foreach ($recent_pastes as $paste)
                    <p class="mb-0">
                        <a href="{{url("/{$paste->url_path}")}}">{{ $paste->name }}</a><br>
                        <small class="text-muted text-capitalize fs-7">{{ $paste->language }} | {{ $paste->created_at->diffForHumans() }}</small>
                    </p>
                @endforeach
            @endif
            @if (isset($recent_user_pastes) and count($recent_user_pastes) > 0)
                <hr>
                <h6 class="mt-2"><a href="{{ route('my') }}" class="nav-link px-2 link-secondary">My pastes</a></h6>
                @foreach ($recent_user_pastes as $paste)
                    <p class="mb-0">
                        <a href="{{url("/{$paste->url_path}")}}">{{ $paste->name }}</a><br>
                        <small class="text-muted text-capitalize fs-7">{{ $paste->language }} | {{ $paste->created_at->diffForHumans() }}</small>
                    </p>
                @endforeach
            @endif
        </div>
    </div>
</div>
</body>
</html>
