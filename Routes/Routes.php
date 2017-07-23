<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Controllers\AdminController as AC;
use Controllers\DocenteController as DC;
use Controllers\EstudianteController as EC;
$app->get('/', function (Request $req, Response $res)
{
  return $res->withJson('Hello World');
});
$app->post('/pregunta', function (Request $req, Response $res)
{
  $f = AC::addQuestion($req->getParsedBody());
  return $res->withJson($f);
});
$app->post('/materia', function (Request $req, Response $res)
{
  $f = AC::addMatter($req->getParsedBody());
  return $res->withJson($f);
});
$app->post('/docente', function (Request $req, Response $res)
{
  $f = AC::addTeacher($req->getParsedBody());
  return $res->withJson($f);
});
$app->post('/estudiante', function (Request $req, Response $res)
{
  $f = AC::addStudent($req->getParsedBody());
  return $res->withJson($f);
});
$app->get('/datos', function (Request $req, Response $res)
{
  $f = AC::getData();
  return $res->withJson($f);
});
$app->post('/clase', function (Request $req, Response $res)
{
  $f = AC::addClass($req->getParsedBody());
  return $res->withJson($f);
});
$app->post('/inscribir', function (Request $req, Response $res)
{
  $f = AC::addStudentToClass($req->getParsedBody());
  return $res->withJson($f);
});
$app->get('/materias', function (Request $req, Response $res)
{
  $f = AC::getSubjects();
  return $res->withJson($f);
});
$app->get('/clase/{id:[0-9]+}', function (Request $req, Response $res, $args)
{
  $f = AC::getClassDetail($args['id']);
  return $res->withJson($f);
});
// DOCENTE

// ESTUDIANTE

// PREGUNTA
// {
// 	"pregunta": "usted quiere continuar?",
// 	"respuestas": [
// 		"respuesta 1",
// 		"respuesta 2",
// 		"respuesta 3"
// 	]
// }
// MATERIAS
// {
// 	"materias": [
// 		{
// 			"sigla": "inf-111",
// 			"descripcion": "Introducción a la programación."
// 		},
// 		{
// 			"sigla": "inf-111",
// 			"descripcion": "Introducción a la programación."
// 		}
// 	]
// }
// DOCENTES
// {
// 	"docentes": [
// 		{
// 			"nombre": "Lic. Montano",
//      "codigo": "asdf"
// 		},
// 		{
// 			"nombre": "Lic. Sandris",
//      "codigo": "asdfg"
// 		}
// 	]
// }
// ESTUDIANTES
// {
// 	"estudiantes": [
// 		{
// 			"nombre": "pepe Montano",
//      "ci": "456789",
//      "ru": "123456"
// 		},
// 		{
// 			"nombre": "pepse Montano",
//      "ci": "456789",
//      "ru": "123456"
// 		}
// 	]
// }
// CLASE
// {
// 	"docenteid": "1",
// 	"materiaid": "1",
// 	"paralelo": "A",
// 	"aula": "laboratorio basico"
// }
// INSCRIBIR
// {
// 	"claseid": "1",
// 	"estudiantes": [3]
// }
