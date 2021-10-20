@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('changePassword') }}">
                                <i class="fa fa-fw fa-user"></i> @isset(Auth::user()->associado->nome_completo){{Auth::user()->associado->nome_completo}}@endisset
                                   ({{Auth::user()->username}})
                            </a>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav">
                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">
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
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (Session::has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ Session::get('warning') }}
                    </div>
                @endif
                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <footer class="main-footer no-print">
            <div class="pull-right hidden-xs">
            </div>
            <strong>Copyright &copy; 2018 <a href="https://cbpr.org.br">CBPR</a>.</strong> Todos os direitos reservados.
        </footer>
        <!-- ./Footer -->
    </div>
    <!-- ./wrapper -->

@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/InputMask/jquery.inputmask.bundle.min.js') }}" defer></script>
    <script>

        {{--$.ajaxSetup({--}}
        {{--    headers: {--}}
        {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--    }--}}
        {{--});--}}
        {{--$(document).ready(function(){--}}
        {{--    $("#getHorarios").click(function()--}}
        {{--    {--}}
        {{--        valor = $(this).val();--}}
        {{--        $.ajax({--}}

        {{--            type:'GET',--}}
        {{--            url:"{!! URL::to('/marcacoes/horarios/2021-05-20') !!}",--}}
        {{--            dataType: 'JSON',--}}
        {{--            data: {--}}
        {{--                "valor": valor--}}
        {{--            },--}}
        {{--            success:function(data){--}}
        {{--                // Caso ocorra sucesso, como faço para pegar o valor--}}
        {{--                // que foi retornado pelo controller?--}}
        {{--                alert('Sucesso');--}}
        {{--            },--}}
        {{--            error:function(){--}}
        {{--                alert('Erro');--}}
        {{--            },--}}
        {{--        });--}}


        {{--    });--}}
        {{--});--}}
        function getHorarios() {
            var horarios;
            horarios = ['09:00','09:15','09:30','09:45',
                '10:00','10:15','10:30','10:45',
                '11:00','11:15','11:30','11:45',
                '12:00','12:15','12:30','12:45',
                '13:00','13:15','13:30','13:45',
                '14:00','14:15','14:30','14:45',
                '15:00','15:15','15:30','15:45',
                '16:00','16:15','16:30','16:45',
                '17:00',
            ];
            return horarios;
        }
        function getDiasMarcados(dias) {
            $.ajax({
                url: "{!! URL::to('/marcacoes/horarios') !!}" + '/' + dias,
                error: function() {
                    $('#info').html('<p>An error has occurred</p>');
                },
                dataType: 'json',
                success: function(data) {
                    var select = document.createElement("select");
                    select.name = "hora_consulta";
                    select.id = "hora_consulta"
                    select.setAttribute('class','form-select')

                    for (const val of getHorarios())
                    {
                        var option = document.createElement("option");
                        option.value = val;
                        for (horario_marcado of data){
                            if (option.value === horario_marcado['hora_consulta']){
                                option.disabled = true;
                            }
                        }
                        option.text = val.charAt(0).toUpperCase() + val.slice(1);
                        select.appendChild(option);
                    }

                    var label = document.createElement("label");
                    label.innerHTML = "Escolha o horário: "
                    label.htmlFor = "hora_consulta";

                    document.getElementById("info").appendChild(label).appendChild(select).animate([
                            {transform: 'translate(-300px)'},
                            {transform: 'translate(0px)'}
                        ],{
                            duration: 500,
                            iterations: 1
                        }
                    );

                },
                type: 'GET'
            });
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('#associado_id').select2({
            ajax: {
                url: '{{'/associados/load/select2'}}',
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page || 1
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    data.page = data.page || 1;
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: item.nome_completo
                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    }
                },
                cache: true,
                delay: 250
            },
            placeholder: 'Selecione um associado',
            minimumInputLength: 3,
            multiple: false
        });

        $(function() {
            $('#associados-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('associados.datatables.data') !!}',
                columns: [
                    { data: 'nome_completo', name: 'nome_completo' },
                    { data: 'classe', name: 'classe' },
                    { data: 'data_nascimento', name: 'data_nascimento' },
                    { data: 'cpf', name: 'cpf' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
        $(function() {
            $('#dependentes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('dependentes.datatables.data') !!}',
                columns: [
                    { data: 'nome_completo', name: 'nome_completo' },
                    { data: 'grau_parentesco', name: 'grau_parentesco' },
                    { data: 'data_nascimento', name: 'data_nascimento' },
                    { data: 'associado_id', name: 'associado_id' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
    @stack('js')
    @yield('js')
@stop

