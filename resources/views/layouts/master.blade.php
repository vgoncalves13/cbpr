<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Victor Hugo Alves">

    <title>CBPR - @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
          integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/css-toggle-switch@latest/dist/toggle-switch.css" />
    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 72px;
        }

        @media (min-width: 992px) {
            body {
                padding-top: 72px;
            }
        }
    </style>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">CBPR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @guest
                @else
                    @if(!Auth::user()->isGuest())
                        <li class="nav-item {{ Request::path() == '/' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('associados.index')}}">Página Inicial </a>
                        </li>
                        <li class="nav-item {{ Request::path() == 'associados/create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('associados.create')}}">Cadastrar</a>
                        </li>
                    @endif
                        <li class="nav-item {{ Request::path() == 'procurar' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('associados.procurar')}}">Procurar</a>
                        </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/changePassword">
                                Trocar Senha
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- Page Content -->
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-12">
        @if ($errors->any())
            <!-- Exibição erro validação -->
                <div class="alert alert-danger">
                    <strong>Opa!</strong> Algo de errado com os dados inseridos.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @yield('content')
            @yield('scripts')
        </div>
    </div>
</div>
</body>

<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/InputMask/jquery.inputmask.bundle.min.js') }}" defer></script>

</html>