<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Materia extends Model
{
  protected $guarded = array();
  protected $table = 'materia';
  public $timestamps = false;

  public function clases()
  {
    return $this->hasMany('Models\Clase');
  }

}
