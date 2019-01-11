<?php
namespace Modules\Initializer\Traits;

use Illuminate\Http\Request;


trait ControllerTrait {
  public $model;

  public function index(Request $request)
  {
    return $this->model->all();
  }

  public function load(Request $request)
  {
    $values=$request->all();
    $m=$this->model;

    foreach ($values as $key=>$value)
    {
      if (is_array($value)) {
        $m=$m->whereIn($key,(array) $value);} else {
        $m=$m->where($key,$value);
      }
    }
    return $m->get();
  }

  public function save(Request $request)
  {
    $multidim=false;
    foreach ($request->all() as $key=>$value)
    {
      if ($key===0) $multidim=true;break;
    }
    if (!$multidim)
    {
      $this->model=$this->model->firstOrNew([$this->model->getKeyName() =>$request[$this->model->getKeyName()]]);
      $this->model->fill($request->all());
      $this->model->save();
      return $this->model;
    } else {
      foreach ($request->all() as $value)
      {
        $f=$this->model->firstOrNew([$this->model->getKeyName() => $value[$this->model->getKeyName()]]);
        $f->fill($value);
        $f->save();
      }
    }
    return $f;
  }
  public function delete(Request $request)
  {
    $k=$this->model->find($request->id);
    $k->delete();
    return $k;
  }
}

?>