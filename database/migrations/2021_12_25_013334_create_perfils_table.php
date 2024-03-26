<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');  //El perfil va a estar asociado obviamente con el id del usuario , por lo tanto usamos un 'foreign id' para extraer el id de usuario de la otra tabla
            $table->text('biografia')->nullable(); //nullable:  el usuario puede llenarlo o no 
            $table->string('emailp')->nullable();
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }
     
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfils');
    }
}
