<?php
function getTotalAssociadosAdimplentes()
{
    $resultado = App\Associado::where('status', 1)
        ->count();

    return $resultado;
}

function getTotalAssociadosInadimplentes()
{
    $resultado = App\Associado::where('status', 0)
        ->count();

    return $resultado;
}
function getTotalDependentes()
{
    $resultado = App\Dependente::where('status',1)->count();

    return $resultado;
}

function getTotalClasse($classe)
{
    $resultado = App\Associado::where('classe',$classe)->count();

    return $resultado;
}

