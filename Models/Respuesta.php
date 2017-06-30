<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Respuesta extends Model
{
  protected $guarded = array();
  protected $table = 'respuesta';
  public $timestamps = false;

  public function pregunta()
  {
    return $this->belongsTo('Models\Pregunta');
  }
  public function evaluaciones()
  {
    return $this->hasMany('Models\Evaluacion');
  }

}
