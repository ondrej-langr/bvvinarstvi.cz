<?php

use PromCMS\Core\Database\Model;
use PromCMS\Core\Database\SingletonModel;
use PromCMS\Core\Database\ModelResult;

class ContactInformations extends Model
{
  protected string $tableName = 'contact-informations';
  protected bool $softDelete = false;

  protected bool $timestamps = false;
  protected bool $translations = true;

  public static array $casts = [
    'openingHours' => 'array',

    'addresses' => 'array',

    'billingInformation' => 'array',
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
      'translations' => true,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'normal',
      ],
      'type' => 'string',
    ],

    'openingHours' => [
      'title' => 'Otevírací doba',
      'hide' => false,
      'required' => false,
      'unique' => false,
      'editable' => true,
      'translations' => false,
      'admin' => [
        'isHidden' => false,
        'editor' => ['placement' => 'main'],
        'fieldType' => 'openingHours',
      ],
      'type' => 'json',
    ],

    'addresses' => [
      'title' => 'Adresy',
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

    'billingInformation' => [
      'title' => 'Fakturační údaje',
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
  ];

  static bool $ignoreSeeding = false;

  static string $title = 'Kontaktní informace';

  static string $modelIcon = 'PhoneIncoming';
  static $adminSettings = [];

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
      'hasOrdering' => false,
      'isDraftable' => false,
      'isSharable' => true,
    ];
  }
}
