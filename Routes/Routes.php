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
// DOCENTE
$app->post('/reqeval', function (Request $req, Response $res)
{
  $f = DC::requestEval($req->getParsedBody());
  return $res->withJson($f);
});
// ESTUDIANTE
$app->get('/datos', function (Request $req, Response $res)
{
  $f = EC::getData();
  return $res->withJson($f);
});
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
// 			"nombre": "Lic. Montano"
// 		},
// 		{
// 			"nombre": "Lic. Sandris"
// 		}
// 	]
// }
