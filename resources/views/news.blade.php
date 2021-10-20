@extends('layout')

@section('content')
    <div class="section">
        <h1 class="title is-1 level">News</h1>
    </div>
    @forelse($messages as $message)
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="/storage/avatars/{{ $message->user->avatar ?? 'default_avatar.png' }}" alt="Avatar">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{ $message->user->email }}</strong>
                        <br>
                        {{ $message->content }}
                        <br>
                        <small><a>Like</a> · <a>Reply</a> · {{ $message->created_at }}</small>
                    </p>
                </div>
            </div>
        </article>
    @empty
        <p>No news found</p>
    @endforelse
@endsection
