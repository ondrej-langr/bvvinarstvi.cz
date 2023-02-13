<?php

use DI\Container;
use PromCMS\Core\Config;
use PromCMS\Core\Services\SingletonService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig as TwigViews;

class MainController
{
  use \PromCMS\Core\Controllers\Traits\Model\I18n;


  private \DI\Container $container;

  public function __construct(Container $container)
  {
    $this->container = $container;
    $this->languageConfig = $container->get(Config::class)->i18n;
  }

  function mainPage(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $popupModel = new Popup();
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language, $this->container);

    $service = new SingletonService(
      $popupModel,
      $language
    );

    $frontPageBanner = new SingletonService(
      new FrontPageBanner,
      $language
    );

    $itemsAboutQuery = (new ItemsAbout())->query();

    if ($language) {
      $itemsAboutQuery->setLanguage($language);
    }

    return $twig->render($response, '@modules:bVVinarstvi/pages/page.twig', array_merge($defaultLayoutData, [
      "popup" =>  $service
        ->getOne([])
        ->getData(),
      "sliderItems" => $itemsAboutQuery->getMany(),
      "banner" => $frontPageBanner->getOne([])
        ->getData(),
    ]));
  }

  function contact(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language, $this->container);

    $contactPeopleQuery = (new ContactPeople())->query();

    if ($language) {
      $contactPeopleQuery->setLanguage($language);
    }

    return $twig->render($response, '@modules:bVVinarstvi/pages/kontakt/page.twig', array_merge($defaultLayoutData, [
      "people" => $contactPeopleQuery->orderBy(['order' => 'asc', 'id' => 'asc'])->getMany()
    ]));
  }

  function vinoteka(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language, $this->container);

    $service = new SingletonService(
      new PageShopAndWineShop(),
      $language
    );

    return $twig->render($response, '@modules:bVVinarstvi/pages/vinoteka/page.twig', array_merge($defaultLayoutData, [
      "data" => $service
        ->getOne([])
        ->getData()
    ]));
  }

  function szif(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language, $this->container);

    return $twig->render($response, '@modules:bVVinarstvi/pages/szif/page.twig', array_merge($defaultLayoutData, []));
  }

  function prodejniMista(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ) {
    $twig = $this->container->get(TwigViews::class);
    $language = $this->getCurrentLanguage($request, $args);
    $defaultLayoutData = getDefaultLayoutData($language, $this->container);

    return $twig->render($response, '@modules:bVVinarstvi/pages/prodejni-mista/page.twig', array_merge($defaultLayoutData, []));
  }
}
