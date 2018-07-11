@extends('layouts.master')


<div class="container">
    <div class="row">
        <h2>Pesquisa Simples</h2>
        <form method="GET" action="{{route('associados.busca')}}">
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" name="busca" class="search-query form-control" placeholder="Procurar" />
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </div>
        </form>

    </div>
</div>