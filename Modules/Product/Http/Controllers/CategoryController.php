<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Category;
use Modules\Product\Exceptions\NotFoundParentCategoryException;

class CategoryController extends Controller
{
  /**
   * Display a listing of the categories.
   *
   * @param $parentId
   * @return Category
   */
  public function index($parentId=null)
  {
    return Category::where('parent_id', $parentId)->get();
  }

  /**
   * generate parent Category
   *
   * @param Request $request
   * @return Category
   * @throws NotFoundParentCategoryException
   */
  public function create(Request $request)
  {
    /*$parent = Category::where('parent_id',$request->parentId)->first();
    if(!$parent) {
      throw new NotFoundParentCategoryException('not_found');
    }
    return $parent->createDefaultChildren();*/
    $category = Category::findOrFail($request->parentId);
    return $category->createDefaultChildren();
  }

  /**
   * Store a Category in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    $category = Category::find($request->id);
    $normTitle = str_replace("/"," ",$request["title"]);
    $request["url_key"] = \Slug::make($normTitle);
    $category->fill($request->all());
    $category->save();
    return $category;
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
