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

      if ($language) {
        $postQuery->setLanguage($language);
      }

      $post = $postQuery->where($this->getMultilangField('slug', $postSlug))->getOne();
      $nextPost = null;
      $prevPost = null;

      try {
        $postQuery = (new Posts())->query();

        if ($language) {
          $postQuery->setLanguage($language);
        }

        $nextPost = $postQuery->where(["id", "=", $post->id - 1])->getOne()->getData();
      } catch (\Exception $e) {
      }

      try {
        $postQuery = (new Posts())->query();

        if ($language) {
          $postQuery->setLanguage($language);
        }

        $prevPost = $postQuery->where(["id", "=", $post->id + 1])->getOne()->getData();
      } catch (\Exception $e) {
      }


      return $twig->render($response, '@modules:bVVinarstvi/pages/clanky/[postSlug]/page.twig', array_merge($defaultLayoutData, [
        "data" => $post->getData(),
        "nextPost" => $nextPost,
        "prevPost" => $prevPost
      ]));
    } catch (\Exception $e) {
      echo json_encode($e->__toString());
      return $response->withStatus(200);
    }
  }
}
