<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;

class Producer extends Model
{
  use SoftDeletes;

  use RelationTrait;

  protected $guarded = [];

  protected $dates = ['deleted_at'];

}
