<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDatatable $products)
    {
        return $products->render('admin.products.index', ['title' => trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $product = Product::create([
            'title_ar'=>'',
            'title_en'=>'',

        ]);
        if(!empty($product)){
           return redirect(aurl('products/'.$product->id.'/edit'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.product', ['title' => trans('admin.create_or_edit_product',['title' => $product->{'title_' . lang()}]), 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function upload_file($id) {
        if (request()->hasFile('file')) {
            $data['logo'] = up()->upload([
                'file' => 'file',
                'path' => 'products/'.$id,
                'upload_type' => 'files',
                'file_type'   => 'product',
                'relation_id' => $id,
            ]);
        }
	}
}
