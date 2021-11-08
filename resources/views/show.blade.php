@extends('layouts.app')

@section('content')
    @guest
        <div class="alert alert-info">
            Not an our buddy now? <a href="{{ route('register') }}">Sign Up</a>, it unlocks many cool features!
        </div>
    @endauth
    <div class="row my-3">

        <div class="col-12 col-lg">
            {{ $paste->name !== '' ? $paste->name : 'Untitled' }} <br>
            <small class="text-muted fs-7">
                {{ isset($paste->user->name) ? $paste->user->name : 'Guest' }}
                | Published: {{ $paste->created_at->diffForHumans() }}
                | Expired in: {{ $paste->expires_at === null ? 'never' : $paste->expires_at->diffForHumans() }}
                @auth
                    @if ( Auth::user()->id  == $paste->user_id )
                        | <a href="{{url("/edit/{$paste->url_path}")}}">Edit</a>
                    @endif
                @endauth
            </small>
        </div>
    </div>
    <div class="form-group mb-3">
        <textarea name="content" id="paste-input"  class="d-none"></textarea>
        <div class="editor language-{{$paste->language}}" contenteditable="plaintext-only">{{$paste->content}}</div>
    </div>

@endsection
