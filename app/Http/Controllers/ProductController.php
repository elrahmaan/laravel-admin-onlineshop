<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use \Yajra\Datatables\Datatables;
use Google\Cloud\Firestore\FirestoreClient;

class ProductController extends Controller
{
    protected static $db;

    protected static function firestoreDatabaseInstance(){
        $db = new FirestoreClient([
        'projectId'=> 'online-shop-ce498'
        ]);

        return $db;
    }
    public function __construct(){
        static::$db = self::firestoreDatabaseInstance();
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        // $categories = Category::all();
        $categories = self::$db->collection('categories')->documents();
        
        $products = self::$db->collection('products')->orderBy('product_name')->documents();

        return view('product.index', compact('products','categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = self::$db->collection('categories')->documents();
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
            'product_category' => 'required'
        ]);
        // dd($request->product_category);
        if($request->file('product_image')){
            $validatedData['product_image'] = $request->file('product_image')->store('product-images');
            $imageURL = 'http://localhost:8000/storage/' . $validatedData['product_image'];
        }
        $product = self::$db->collection('products');
        $product->add([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_image' => $imageURL,
            'product_price' => $request->product_price,
            'product_desc' => $request->product_desc,
            'product_stock' => $request->product_stock,
            'product_category' => $request->product_category
        ]);
        // Product::create($validatedData);
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
        $product = self::$db->collection('products')->document($id)->snapshot();
        $categories = self::$db->collection('categories')->documents();
        // $product = Product::find($id);
        // $id = $product->id;
        // $categories = Category::all();
        return view('product.product_edit', compact('product', 'categories'));
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
            'product_code' => 'required|unique:products',
            'product_name' => 'required|unique:products',
            'product_image' =>'required|mimes:jpg,jpeg,png|max:5120',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_stock' => 'required',
            'product_category' => 'required'
        ];

        $validatedData = $request->validate($rules);

        if($request->file('product_image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['product_image'] = $request->file('product_image')->store('product-images');
            $imageURL = 'http://localhost:8000/storage/' . $validatedData['product_image'];
        }
        $product = self::$db->collection('products')->document($id);
        $product->set([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_image' => $imageURL,
            'product_price' => $request->product_price,
            'product_desc' => $request->product_desc,
            'product_stock' => $request->product_stock,
            'product_category' => $request->product_category
        ]);
        // Product::where('id', $id)->update($validatedData);

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
        // $product = Product::find($id);
        $product = self::$db->collection('products')->document($id);
        $products = self::$db->collection('products')->orderBy('product_name')->documents();

        foreach($products as $prd){
            if($prd->id() == $id){
                $imageProduct = $prd['product_image'];
            }
        }
        
        if($imageProduct){
            Storage::delete(substr($imageProduct, 30, 200));
        }        
        $product->delete();
        // Product::destroy($product->id);
        return redirect()->route('product.index')->with('success', 'Data barang berhasil dihapus');
    }
}
