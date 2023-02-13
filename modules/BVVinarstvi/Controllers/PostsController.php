<?php

use DI\Container;
use PromCMS\Core\Config;
use PromCMS\Core\Database\Query;
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

  private function  getMultilangField($fieldName, $value)
  {
    $final = [];
    foreach ($this->container->get(Config::class)->i18n->languages as $language) {
      $final[] = [
        Query::$TRANSLATIONS_FIELD_NAME . ".$language.$fieldName",
        '=',
        $value,
      ];
      $final[] = 'OR';
    }

    array_pop($final);

    return $final;
  }

  function overview(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language, $this->container);

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
    $defaultLayoutData = getDefaultLayoutData($language, $this->container);

    try {
      $postSlug = $args["postSlug"];
      $postQuery = (new Posts())->query();
      $postsQuery = (new Posts())->query();

      if ($language) {
        $postQuery->setLanguage($language);
        $postsQuery->setLanguage($language);
      }

      // We now get all posts and find index of current post within it and we can determine next and prev post
      $post = $postQuery->where($this->getMultilangField('slug', $postSlug))->getOne();
      $posts = $postsQuery->orderBy(["created_at" => "desc"])->getMany(["is_published" => true]);
      $currentPostIndex = array_search($post->id, array_column($posts, 'id'));
      $nextPost = null;
      $prevPost = null;

      if ($currentPostIndex > 0) {
        $prevPost = $posts[$currentPostIndex - 1];
      }

      if ($currentPostIndex < (count($posts) - 1)) {
        $nextPost = $posts[$currentPostIndex + 1];
      }

      return $twig->render($response, '@modules:bVVinarstvi/pages/clanky/[postSlug]/page.twig', array_merge($defaultLayoutData, [
        "data" => $post->getData(),
        "nextPost" => $nextPost,
        "prevPost" => $prevPost
      ]));
    } catch (\Exception $e) {
      echo json_encode($e->__toString());
      return $response->withStatus(404);
    }
  }
}
