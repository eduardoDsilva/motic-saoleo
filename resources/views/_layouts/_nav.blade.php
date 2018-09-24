@if(Auth::guest())

    <nav class="blue darken-4">
        <div class="nav-wrapper blue darken-4 container">
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <a href="{{route ('home')}}" class="brand-logo center">MOTIC</a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="{{route('sobre') }}">Sobre</a></li>
                <li><a href="{{route('contato') }}">Contato</a></li>
                @php
                    $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first();
                    $data = new \DateTime();
                    $nova_data = date('Y-m-d', strtotime($data->format('Y-m-d')));
                    $nova_hora = date('H:i:s', strtotime($data->format('H:i:s')));

                    $de = date('Y-m-d', strtotime($avaliacao->data_inicio));
                    $hora_inicial = date('H:i:s', strtotime($avaliacao->hora_inicio));
                    $ate = date('Y-m-d', strtotime($avaliacao->data_fim));
                    $hora_final = date('H:i:s', strtotime($avaliacao->hora_fim));

                    if(($nova_data >= $de) && ($nova_hora >= $hora_inicial) && ($nova_data <= $ate) && ($nova_hora <= $hora_final)) {
                        @endphp<li><a href="{{route('votacao-popular') }}">Votação popular</a></li>@php
                    }
                @endphp
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route ('regulamento')}}">Regulamento</a></li>
                <li><a href="{{route('login') }}">Login</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="{{route ('home')}}">Home</a></li>
                <li><a href="{{route('sobre') }}">Sobre</a></li>
                <li><a href="{{route('contato') }}">Contato</a></li>
                @php
                    $avaliacao = \App\Avaliacao::orderBy('id', 'desc')->first();
                    $data = new \DateTime();
                    $nova_data = date('Y-m-d', strtotime($data->format('Y-m-d')));
                    $nova_hora = date('H:i:s', strtotime($data->format('H:i:s')));

                    $de = date('Y-m-d', strtotime($avaliacao->data_inicio));
                    $hora_inicial = date('H:i:s', strtotime($avaliacao->hora_inicio));
                    $ate = date('Y-m-d', strtotime($avaliacao->data_fim));
                    $hora_final = date('H:i:s', strtotime($avaliacao->hora_fim));

                    if(($nova_data >= $de) && ($nova_hora >= $hora_inicial) && ($nova_data <= $ate) && ($nova_hora <= $hora_final)) {
                @endphp<li><a href="{{route('votacao-popular') }}">Votação popular</a></li>@php
                    }
                @endphp
                <li><a href="{{route ('regulamento')}}">Regulamento</a></li>
                <li><a href="{{route('login') }}">Login</a></li>
            </ul>
        </div>
    </nav>

@else
    <div class="navbar-fixed">
        <nav>
            <div class="blue darken-4">
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i
                                    class="material-icons">menu</i></a>
                        <div class="col s12">
                            @yield('breadcrumb')
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <ul class="side-nav fixed" id="mobile-demo">
        <li>
            <div class="user-view blue darken-4">
                <span class="white-text name">{{ Auth::user()->name }}</span>
                <span class="white-text email">{{ Auth::user()->email }}</span>
            </div>
            <img class='margem' src="{{url('images/motic-logo.png')}}" alt="motic" height="65" width="275">
        </li>
        @if(Auth::user()->tipoUser == 'admin')
            @include('admin.nav.nav')
        @elseif(Auth::user()->tipoUser == 'escola')
            @include('escola.nav.nav')
        @elseif(Auth::user()->tipoUser == 'professor')
            @include('professor.nav.nav')
        @elseif(Auth::user()->tipoUser == 'avaliador')
            @include('avaliador.nav.nav')
        @endif
    </ul>
@endif

