<?php
namespace Controllers;
use \Models\R as R;
use \Models\Lista as Lista;
class DocenteController
{
  public static function requestEval($data)
  {
    $fields = ['mid', 'did', 'cod', 'par'];
    if (self::validateData($data, $fields)) {
      $ini = date('Y-m-d H:i:s');
      $l = Lista::create([
        'id' => null,
        'materia_id' => $data['mid'],
        'docente_id' => $data['did'],
        'fini' => $ini,
        'cod' => $data['cod'],
        'paralelo' => $data['par']
      ]);
      return R::success($l);
    } else {
      return R::error('No se reconoce los campos: '.implode(', ', $fields));
    }
  }
  private static function validateData($data, $fields)
  {
    foreach ($fields as $value) {
      if (! isset($data[$value])) {
        return false;
      }
    }
    return true;
  }
}
