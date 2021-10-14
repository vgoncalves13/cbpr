<html>
<head>

    <style type="text/css">
        html, body {
            font-size: 12px;
            margin: 10px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        h1, h2, h3, h4, h5 {
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .align-bottom {
            vertical-align: bottom !important
        }

        .align-middle {
            vertical-align: middle !important
        }

        .table {
            border: 0.5px solid black;
            border-collapse: collapse;
            width: 100%;

        }

        .table-bordeless td, th {
            border: none;
            padding: 3px;
        }

        .table-bordered td, th {
            border: 0.5px solid black;
            padding: 3px;
        }

        .text-grande {
            font-size: 16px;
            font-weight: bold;
        }

        .texto-demarcado {
            background-color: greenyellow;
            padding: 1px;
        }

        .texto-medio {
            font-size: 12px;
        }

        input {
            border-bottom: 0.5px solid black;
            display: inline-block;
            float: left;
        }

        div {
            margin: auto;
        }

        .checkbox {
            float: left;
        }

        .page-break {
            page-break-after: always;
        }

    </style>

</head>
<body>

<table style="width: 100%;">
    <tbody>
    <tr>
        <td style="width: 233px;" class="text-left align-middle">
            <img width="140px" height="80px" src="{{asset('storage/images/logo_cbpr.png')}}"><br>
            <h3>R. Carlos de Oliveira, 156 - Abolição, Rio de Janeiro - RJ, 20755-200</h3>
            <h3>Telefone: +55 21 98841-1190</h3>
        </td>
        <td>
            <h1 style="text-align: center">COMPROVANTE AGENDAMENTO CONSULTA</h1>
        </td>
        <td style="width: 233px;" class="text-right align-middle">
                        <span class="texto-medio">
                            <span class="texto-demarcado">
                                MATRÍCULA ASSOCIADO: <strong>{{$marcacao->pacienteable->matricula_nova}}</strong><br>
                            </span>
                            <span class="texto-demarcado">
                                DATA DA CONSULTA: <strong>{{$marcacao->dia_consulta}}</strong><br>
                            </span>
                            <span class="texto-demarcado">
                                HORA: <strong>{{$marcacao->hora_consulta}}</strong><br>
                            </span>
                        </span>
        </td>
    </tr>
    </tbody>
</table>
<br><br><br>
<table class="table">
    <tr>
        <td width="25%">Nome paciente:</td>
        <td width="75%">{{$marcacao->pacienteable->nome_completo}}</td>
    </tr>
    <tr>
        <td width="25%">CPF:</td>
        <td>{{$marcacao->pacienteable->cpf}}</td>
    </tr>
    <tr>
        <td width="25%">Data de nascimento</td>
        <td>{{\Carbon\Carbon::parse($marcacao->pacienteable->data_nascimento)->format('d/m/Y')}}</td>
    </tr>

</table>
<table class="table">
    <tbody>
    <tr>
        <td width="25%">Data da consulta:</td>
        <td>{{$marcacao->dia_consulta}} {{$marcacao->hora_consulta}}</td>
    </tr>
    <tr>
        <td width="25%">Médico:</td>
        <td width="25%">{{$marcacao->medico->nome}}</td>
    </tr>
    <tr>
        <td width="25%">Especialidade:</td>
        <td width="75%">{{$marcacao->especialidade->nome}}</td>
    </tr>
    </tbody>
</table>

</body>
</html>
