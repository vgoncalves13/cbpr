@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{getTotalAssociadosInadimplentes()+getTotalAssociadosAdimplentes()}}</h3>

                    <p>Total Associados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-contact-outline"></i>
                </div>
                <a href="{{route('associados.lista')}}" class="small-box-footer">
                    Mais informações <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-contact-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ADIMPLENTES</span>
                    <span class="info-box-number">{{getTotalAssociadosAdimplentes()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-contact-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">INADIMPLENTES</span>
                    <span class="info-box-number">{{getTotalAssociadosInadimplentes()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box">
                <span class="info-box-icon bg-light-blue"><i class="ion ion-ios-people"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL DEPENDENTES</span>
                    <span class="info-box-number">{{getTotalDependentes()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Associados por categoria</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                    {!! $graficoClasseAssociado->render() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>


    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@endsection