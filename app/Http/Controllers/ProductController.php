<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $request->validate([
           'name'=>'required',
           'slug'=>'required',
           'price'=>'required|min:0'
       ]);

        return Product::create([
            'name'=> $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        if(!$product){
            return 'Product does not exist';
        }
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if(!$product){
            return 'Product does not exist';
        }
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product){
            return 'Product does not exist';
        }
        $deletedProduct = $product->destroy($id);

        if($deletedProduct == 1){
            return 'Product deleted successfully';
        }
    }


        /**
     * Search the specified resource from storage.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
       return Product::where('name', 'like', '%'.$name.'%')->get();

    }
}
