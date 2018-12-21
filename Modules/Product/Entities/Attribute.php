<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $guarded = [];

  public function typeProducts() {
    return $this->morphedByMany(TypeProduct::class, 'attributable');
  }

  public function lineProducts() {
    return $this->morphedByMany(LineProduct::class, 'attributable');
  }

  public function unit() {
    return $this->belongsTo(Unit::class);
  }

  public function listValue() {
    return $this->hasMany(ListValue::class);
  }

  public function type() {
    return $this->belongsTo(Type::class);
  }

  public function attributeBooleanValues() {
    return $this->hasMany(AttributeBooleanValue::class);
  }

  public function attributeDateValues() {
    return $this->hasMany(AttributeDateValue::class);
  }

  public function attributeDoubleValues() {
    return $this->hasMany(AttributeDoubleValue::class);
  }

  public function attributeIntegerValues() {
    return $this->hasMany(AttributeIntegerValue::class);
  }

  public function attributeListValues() {
    return $this->hasMany(AttributeListValue::class);
  }

  public function attributeTextValues() {
    return $this->hasMany(AttributeTextValue::class);
  }

  public function attributeVarcharValues() {
    return $this->hasMany(AttributeVarcharValue::class);
  }

  public function attributeGroup() {
    return $this->belongsTo(AttributeGroup::class);
  }
}
