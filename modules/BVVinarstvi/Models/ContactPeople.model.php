<?php

use PromCMS\Core\Database\Model;
use PromCMS\Core\Database\SingletonModel;
use PromCMS\Core\Database\ModelResult;

class ContactPeople extends Model
{
  protected string $tableName = 'contact-people';
  protected bool $softDelete = false;

  protected bool $timestamps = false;
  protected bool $translations = true;

  public static array $casts = [
    'position' => 'array',
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

    'name' => [
      'title' => 'Jméno',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => false,
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
        'editor' => ['placement' => 'main'],
        'fieldType' => 'normal',
      ],
      'type' => 'file',
      'multiple' => false,
      'typeFilter' => 'image',
    ],

    'position' => [
      'title' => 'Pozice',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => true,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'repeater',
        'columns' => [
          'row' => [
            'hide' => false,
            'required' => false,
            'editable' => true,
            'type' => 'string',
            'title' => 'Řádek',
          ],
        ],
      ],
      'type' => 'json',
    ],

    'telephone' => [
      'title' => 'Telefonní číslo',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => false,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'normal',
      ],
      'type' => 'string',
    ],

    'email' => [
      'title' => 'Email',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => false,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'normal',
      ],
      'type' => 'string',
    ],

    'order' => [
      'title' => 'Order',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => false,
      'translations' => false,
      'admin' => ['isHidden' => true, 'editor' => ['placement' => 'main']],
      'type' => 'number',
      'autoIncrement' => true,
    ],
  ];

  static bool $ignoreSeeding = false;

  static string $title = 'Kontaktní osoby';

  static string $modelIcon = 'Users';
  static $adminSettings = [];

  public static function afterCreate(ModelResult $entry): ModelResult
  {
    $entry->update(['order' => $entry->id]);

    return $entry;
  }

  public function getSummary()
  {
    return (object) [
      'isSingleton' => $this instanceof SingletonModel,
      'tableName' => $this->getTableName(),
      'icon' => self::$modelIcon,
      'title' => isset(self::$title) ? self::$title : null,
      'ignoreSeeding' => self::$ignoreSeeding,
      'admin' => self::$adminSettings,
      'columns' => static::$tableColumns,
      'hasTimestamps' => $this->hasTimestamps(),
      'hasSoftDelete' => $this->hasSoftDelete(),
      'ownable' => true,
      'hasOrdering' => true,
      'isDraftable' => false,
      'isSharable' => false,
    ];
  }
}
