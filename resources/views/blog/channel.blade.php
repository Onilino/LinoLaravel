@extends('layout')

@section('title')
    @parent - {{ $channel->name }}
@endsection

@push('scripts')
    <script type="text/javascript">
        function toggleModal() {
            let modal = document.getElementsByClassName('modal');

            modal[0].classList.toggle('is-active');
        }
    </script>

    <script>
        document.body.classList.add('has-background-{{ $channel->colour }}-light')
    </script>

    <script type="text/javascript">
        document.querySelectorAll('.overlay').forEach(overlay => {
            var iframe = overlay.parentNode.querySelector('iframe');
            iframe.src = '';
            overlay.addEventListener('click', function () {
               iframe.src = iframe.dataset.src;

               var svg = overlay.querySelector('svg');
               svg.style.transition = 'all 0.5s';
               svg.classList.add('w-full', 'opacity-0');
               svg.addEventListener('transitionend', function () {
                   overlay.classList.add('hidden');
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style >
        ul {
            margin: auto !important;
        }

        .card {
            width: 18rem;
        }
    </style>
@endpush

@section('content')
    <div class="section">
        <div class="media">
            <div class="media-left">
                <h1 class="title is-1">{{ $channel->name }}</h1>
            </div>
            <div class="media-content">
                @auth
                    <a
                        class="button is-rounded is-{{ $channel->colour }} modal-button"
                        data-target="modal"
                        aria-haspopup="true"
                        onclick="toggleModal()"
                    >
                        New article
                    </a>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="modal">
                                    <div class="modal-background"></div>
                                    <div class="modal-card">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">New article</p>
                                            <button class="delete" onclick="toggleModal()" aria-label="close"></button>
                                        </header>
                                        <form action="/blog/channels/{{ $channel->id }}" method="post"
                                              enctype="multipart/form-data">
                                            <section class="modal-card-body">
                                                @csrf
                                                @include('partials.new-article')
                                            </section>
                                            <footer class="modal-card-foot">
                                                <button class="button is-success" type="submit">Save changes</button>
                                                <a class="button" onclick="toggleModal()">Cancel</a>
                                            </footer>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                @endauth
            </div>
        </div>
    </div>

    <main class="py-16">
        @forelse($channel->articles as $article)
            <section class="container mx-auto mb-32 px-3">
                <h2 class="my-8 text-gray-800 font-normal text-2xl">
                    {{ $article->name }} - <a href="/blog/articles/{{ $article->id }}" class="text-laravel no-underline">Voir l'article &rarr;</a>
                </h2>
                <div class="w-full xl:w-2/3">
                    @if($article->youtube)
                       <div class="embed-responsive embed-responsive-16by9">
                            <div class="embed-responsive-item">
                                <div class="overlay cursor-pointer">
                                    <div class="absolute w-full h-full z-20 bg-black opacity-75 flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512" class="w-24 fill-current text-youtube">
                                            <path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" class=""></path>
                                        </svg>
                                    </div>
                                    <div class="absolute w-full h-full z-10">
                                        <img src="https://img.youtube.com/vi/{{ $article->youtube }}/maxresdefault.jpg" alt="Thumbnail" />
                                    </div>
                                </div>
                                <iframe data-src="https://www.youtube.com/embed/{{ $article->youtube }}?autoplay=1" allowfullscreen="" class="absolute w-full h-full z-0"></iframe>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @empty
            <p>This channel looks empty</p>
        @endforelse
    </main>
@endsection
