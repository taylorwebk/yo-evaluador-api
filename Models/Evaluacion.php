<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Evaluacion extends Model
{
  protected $guarded = array();
  protected $table = 'evaluacion';
  public $timestamps = false;

  public function respuesta()
  {
    return $this->belongsTo('Models\Respuesta');
  }
  public function lista()
  {
    return $this->belongsTo('Models\Lista');
  }
  public function estudiante()
  {
    return $this->belongsTo('Models\Estudiante');
  }

}
