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

        DB::table('users')->insert([
            'name' => 'Victor',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);


        //factory(App\Associado::class, 50)->create();

        factory(App\Associado::class, 10)->create()->each(function ($u) {
            $u->endereco()->save(factory(App\Endereco::class)->make());
        });
    }
}
