<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

// La idea es que las categorias de las recetas van a necesitar tambien su tabla 
        Schema::create('categoria_recetas', function (Blueprint $table){

            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });


//Tabla principal 
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); //Ese "titulo" debe ser el mismo que este definido en los names de los inputs
            $table->text('ingredientes'); //En esta usamos text ya que los ingredientes requiren mucho texto, y con string(max 150 carac) no alcanza.
            $table->text('preparacion');
            $table->string('imagen')->nullable();
            $table->timestamps();       //En "References" ponemos de que campo o que columna de la otra tabla va a tomar los valores, y en el "on" ponemos el nombre de la tabla de la cual vamos a tomar los valores
            $table->foreignId('user_id')->references('id')->on('users')->comment('El usuario que creo la receta');  
                                        // En esta la idea es referenciar el id del usuario que creo la receta entonces tenemos que poner ese foreignId por que eso que estamos agregando viene siendo es el id de otra tabla (lo que se conoce cono llave foranea)  
                                     //Y aqui estamos haciendo referencia a el id de la tabla de migracion 'users'... el "comment" sirve para documentar un poco la base de datos se utiliza mucho para anotar por ejem que hace ese campo etc.
            
            $table->foreignId('categoria_id')->references('id')->on('categoria_recetas')->comment('Categoria de la receta');  
      });
        

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recetas');
        Schema::dropIfExists('categoria_recetas'); //Tabla que agreguemos, tabla a la que le tenemos que agregar esto
    }                                              //ya que representa el comportamiento que tendra el 'rollback' en la migracion
}
