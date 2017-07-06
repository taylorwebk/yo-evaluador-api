<?php
namespace Controllers;
use \Models\Pregunta as Pregunta;
use \Models\Respuesta as Respuesta;
use \Models\Materia as Materia;
use \Models\Docente as Docente;
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
  public static function addMatter($data)
  {
    $fields = ['materias'];
    if (self::validateData($data, $fields)) {
      if (is_array($data['materias'])) {
        foreach ($data['materias'] as $mat) {
          $m = Materia::create([
            'id' => null,
            'sigla' => strtoupper($mat['sigla']),
            'des' => $mat['descripcion']
          ]);
        }
        return R::success('Se registraron las materias');
      } else {
        return R::error('El campo materias debe ser un array');
      }
    } else {
      return R::error('No se reconocen los campos: '.implode(', ', $fields));
    }
  }
  public static function addTeacher($data)
  {
    $fields = ['docentes'];
    if (self::validateData($data, $fields)) {
      if (is_array($data['docentes'])) {
        foreach ($data['docentes'] as $doc) {
          $d = Docente::create([
            'id' => null,
            'nombre' => $doc['nombre']
          ]);
        }
        return R::success('Se registraron los docentes');
      } else {
        return R::error('El campo docentes debe ser un array');
      }
    } else {
      return R::error('No se reconocen los campos: '.implode(', ', $fields));
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
