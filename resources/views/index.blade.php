@extends('layouts.app')

@section('content')
<form action="{{ route('store') }}" method="post">
    @csrf
    <h6>New paste</h6>
    <div class="form-group mb-3">
        <textarea name="content" id="paste-input"  class="d-none"></textarea>
        <div class="editor language-plaintext" contenteditable="plaintext-only"></div>
    </div>
    <h6>Optional paste settings</h6>
    <hr>
    <div class="col-12 col-lg-5">
        <div class="form-group my-3">
            <div class="mb-3 row">
                <label for="language-input" class="col-sm-5 col-form-label">Syntax Highlighting</label>
                <div class="col-sm-7">
                    <select name="language" id="language-input" class="form-control">
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group my-3">
            <div class="mb-3 row">
                <label for="language-input" class="col-sm-5 col-form-label">Paste Expiration</label>
                <div class="col-sm-7">
                    <select name="expires_at" id="expiration-input" class="form-control">
                        <option value="10-minutes">10 minutes</option>
                        <option value="1-hour">1 hour</option>
                        <option value="3-hours">3 hours</option>
                        <option value="1-day">1 day</option>
                        <option value="1-week">1 week</option>
                        <option value="never">Never</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group my-3">
            <div class="mb-3 row">
                <label for="access_type-input" class="col-sm-5 col-form-label">Paste Access</label>
                <div class="col-sm-7">
                    <select name="access_type" id="access_type-input" class="form-control">
                        <option value="public">Public</option>
                        <option value="unlisted">Unlisted</option>
                        <option value="private" {{ !Auth::check() ? "disabled" : "" }}>Private</option>
                    </select>
                    @guest
                        <small class="text-muted">Sign up to create private pastes</small>
                    @endauth
                </div>
            </div>
        </div>
        <div class="form-group my-3">
            <div class="mb-3 row">
                <label for="name-input" class="col-sm-5 col-form-label">Paste name</label>
                <div class="col-sm-7">
                    <input id="name-input" name="name" type="text" required>
                </div>
            </div>
        </div>
        <div class="form-group my-3">
            <button type="submit" class="btn btn-primary">Create new paste</button>
        </div>
    </div>
</form>
@endsection
