<?php
namespace Models;
use Illuminate\Database\Eloquent\Model as Model;
/**
 *
 */
class Lista extends Model
{
  protected $guarded = array();
  protected $table = 'lista';
  public $timestamps = false;

  public function evaluaciones()
  {
    return $this->hasMany('Models\Evaluacion');
  }
  public function clase()
  {
    return $this->belongsTo('Models\Clase');
  }

}
