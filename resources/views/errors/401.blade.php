@extends('layouts.master')
@section('title','401')
@section('content')
    <style type="text/css">
        @import url('//fonts.googleapis.com/css?family=Roboto');
        body {
            background: #69afcc;
            color: #FFFFFF;
            font: 16px/1.3 "Roboto", sans-serif;
        }

        header {
            width: 100%;
            margin:0px auto;
        }
        h1 {
            text-align: center;
            color:#FFFFFF;
            font: 100px/1 "Roboto";
            text-transform: uppercase;
            margin: 5% auto 5%;
            margin-bottom: 35px;
        }

        article { display: block; text-align: center; width: 650px; margin: 10px auto; }

        @media screen and (max-width: 720px) {
            article { display: block; text-align: center; width: 450px; margin: 0 auto; }
            h1 { font: 70px/1 "Roboto";}
            .wrap {margin-top: 50px;}
        }

        @media screen and (max-width: 480px) {
            article { display: block; text-align: center; width: 300px !important; margin: 0 auto; }
            h1 { font: 50px/1 "Roboto";}
            .wrap {margin-top: 50px;}

        }
    </style>

<div class="wrap">
    <article>
        <header>
            <h1 id="fittext1">401<i class="fa fa-exclamation-triangle fa-fw"></i></h1>
        </header>
        <h2>Sem autorização</h2>
        <a id="botao" href="{{url()->previous()}}" data-original-title="Voltar" data-toggle="tooltip"  type="submit" class="btn btn-primary"><i class="fa fa-arrow-left"> Voltar</i></a>
    </article>
</div>
@endsection