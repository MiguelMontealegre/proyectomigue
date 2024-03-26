<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class querybuilderController extends Controller
{
    public function test(){

        //Metodo table , proveniente de el Facade 'DB'
        //SELECT * FROM users where id = 1
        $table = DB::table('users')
            ->where('id',1)
            ->get();        //get() ejucuta la consulta y obtenemos un coleccion apartir de todos los constraints o restricciones en el query builder


        //El metodo first Obtiene un solo registro (el primero que encuentre) de la DB en funcion de una restriccion en el query builder
        //Ideal cuando ya estamos seguros de que la consulta solo va a traernos un solo registro, de tipo objeto (std class en php)
        // SELECT * FROM users where id = 3 limit 1
        $first = DB::table('users')
            ->where('id', 1)
            ->first();


        //El metodo value nos retorna solo el campo especificado del registro obtenido apartir del query , ya que tambien retorna uno SOLO! , el primero que encuentre
        //Se usa cuando sabemos que el query devuelve 1 solo
        $value = DB::table('users')
            ->where('id', '>', 1)
            ->value('name');


        return view('cursoQueryBuilder', compact('table', 'value'));
    }
}
