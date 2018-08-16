<?php

use Faker\Generator as Faker;

//$localisedFaker = Faker\Factory::create("pt_BR");
$faker = new Faker;


$factory->define(App\Associado::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
    $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
    return [
        'matricula_antiga' => $faker->unique()->randomNumber(6),
        'matricula_nova' => $faker->unique()->randomNumber(6),
        'cpf' => $faker->cpf(),
        'graduacao' => $faker->text('10'),
        'admissao' => $faker->date('Y-m-d'),
        'classe' => 'CBMERJ',
        'nome_completo' => $faker->name(),
        'nome_mae' => $faker->firstNameFemale(),
        'nome_pai' => $faker->firstNameMale(),
        'naturalidade'=> $faker->city(),
        'estado_civil' => 'Solteiro(a)',
        'data_nascimento' => $faker->date('Y-m-d'),
        'telefone_trabalho' => $faker->phoneNumber(),
        'telefone_casa' => $faker->phoneNumber(),
        'telefone_celular' => $faker->phoneNumber(),
        'email' => $faker->unique()->safeEmail,
        'observacoes' => $faker->text(),
    ];
});
