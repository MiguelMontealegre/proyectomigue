<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
  use HasFactory;


  protected $fillable = [
    'titulo',
    'preparacion',             // Estos son valores necesarios que se le pasan al modelo cuando se crean nuevos registros  
    'ingredientes',          //por lo tanto tenemos que poner el nuevo campo que se quiera
    'categoria_id',
    'imagen',
  ];


  //Obtiene la categoria de la receta... via llave foranea
  public function categoria()
  {
    return $this->belongsTo(CategoriaReceta::class);  //Relacion 1:1
  }


// Obtiene la info del usuario via foreign key (Para la parte de obtener el nombre del autor especificamente)
public function autor()
{
   return $this->belongsto(User::class , 'user_id');  //ese user_id es el FK de esta tabla
}



//Likes que ha recibido una receta
// Relacion de muchos a muchos ... Ya que la receta va a almacenar muchos likes
public function likes(){
  return $this->belongsToMany(User::class ,'likes_receta');  //Le decimos que nuestra tabla pivot es 'likes_receta';
}
 
}
