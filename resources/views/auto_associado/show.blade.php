@extends('adminlte::page')
@section('title', 'Index')

@section('content')

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3>Detalhes do associado</h3>
        </div>
        <div class="box-body">
            <div class="col-12 col-md-6">
                <h4>Dados pessoais</h4>
                <p><strong>Nome comepleto:</strong> {{$associado['nome_completo']}}</p>
                <p><strong>Classe:</strong> {{$associado['classe']}}</p>
                <p><strong>Nome da mãe:</strong> {{$associado['nome_mae']}}</p>
                <p><strong>Nome do pai:</strong> {{$associado['nome_pai']}}</p>
                <p><strong>Naturalidade:</strong> {{$associado['naturalidade']}}</p>
                <p><strong>Estado civil:</strong> {{$associado['estado_civil']}}</p>
                <p><strong>Data de nascimento:</strong> {{$associado['data_nascimento']}}</p>
                <p><strong>CPF:</strong> {{$associado['cpf']}}</p>
                <p><strong>Telefone trabalho:</strong> {{$associado['telefone_trabalho']}}</p>
                <p><strong>Telefone casa:</strong> {{$associado['telefone_casa']}}</p>
                <p><strong>Telefone celular:</strong> {{$associado['telefone_celular']}}</p>
                <p><strong>E-mail:</strong> {{$associado['email']}}</p>
            </div>
            <div class="col-12 col-md-6">
                <h4>Endereço</h4>
                <p><strong>Logradouro:</strong> {{$associado['logradouro']}}</p>
                <p><strong>Número:</strong> {{$associado['numero']}}</p>
                <p><strong>Complemento:</strong> {{$associado['complemento']}}</p>
                <p><strong>Bairro:</strong> {{$associado['bairro']}}</p>
                <p><strong>CEP:</strong> {{$associado['cep']}}</p>
            </div>
        </div>
        <div class="box-footer">
            <p>Criado em: {{\Carbon\Carbon::parse($associado['created_at'])->format('d/m/Y H:i:s')}}</p>

            <form method="POST" action="{{route('auto_cadastro.destroy',$associado['id'])}}">
                @csrf
                @method('DELETE')
                    <div class="form-group">
                        <a class="btn btn-success" href="{{route('auto_cadastro.approve',$associado['id'])}}">Aprovar</a>
                        <input type="submit" class="btn btn-danger delete-auto-cadastro" value="Apagar">
                    </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.delete-auto-cadastro').click(function(e){
            e.preventDefault()
            if (confirm('Tem certeza que deseja apagar?')) {
                $(e.target).closest('form').submit();
            }
        });
    </script>
@endsection