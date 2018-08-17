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

        DB::table('users')->insert([
            'name' => 'Consultorio',
            'username' => 'consultorio',
            'password' => bcrypt('123456'),
            'role' => 'guest'
        ]);

        factory(App\Associado::class, 20)->create()->each(function ($u) {
            $u->endereco()->save(factory(App\Endereco::class)->make());
        });
    }
}
