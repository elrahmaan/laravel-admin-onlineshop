<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.product_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_code' => 'required|unique:products',
            'product_name' => 'required|unique:products',
            'product_image' =>'required|mimes:jpg,jpeg,png|max:5120',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_stock' => 'required',
            'category_id' => 'required'
        ]);
        if($request->file('product_image')){
            $validatedData['product_image'] = $request->file('product_image')->store('product-images');
        }
        Product::create($validatedData);
        return redirect()->route('product.index')->with('success', 'Data barang berhasil ditambahkan');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $id = $product->id;
        $categories = Category::all();
        return view('product.product_edit', compact('product','id','categories'));
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
        $rules = [
            'product_code' => 'required',
            'product_name' => 'required',
            'product_image' =>'required|mimes:jpg,jpeg,png|max:5120',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_stock' => 'required',
            'category_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        if($request->file('product_image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['product_image'] = $request->file('product_image')->store('product-images');
        }
        Product::where('id', $id)->update($validatedData);
        return redirect()->route('product.index')->with('success', 'Data barang berhasil diubah');
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

        if($product->product_image){
            Storage::delete($product->product_image);
        }
        Product::destroy($product->id);
        return redirect()->route('product.index')->with('success', 'Data barang berhasil dihapus');
    }
}
