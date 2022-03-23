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

        <!-- Content Wrapper. Contains page content -->
        <div style="margin-left: 0px;" class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

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
        <footer style="margin-left: 0px;" class="main-footer no-print">
            <div class="pull-right hidden-xs">
            </div>
            <strong>Copyright &copy; {{\Carbon\Carbon::now()->year}} <a target="_blank" href="https://www.cbpr.org.br">CBPR</a>.</strong> Todos os direitos reservados.
        </footer>
        <!-- ./Footer -->
    </div>
    <!-- ./wrapper -->

@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/InputMask/jquery.inputmask.bundle.min.js') }}" defer></script>
    <script>


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
    </script>
    @stack('js')
    @yield('js')
@stop



