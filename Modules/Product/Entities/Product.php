<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use SoftDeletes;

  use RelationTrait;
  use TableColumnsTrait;

  protected $dates = ['deleted_at'];

  public $form = [
    'id' => [
      'enabled' => true
    ],
    'title' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ]
    ],
    'vendor' => [
      'enabled' => true,
      'validations' => [
        'max' => 255
      ]
    ],
    'IEC' => [
      'enabled' => true,
      'validations' => [
        'max' => 15
      ]
    ],
    'price' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'regex' => '\d+.$',
        'max' => 12
      ]
    ],
    'price_amount' => [
      'enabled' => true,
      'validations' => [
        'max' => 25
      ]
    ],
    'qty' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'regex' => '^[0-9].*$',
      ]
    ],
    'sort' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'regex' => '^[0-9].*$',
      ]
    ],
    'description' => [
      'enabled' => true
    ],
    'onsale' => [
      'enabled' => true
    ],
    'special' => [
      'enabled' => true
    ],
    'need_order' => [
      'enabled' => true
    ],
    'active' => [
      'enabled' => true
    ],
    'type_product' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
      ]
    ],
    'line_product' => [
      'enabled' => true
    ]
  ];

  protected $guarded = [];

  public function type_product() {
    return $this->belongsTo(TypeProduct::class);
  }

  public function line_product() {
    return $this->belongsTo(LineProduct::class);
  }

  public function attribute_boolean() {
    return $this->belongsToMany(Attribute::class, 'attribute_boolean_values')->withPivot('value');
  }

  public function attribute_date() {
    return $this->belongsToMany(Attribute::class, 'attribute_date_values')->withPivot('value');
  }

  public function attribute_double() {
    return $this->belongsToMany(Attribute::class, 'attribute_double_values')->withPivot('value');
  }

  public function attribute_integer() {
    return $this->belongsToMany(Attribute::class, 'attribute_integer_values')->withPivot('value');
  }

  public function attribute_list() {
    return $this->belongsToMany(Attribute::class, 'attribute_list_values')->withPivot('value');
  }

  public function attribute_varchar() {
    return $this->belongsToMany(Attribute::class, 'attribute_varchar_values')->withPivot('value');
  }

  public function attribute_text() {
    return $this->belongsToMany(Attribute::class, 'attribute_text_values')->withPivot('value');
  }
}
