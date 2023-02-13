<?php

use PromCMS\Core\Database\Model;
use PromCMS\Core\Database\SingletonModel;
use PromCMS\Core\Database\ModelResult;

class FrontPageBanner extends SingletonModel
{
  protected string $name = 'front-page-banner';

  protected bool $timestamps = false;
  protected bool $translations = true;

  public static array $casts = [
    'content' => 'array',
  ];

  public static array $tableColumns = [
    'id' => [
      'title' => 'ID',
      'hide' => false,
      'required' => false,
      'unique' => true,
      'editable' => false,
      'translations' => false,
      'admin' => ['isHidden' => false, 'editor' => ['placement' => 'main']],
      'type' => 'number',
      'autoIncrement' => true,
    ],

    'content' => [
      'title' => 'Obsah',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => true,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'blockEditor',
      ],
      'type' => 'json',
    ],

    'enabled' => [
      'title' => 'Zobrazit na stránce?',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => true,
      'admin' => ['isHidden' => false, 'editor' => ['placement' => 'aside']],
      'type' => 'boolean',
      'default' => false,
    ],

    'image' => [
      'title' => 'Pozadí',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => false,
      'admin' => [
        'isHidden' => true,
        'editor' => ['placement' => 'aside'],
        'fieldType' => 'big-image',
      ],
      'type' => 'file',
      'multiple' => false,
      'typeFilter' => 'image',
    ],
  ];

  static bool $ignoreSeeding = false;

  static string $title = 'Banner na hlavní stránce';

  static string $modelIcon = 'Award';
  static $adminSettings = [];

  public function getSummary()
  {
    return (object) [
      'isSingleton' => $this instanceof SingletonModel,
      'name' => $this->getName(),
      'icon' => self::$modelIcon,
      'title' => isset(self::$title) ? self::$title : null,
      'ignoreSeeding' => self::$ignoreSeeding,
      'admin' => self::$adminSettings,
      'columns' => static::$tableColumns,
      'hasTimestamps' => $this->hasTimestamps(),
      'hasSoftDelete' => $this->hasSoftDelete(),
      'ownable' => false,
      'hasOrdering' => false,
      'isDraftable' => false,
      'isSharable' => false,
    ];
  }
}
