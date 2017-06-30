<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Pregunta extends Model
{
  protected $guarded = array();
  protected $table = 'pregunta';
  public $timestamps = false;

  public function respuestas()
  {
    return $this->hasMany('Models\Respuesta');
  }

}
