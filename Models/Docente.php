<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Docente extends Model
{
  protected $guarded = array();
  protected $table = 'docente';
  public $timestamps = false;

  public function clases()
  {
    return $this->hasMany('Models\Clase');
  }

}
