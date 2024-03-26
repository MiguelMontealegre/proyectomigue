<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_recetas')->insert([  //El parametro de table debe ser el mismo que el nombre de la tabla en la migracion,despues ponemos un insert para insertar el arreglo. (si el DB sale con error debemos importar la clase)
    
         'nombre' => 'comida Mexicana',
         'created_at' => date('Y-m-d H:i:s'),   //Y como podemos ver tenemos que agregar exactamente los mismos campos que tenemos en la tabla (de la migracion)
         'updated_at' => date('Y-m-d H:i:s')
        ]);


        DB::table('categoria_recetas')->insert([  
            'nombre' => 'comida Italiana',        //Ya aqui a nuestro gusto simplemente agregamos los seeders que creas necesarios y yap.
            'created_at' => date('Y-m-d H:i:s'),   
            'updated_at' => date('Y-m-d H:i:s')
           ]);

           DB::table('categoria_recetas')->insert([  
            'nombre' => 'comida Argentina',
            'created_at' => date('Y-m-d H:i:s'),  
            'updated_at' => date('Y-m-d H:i:s')
           ]);

           DB::table('categoria_recetas')->insert([  
            'nombre' => 'comida Colombiana',
            'created_at' => date('Y-m-d H:i:s'),  
            'updated_at' => date('Y-m-d H:i:s')
           ]);

           DB::table('categoria_recetas')->insert([  
            'nombre' => 'Postres',
            'created_at' => date('Y-m-d H:i:s'),  
            'updated_at' => date('Y-m-d H:i:s')
           ]);

           DB::table('categoria_recetas')->insert([  
            'nombre' => 'cortes de carne',
            'created_at' => date('Y-m-d H:i:s'),  
            'updated_at' => date('Y-m-d H:i:s')
           ]);

           DB::table('categoria_recetas')->insert([  
            'nombre' => 'Ensaladas',
            'created_at' => date('Y-m-d H:i:s'),  
            'updated_at' => date('Y-m-d H:i:s')
           ]);

           DB::table('categoria_recetas')->insert([  
            'nombre' => 'Desayunos',
            'created_at' => date('Y-m-d H:i:s'),  
            'updated_at' => date('Y-m-d H:i:s')
           ]);
    }
}
