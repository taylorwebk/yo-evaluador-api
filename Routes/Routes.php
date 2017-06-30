<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Controllers\AdminController as AC;
$app->get('/', function (Request $req, Response $res)
{
  return $res->withJson('Hello World');
});
$app->post('/pregunta', function (Request $req, Response $res)
{
  $f = AC::addQuestion($req->getParsedBody());
  return $res->withJson($f);
});
