<?php

use PromCMS\Core\Database\Model;
use PromCMS\Core\Database\SingletonModel;
use PromCMS\Core\Database\ModelResult;

class ItemsAbout extends Model
{
  protected string $tableName = 'items-about';
  protected bool $softDelete = false;

  protected bool $timestamps = false;
  protected bool $translations = true;

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

    'title' => [
      'title' => 'Titulek',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => true,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'normal',
      ],
      'type' => 'string',
    ],

    'menu-title' => [
      'title' => 'Titulek v navigaci',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => true,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'normal',
      ],
      'type' => 'string',
    ],

    'photo' => [
      'title' => 'Fotografie',
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

    'text' => [
      'title' => 'Text',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => true,
      'admin' => ['isHidden' => false, 'editor' => ['placement' => 'main']],
      'type' => 'longText',
    ],
  ];

  static bool $ignoreSeeding = false;
  static string $modelIcon = 'Slideshow';
  static $adminSettings = [];

  public function getSummary()
  {
    return (object) [
      'isSingleton' => $this instanceof SingletonModel,
      'tableName' => $this->getTableName(),
      'icon' => self::$modelIcon,
      'ignoreSeeding' => self::$ignoreSeeding,
      'admin' => self::$adminSettings,
      'columns' => static::$tableColumns,
      'hasTimestamps' => $this->hasTimestamps(),
      'hasSoftDelete' => $this->hasSoftDelete(),
      'ownable' => true,
      'hasOrdering' => false,
      'isDraftable' => false,
      'isSharable' => true,
    ];
  }
}
