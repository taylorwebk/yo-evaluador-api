<?php
namespace Controllers;
use \Models\R as R;
use \Models\Docente as Docente;
use \Models\Materia as Materia;
use \Models\Pregunta as Pregunta;
class EstudianteController
{
  public static function getData()
  {
    $data = [
      "docentes" => Docente::all(),
      "materias" => Materia::all(),
      "preguntas" => Pregunta::with('respuestas')->get()
    ];
    return R::success($data);
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
