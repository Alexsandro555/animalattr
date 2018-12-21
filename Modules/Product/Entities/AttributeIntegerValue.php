<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;

class AttributeIntegerValue extends Model
{
  use SoftDeletes;

  use RelationTrait;

  protected $guarded = [];

  public function attribute() {
    return $this->belongsTo(Attribute::class);
  }
}
