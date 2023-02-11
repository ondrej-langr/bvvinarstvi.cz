<?php
// In this file you can tell what this module contains or have here something that should be loaded before your models, routes, ..etc

use DI\Container;
use PromCMS\Core\Config;
use PromCMS\Core\Services\EntryTypeService;
use PromCMS\Core\Services\LocalizationService;
use Twig\Extra\Intl\IntlExtension;
use PromCMS\Core\Utils;
use Slim\App;
use Slim\Views\Twig;

function formatTime($hourInfo)
{
  return $hourInfo === false ? $hourInfo : implode(",", array_map(function ($items) {
    return $items["from"] . " - " . $items["to"];
  }, $hourInfo));
}

function formatOpeningHours(array $openingHours)
{
  $sorted = [
    "monday" => $openingHours["monday"],
    "tuesday" => $openingHours["tuesday"],
    "wednesday" => $openingHours["wednesday"],
    "thursday" => $openingHours["thursday"],
    "friday" => $openingHours["friday"],
    "saturday" => $openingHours["saturday"],
    "sunday" => $openingHours["sunday"],
  ];
  $result = [];

  $index = 0;
  foreach ($sorted as $key => $hour) {
    $formattedTime = formatTime($hour);

    if ($index === 0) {
      $result[] = [
        "from" => $key,
        "to" => $key,
        "time" => $formattedTime
      ];
    } else {
      // Select previous
      $prev = $result[count($result) - 1];
      $formattedPrevTime = $prev["time"];

      if ($formattedPrevTime == $formattedTime) {
        $result[count($result) - 1]["to"] = $key;
      } else {
        $result[] = [
          "from" => $key,
          "to" => $key,
          "time" => $formattedTime
        ];
      }
    }


    $index++;
  }

  return $result;
}

function getDefaultLayoutData($language, Container $container)
{
  $result = [];

  $posts = new Posts;
  $postsQuery = $posts->query();

  if ($language) {
    $postsQuery->setLanguage($language);
  }

  $contactPlaceService = new EntryTypeService(
    new ContactInformations(),
    $language
  );
  $shop = $contactPlaceService->getOne(["id", "=", 1])->getData();
  $center = $contactPlaceService->getOne(["id", "=", 2])->getData();

  $result["__layout"] = [
    "latestPosts" => $postsQuery->orderBy(["created_at" => "desc"])->limit(3)->getMany(["is_published" => true]),
    'baseUrl' => $container->get(Config::class)->app->url,
    "lang" => $language ? $language : $container->get(Config::class)->i18n->default,
    'contacts' => [
      "shop" => array_merge($shop, [
        "openingHours" => formatOpeningHours($shop["openingHours"]["data"])
      ]),
      "center" => array_merge($center, [
        "openingHours" => formatOpeningHours($center["openingHours"]["data"])
      ]),
    ]
  ];

  return $result;
}

return function (App $app) {
  // You can access container and other stuff like this
  $container = $app->getContainer();
  $utils = $container->get(Utils::class);
  $twig = $container->get(Twig::class);

  $twig->addExtension(new IntlExtension());

  $cachedTranslations = [];

  $filter = new \Twig\TwigFilter('t', function ($context, $value) use ($container, $cachedTranslations) {
    $currentLang = $context["__layout"]["lang"];

    if (!isset($cachedTranslations[$currentLang])) {
      $cachedTranslations[$currentLang] = $container
        ->get(LocalizationService::class)
        ->getTranslations($currentLang, false);
    }

    return isset($cachedTranslations[$currentLang][$value]) ? $cachedTranslations[$currentLang][$value] : $value;
  }, ['needs_context' => true]);

  $twig->getEnvironment()->addFilter($filter);

  $utils->autoloadControllers(__DIR__);
};
