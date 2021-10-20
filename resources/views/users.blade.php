@extends('layout')

@section('content')
    <div class="section">
        <h1 class="title is-1">Welcome !</h1>
        @auth
            <section class="section">
                <h2 class="title is-2">Followed users</h2>
                    <ul>
                        @forelse(auth()->user()->following as $followed)
                            <li>
                                <a href="{{ $followed->email }}">{{ $followed->email }}</a>
                            </li>
                        @empty
                            <em>You are not following anyone...</em>
                        @endforelse
                    </ul>
            </section>
        @endauth
        <section class="section">
            <h2 class="title is-2">All users</h2>
            <ul>
                @foreach($users as $user)
                    <li>
                        <a href="/{{ $user->email }}">{{ $user->email }}</a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
