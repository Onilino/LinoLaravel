@extends('layout')

@section('content')
    <div class="section">
        <div class="level-left">
            <div class="level-item">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="/storage/avatars/{{ $user->avatar ?? 'default_avatar.png' }}" alt="Avatar">
                        </figure>
                    </div>
                    <div class="media-content">
                        <h1 class="title is-1">{{ $user->email }}</h1>
                    </div>
                </div>
            </div>
            @auth
                @if(auth()->user()->id != $user->id)
                    <form class="level-item" method="post" action="/{{ $user->email }}/follow">
                        @csrf
                        @method(auth()->user()->isFollowing($user) ? 'delete' : 'post')
                        <button class="button is-small {{ auth()->user()->isFollowing($user) ? '' : 'is-success' }}"
                                type="submit">
                            {{ auth()->user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}
                        </button>
                    </form>
                @endif
            @endauth
        </div>
        @if(auth()->check() and auth()->user()->id === $user->id)
            <form action="/messages" method="post" class="section">
                @csrf

                <div class="field">
                    <label class="label">Message</label>
                    <div class="control">
                        <textarea class="textarea" name="message" placeholder="Put your message here..."></textarea>
                    </div>
                    @if($errors->has('message'))
                        <p class="help is-danger">{{ $errors->first('message') }}</p>
                    @endif
                </div>

                <div class="field">
                    <div class="control">
                        <button class="button is-link" type="submit">Publish</button>
                    </div>
                </div>
            </form>
        @endif

        <div class="section">
        @foreach($user->messages as $message)
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>
                            {{ $message->content }}
                            <br>
                            <small><a>Like</a> · <a>Reply</a> · {{ $message->created_at }}</small>
                        </p>
                    </div>
                </div>
            </article>
        @endforeach
        </div>
    </div>
@endsection
