<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()     // ESTE SEEDER ES EL PARA LA TABLA EN LA BASE DE DATOS DE : users
    {
        
        $user = User::create([
            'name' => 'juan',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),   //La contraseña siempre debe ir hashteada
            'url' => 'http://codigoconjuancho.com',  
        ]);
        

        
        $user2 = User::create([
            'name' => 'miguel',
            'email' => 'correo@correo22.com',
            'password' => Hash::make('12345678'),   //La contraseña siempre debe ir hashteada
            'url' => 'http://codigoconmigue.com',  
        ]);

    }
}




