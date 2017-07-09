<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Clase extends Model
{
  protected $guarded = array();
  protected $table = 'clase';
  public $timestamps = false;

  public function estudiantes()
  {
    return $this->belongsToMany('Models\Estudiante');
  }
  public function materia()
  {
    return $this->belongsTo('Models\Materia');
  }
  public function docente()
  {
    return $this->belongsTo('Models\Docente');
  }
  public function listas()
  {
    return $this->hasMany('Models\Lista');
  }

}
