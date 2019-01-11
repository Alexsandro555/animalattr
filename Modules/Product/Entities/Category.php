<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Baum\Node;

class Category extends Node
{
  use SoftDeletes;

  protected $table = 'categories';

  protected $guarded = [];

  protected $dates = ['deleted_at'];

  public function createDefaultChildren() {
    return $this->children()->firstOrCreate(['title' => 'По-умолчанию', 'url_key' => 'default', 'sort' => 1]);
  }

  public function attributes() {
    return $this->belongsToMany(Attribute::class, 'attribute_category');
  }
}
