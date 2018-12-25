<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\LineProduct;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\Attribute;

class AttributeController extends Controller
{

  public function attributes($id)
  {
    $product = Product::findOrFail($id);
    $lineAttributesCollection = collect();
    $typeProductsCollection = collect();
    if ($product->type_product_id) {
      $typeProductsCollection = Attribute::whereHas('typeProducts', function($query) use (&$product) {
        $query->where('id', $product->type_product_id);
      })->with(['unit', 'type', 'attributeGroup', 'listValue'])->get();
    }
    if ($product->line_product_id) {
      $lineAttributesCollection = Attribute::whereHas('lineProducts', function($query) use (&$product) {
        $query->where('id', $product->line_product_id);
      })->with(['unit', 'type', 'attributeGroup', 'listValue'])->get();
    }
    $resultCollection = $typeProductsCollection->concat($lineAttributesCollection);
    $attributeValues = [];
    if ($product->attribute_boolean) {
      $attributeValues['boolean'] = $product->attribute_boolean;
    }
    if ($product->attribute_date) {
      $attributeValues['date'] = $product->attribute_date;
    }
    if ($product->attribute_double) {
      $attributeValues['double'] = $product->attribute_double;
    }
    if ($product->attribute_integer) {
      $attributeValues['integer'] = $product->attribute_integer;
    }
    if ($product->attribute_list) {
      $attributeValues['list'] = $product->attribute_list;
    }
    if ($product->attribute_text) {
      $attributeValues['text'] = $product->attribute_text;
    }
    if ($product->attribute_varchar) {
      $attributeValues['varchar'] = $product->attribute_varchar;
    }
    $result['attributes'] = $resultCollection;
    $result['values'] = $attributeValues;
    return $result;
  }

  public function saveAttributes(Request $request) {
    $productId = $request->productId;
    $attributes = $request->attr;
    $product = Product::find($productId);
    foreach($attributes as $attribute) {
      $product->{'attribute_'.$attribute['type']['title']}()->detach($attribute['id']);
      $product->{'attribute_'.$attribute['type']['title']}()->attach($attribute['id'], ['value' => $attribute['state']['value']]);
    }
    return ['message' => 'Атрибуты сохранены!'];
  }

  /**
   * Get all attributes
   *
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Attribute[]
   */
  public function index()
  {
    return Attribute::with(['unit', 'type', 'attributeGroup'])->get();
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
    return view('product::create');
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    dd($request);
    $attribute = Attribute::findOrFail($request->id);
    return $attribute;
  }

  /**
   * Show the specified resource.
   * @return Response
   */
  public function show()
  {
    return view('product::show');
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit()
  {
    return view('product::edit');
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update(Request $request)
  {
  }

  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function destroy()
  {
  }
}
