@extends('layout')

@push('scripts')
    <script type="text/javascript">
        function toggleModal() {
            let modal = document.getElementsByClassName('modal');

            modal[0].classList.toggle('is-active');
        }
    </script>
@endpush

@section('content')
    <div class="section">
        <div class="media">
            <div class="media-left">
                <h1 class="title is-1">Blog</h1>
            </div>
            @auth
                <a
                    class="button is-rounded is-primary modal-button"
                    data-target="modal"
                    aria-haspopup="true"
                    onclick="toggleModal()"
                >
                    New channel
                </a>
                <nav class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <div class="modal">
                                <div class="modal-background"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head">
                                        <p class="modal-card-title">New channel</p>
                                        <button class="delete" onclick="toggleModal()" aria-label="close"></button>
                                    </header>
                                    <form action="/blog" method="post" enctype="multipart/form-data">
                                        <section class="modal-card-body">
                                            @csrf
                                            @include('partials.new-channel')
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
    <div class="section columns is-multiline">
        @forelse($channels as $channel)
            <div class="column is-one-quarter-desktop is-half-tablet">
                <div class="card">
                    <a href="blog/channels/{{ $channel->id }}">
                        <div class="card-image">
                            <figure class="image is-5by3">
                                <img src="/storage/channels/{{ $channel->illustration ?? 'default_channel.png' }}" alt="{{ $channel->name }}" width="250" height="150">
                            </figure>
                            <div class="card-content is-overlay is-clipped">
                              <span class="tag is-rounded is-{{ $channel->colour }}">
                                {{ $channel->name }}
                              </span>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <div class="card-footer-item">
                                Take a look
                            </div>
                        </footer>
                    </a>
                </div>
            </div>
        @empty
            <p>No channels found</p>
        @endforelse
    </div>
@endsection
