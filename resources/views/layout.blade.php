<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>
            @section('title')
                Lino Laravel
            @show
        </title>

        @stack('styles')
    </head>

    <body class="antialiased">

        <nav class="navbar is-light" role="navigation">
            <div class="navbar-brand">
                <a id="navbarBurger" role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbarLayout" class="navbar-menu">
                <div class="navbar-start">
                    @include('partials.navbar-item', [ 'link' => '/', 'label' => "Home"])
                    @include('partials.navbar-item', [ 'link' => '/blog', 'label' => "Blog"])
                    @auth
                        @include('partials.navbar-item', [ 'link' => '/news', 'label' => 'News'])
                        @include('partials.navbar-item-picture_profile', [ 'link' => auth()->user()->email, 'label' => auth()->user()->email])
                    @endauth
                </div>
                <div class="navbar-end">
                    @guest
                        @include('partials.navbar-item', [ 'link' => 'login', 'label' => "Login"])
                        @include('partials.navbar-item', [ 'link' => 'signup', 'label' => "Signup"])
                    @else
                        @include('partials.navbar-item', [ 'link' => 'my-account', 'label' => "My account"])
                        @include('partials.navbar-item', [ 'link' => 'logout', 'label' => "Logout"])
                    @endif
                </div>
            </div>
        </nav>

        <div class="container">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

                @include('flash::message')
                @yield('content')

            </div>

        </div>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">

        @stack('scripts')

        <script type="text/javascript">
            const navbarBurger = document.getElementById('navbarBurger')

            navbarBurger.addEventListener('click', () => {
                const target = document.getElementById('navbarLayout');

                navbarBurger.classList.toggle('is-active');
                target.classList.toggle('is-active');
            });
        </script>
    </body>
</html>
