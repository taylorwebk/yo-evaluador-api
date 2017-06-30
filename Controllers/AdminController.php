<?php
namespace Controllers;
use \Models\Pregunta as Pregunta;
use \Models\Respuesta as Respuesta;
use \Models\R as R;
class AdminController
{
  public static function addQuestion($data)
  {
    $fields = ['pregunta', 'respuestas'];
    if (self::validateData($data, $fields)) {
      if (is_array($data['respuestas'])) {
        $p = Pregunta::create([
          'id' => null,
          'des' => $data['pregunta']
        ]);
        foreach ($data['respuestas'] as $respuesta) {
          $r = Respuesta::create([
            'id' => null,
            'pregunta_id' => $p->id,
            'des' => $respuesta
            ]);
        }
        return R::success($p);
      } else {
        return R::error('el campo respuestas debe ser un array');
      }
    } else {
      return R::error('no se reconocen el campo pregunta y respuestas');
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
