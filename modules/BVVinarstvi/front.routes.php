<?php

use PromCMS\Core\Services\SingletonService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Views\Twig as TwigViews;
use Slim\Routing\RouteCollectorProxy;

return function (App $app, RouteCollectorProxy $router) {
  $controllerName = "MainController";

  $router->get('/', "$controllerName:mainPage");
  $router->get('/historie', "$controllerName:mainPage");
  $router->get('/kontakt', "$controllerName:contact");
  $router->get('/vinoteka', "$controllerName:vinoteka");
  $router->get('/szif', "$controllerName:szif");
  $router->get('/prodejni-mista', "$controllerName:prodejniMista");

  $router->group("/clanky", function ($subRouter) use ($app) {
    $controllerName = "PostsController";
    $subRouter->get('', "$controllerName:overview");

    $subRouter->get('/{postSlug}', "$controllerName:entry");
  });
};
