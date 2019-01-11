<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Database\Seeders\CategoryTableSeeder;
use Modules\Product\Entities\Product;
use Modules\Initializer\Traits\ControllerTrait;

class ProductController extends Controller
{
  Use ControllerTrait;

  public $model;
  public function __construct()
  {
    $this->model=new Product;
  }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      return Product::orderBy('created_at', 'desc')->get();
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
