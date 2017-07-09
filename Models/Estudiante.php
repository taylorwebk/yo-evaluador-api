<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Estudiante extends Model
{
  protected $guarded = array();
  protected $table = 'estudiante';
  public $timestamps = false;

  public function evaluaciones()
  {
    return $this->hasMany('Models\Evaluacion');
  }
  public function clases()
  {
    return $this->belongsToMany('Models\Clase');
  }

}
