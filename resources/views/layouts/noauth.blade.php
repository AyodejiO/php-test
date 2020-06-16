<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rick and Morty Characters</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Rick and Morty Characters
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="{{route("characters.index")}}">{{ __('Characters') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('Locations') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('Episodes') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="mb-5">
                <form action="{{route("characters.index")}}" method="get" class="form-inline w-50 center mx-auto">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter Characters</label>
                        <input class="form-control mb-2 mr-sm-2" type="text" name="name" id="name" placeholder="Character Name">
                        <select class="form-control mb-2 mr-sm-2" name="status" id="status">
                            <option value="">Status</option>
                            <option value="alive">alive</option>
                            <option value="dead">dead</option>
                            <option value="unknown">unknown</option>
                        </select>
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        <a href="{{route("characters.index")}}" class="btn btn-danger ml-2 mb-2">Clear Filter</a>
                    </form>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
