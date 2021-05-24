<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

            factory(App\Associado::class, 20)->create()->each(function ($u) {
            $u->endereco()->save(factory(App\Endereco::class)->make());
        });

        $this->call(LaratrustSeeder::class);
    }
}
