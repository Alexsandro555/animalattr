<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;

class LineProduct extends Model
{
  use RelationTrait;

  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id',
    'title',
    'sort',
    'type_product_id',
    'url_key'
  ];

  protected $guarded = [];

  public function type_product() {
    return $this->belongsTo(TypeProduct::class);
  }

  public function producers() {
    return $this->belongsToMany(Producer::class);
  }

  public function products() {
    return $this->hasMany(Product::class);
  }

  public function attributes() {
    return $this->morphToMany(Attribute::class, 'attributable');
  }
}
