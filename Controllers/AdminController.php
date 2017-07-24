<?php
namespace Controllers;
use \Models\Pregunta as Pregunta;
use \Models\Respuesta as Respuesta;
use \Models\Materia as Materia;
use \Models\Docente as Docente;
use \Models\Estudiante as Estudiante;
use \Models\Clase as Clase;
use \Models\R as R;
class AdminController
{
  public static function addQuestion($data)
  {
    $fields = ['pregunta', 'respuestas'];
    if (R::validateData($data, $fields)) {
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
      return R::errorData($fields);
    }
  }
  public static function addMatter($data)
  {
    $fields = ['sigla', 'des'];
    if (R::validateData($data, $fields)) {
      $mat = Materia::where('sigla', '=', $data['sigla'])->first();
      if (!$mat) {
        $m = Materia::create([
          'id' => null,
          'sigla' => strtoupper($data['sigla']),
          'des' => $data['des']
          ]);
          return R::success('Se registro las materia');
      } else {
        return R::error('La materia '.$data['sigla'].' ya fue registrada');
      }
    } else {
      return R::errorData($fields);
    }
  }
  public static function addTeacher($data)
  {
    $fields = ['docentes'];
    if (R::validateData($data, $fields)) {
      if (is_array($data['docentes'])) {
        foreach ($data['docentes'] as $doc) {
          $d = Docente::create([
            'id' => null,
            'nombre' => $doc['nombre'],
            'cod' => $doc['codigo']
          ]);
        }
        return R::success('Se registraron los docentes');
      } else {
        return R::error('El campo docentes debe ser un array');
      }
    } else {
      return R::errorData($fields);
    }
  }
  public static function addStudent($data)
  {
    $fields = ['estudiantes'];
    if (R::validateData($data, $fields)) {
      if (is_array($data['estudiantes'])) {
        $repe = [];
        foreach ($data['estudiantes'] as $est) {
          $e = Estudiante::where('ci', '=', $est['ci'])->first();
          if (!$e) {
            Estudiante::create([
              'id' => null,
              'nombre' => $est['nombre'],
              'ci' => $est['ci'],
              'ru' => $est['ru']
              ]);
          } else {
            array_push($repe, $e->ci);
          }
        }
        if (count($repe)) {
          return R::success('Se adicionaron estudiantes, pero se omitieron '.count($repe).', por que ya estaban registrados: '.implode(',', $repe));
        } else {
          return R::success('Se adicionaron correctamente los estudiantes');
        }
      } else {
        return R::error('El campo estudiantes debe ser un array');
      }
    } else {
      return R::errorData($fields);
    }
  }
  public static function getData()
  {
    $resp = [];
    $resp['students'] = Estudiante::all();
    $resp['teachers'] = Docente::all();
    $resp['matters'] = Materia::all();
    return R::success($resp);
  }
  public static function addClass($data)
  {
    $fields = ['docenteid', 'materiaid', 'paralelo', 'aula'];
    if (R::validateData($data, $fields)) {
      $d = Docente::find($data['docenteid']);
      $m = Materia::find($data['materiaid']);
      if ($d && $m) {
        $a = Clase::where('docente_id', '=', $data['docenteid'])->where('materia_id', '=', $data['materiaid'])->where('par', '=', $data['paralelo'])->first();
        if (!$a) {
          Clase::create([
            'id' => null,
            'docente_id' => $data['docenteid'],
            'materia_id' => $data['materiaid'],
            'par' => $data['paralelo'],
            'aula' => $data['aula']
            ]);
          return R::success('Se creo la clase... ahora puede agregar estudiantes');
        } else {
          return R::error('La materia '.$m->sigla.' con el paralelo '.$data['paralelo'].' ya fue registrado');
        }
      } else {
        return R::error('No existe el docente con id:'.$data['docenteid'].' o materia con id:'.$data['materiaid']);
      }
    } else {
      return R::errorData($fields);
    }
  }
  public static function addStudentToClass($data)
  {
    $fields = ['claseid', 'estudiantes'];
    if (R::validateData($data, $fields)) {
      $c = Clase::find($data['claseid']);
      if ($c) {
        $c->estudiantes()->attach($data['estudiantes']);
        return R::success('Usted registró '.count($data['estudiantes']).' estudiante(s) en la materia '.$c->materia->sigla);
      } else {
        return R::error('No se encontro la clase con id:'.$data['claseid']);
      }
    } else {
      return R::errorData($fields);
    }
  }
  public static function getSubjects()
  {
    $resp = Materia::with(['clases'])->get();
    foreach ($resp as $mat) {
      foreach ($mat->clases as &$clase) {
        $clase->nroEstudiantes = $clase->estudiantes()->count();
      }
    }
    return R::success($resp);
  }
  public static function getClassDetail($id)
  {
    $c = Clase::find($id);
    if ($c) {
      $c->docente = ($c->docente()->select('nombre')->first())['nombre'];
      $c->materia = ($c->materia()->select(['des', 'sigla'])->first());
      $c->estudiantes;
      return R::success($c);
    } else {
      return R::error('no existe la clase con id:'.$id);
    }
  }
}
