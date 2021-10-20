@extends('layout')

@section('content')
    <div class="section">
        <div class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <img src="/storage/avatars/{{ auth()->user()->avatar ?? 'default_avatar.png' }}" alt="Avatar">
                </figure>
            </div>
            <div class="media-content">
                <h1 class="title is-1">My account</h1>
            </div>
        </div>
        <p>Hello, {{ auth()->user()->email }} !</p>

        <form action="/avatar-modification" method="post" class="section" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label class="label">Avatar</label>
                <div class="control">
                    <input class="input" type="file" name="avatar">
                </div>
                @if($errors->has('avatar'))
                    <p class="help is-danger">{{$errors->first('avatar')}}</p>
                @endif
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-link" type="submit">Modify avatar</button>
                </div>
            </div>
        </form>

        <form action="/password-modification" method="post" class="section">
            @csrf

            <div class="field">
                <label class="label">Old password</label>
                <div class="control">
                    <input class="input" type="password" name="old-password">
                </div>
                @if($errors->has('old-password'))
                    <p class="help is-danger">{{$errors->first('old-password')}}</p>
                @endif
            </div>

            <div class="field">
                <label class="label">New password</label>
                <div class="control">
                    <input class="input" type="password" name="new-password">
                </div>
                @if($errors->has('new-password'))
                    <p class="help is-danger">{{$errors->first('new-password')}}</p>
                @endif
            </div>

            <div class="field">
                <label class="label">New password (Confirmation)</label>
                <div class="control">
                    <input class="input" type="password" name="new-password_confirmation">
                </div>
                @if($errors->has('new-password_confirmation'))
                    <p class="help is-danger">{{$errors->first('new-password_confirmation')}}</p>
                @endif
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-link" type="submit">Change password</button>
                </div>
            </div>
        </form>
    </div>
@endsection
