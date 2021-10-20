@extends('layout')

@section('title')
    @parent - {{ $article->name }}
@endsection

@section('content')
    <div class="section">
        <h3 class="title is-3">{{ $article->name }}</h3>
        @if($article->youtube)
            <iframe src="https://www.youtube.com/embed/{{ $article->youtube }}" allowfullscreen=""></iframe>
        @endif
        <p>{!! $content !!}</p>
    </div>
@endsection
