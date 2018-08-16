<?php

use Faker\Generator as Faker;

$factory->define(App\Endereco::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));

    return [
        'logradouro' => $faker->streetSuffix() .' '. $faker->streetName(),
        'numero' => $faker->buildingNumber(),
        'complemento' => $faker->secondaryAddress(),
        'bairro' => $faker->streetName(),
        'cep' => $faker->postcode()
    ];
});
