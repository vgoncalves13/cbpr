@extends('adminlte::page')
@section('title','Trocar senha')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3>Trocar senha</h3>
                </div>
                <div class="box-body">
                    <form class="" method="POST" action="{{ route('changePassword') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="">Senha Atual</label>
                            <div class="col-md-auto">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="">Nova Senha</label>
                            <div class="col-md-auto">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>
                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirm" class="">Confirmar Nova Senha</label>
                            <div class="col-md-auto">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat">
                                    Trocar Senha
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
