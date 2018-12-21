<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Files\Entities\File;

class TypeProduct extends Model
{
  use SoftDeletes;

  use RelationTrait;

  protected $fillable = [
    'id',
    'title',
    'sort',
    'tnved_id',
    'category_id',
    'description',
    'url_key'
  ];

  protected $dates = ['deleted_at'];

  public function products() {
    return $this->hasMany(Product::class);
  }

  public function tnveds() {
    return $this->belongsTo(Tnved::class);
  }

  public function line_products() {
    return $this->hasMany(LineProduct::class);
  }

  public function category() {
    return $this->belongsTo(Category::class);
  }

  public function files() {
    return $this->morphMany(File::class, 'fileable');
  }

  public function attributes() {
    return $this->morphToMany(Attribute::class, 'attributable');
  }
}
