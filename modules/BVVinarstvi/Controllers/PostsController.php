<?php

use DI\Container;
use PromCMS\Core\Config;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig as TwigViews;

class PostsController
{
  use \PromCMS\Core\Controllers\Traits\Model\I18n;

  private \DI\Container $container;

  public function __construct(Container $container)
  {
    $this->container = $container;
    $this->languageConfig = $container->get(Config::class)->i18n;
  }

  function overview(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language);

    $posts = new Posts;
    $postsQuery = $posts->query();

    if ($language) {
      $postsQuery->setLanguage($language);
    }

    $allPosts = $postsQuery->orderBy(["created_at" => "desc"])->getMany(["is_published" => true]);

    return $twig->render($response, '@modules:bVVinarstvi/pages/clanky/page.twig', array_merge($defaultLayoutData, [
      "posts" => $allPosts
    ]));
  }

  function entry(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language);

    return $twig->render($response, '@modules:bVVinarstvi/pages/clanky/[postSlug]/page.twig', array_merge($defaultLayoutData, []));
  }
}
