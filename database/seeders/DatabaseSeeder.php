<?php

namespace Database\Seeders;

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
        $this->call(class: CategoriasSeeder ::class);       //Llamamos a los seeder que hemos creado de esta forma (metodo de forma individual)

        $this->call(class: UsuarioSeeder ::class);

        // \App\Models\User::factory(10)->create();          //Para llamar varios seeders a la vez se usan las factories
    }
}


 
