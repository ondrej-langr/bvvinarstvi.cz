<?php
// In this file you can tell what this module contains or have here something that should be loaded before your models, routes, ..etc

use Twig\Extra\Intl\IntlExtension;
use PromCMS\Core\Utils;
use Slim\App;
use Slim\Views\Twig;

function getDefaultLayoutData($language)
{
  $result = [];

  $posts = new Posts;
  $postsQuery = $posts->query();

  if ($language) {
    $postsQuery->setLanguage($language);
  }

  $result["__layout"] = [
    "latestPosts" => $postsQuery->orderBy(["created_at" => "desc"])->limit(3)->getMany(["is_published" => true])
  ];

  return $result;
}

return function (App $app) {
  // You can access container and other stuff like this
  $container = $app->getContainer();
  $utils = $container->get(Utils::class);
  $twig = $container->get(Twig::class);

  $twig->addExtension(new IntlExtension());

  $utils->autoloadControllers(__DIR__);
};
