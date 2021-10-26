<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use \Yajra\Datatables\Datatables;
use Google\Cloud\Firestore\FirestoreClient;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    protected static $db;

    protected static function firestoreDatabaseInstance()
    {
        $db = new FirestoreClient([
            'projectId' => 'online-shop-ce498'
        ]);

        return $db;
    }
    public function __construct()
    {
        static::$db = self::firestoreDatabaseInstance();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = self::$db->collection('categories')->documents();

        $products = self::$db->collection('products')->orderBy('product_code')->documents();

        return view('product.index', compact('products', 'categories'));
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
            'product_image' => 'required|mimes:jpg,jpeg,png|max:5120',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_stock' => 'required',
            'product_category' => 'required'
        ]);
        // dd($request->product_category);
        if ($request->file('product_image')) {
            $product_file = $validatedData['product_image'];
            $image_name =  time() . "." . $product_file->getClientOriginalExtension();
            $path = public_path('/uploads/product-images/');
            $product_file->move($path, $image_name);
            $product_image = '/uploads/product-images/' . $image_name;
        }
        // $product = self::$db->collection('products');

        $docId = time();
        $product = self::$db->collection('products')->document($docId);

        $product->set([
            'product_id' => (string)$docId,
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_image' => $product_image,
            'product_price' => (int)$request->product_price,
            'product_desc' => $request->product_desc,
            'product_stock' => (int)$request->product_stock,
            'product_category' => $request->product_category
        ]);
        // Product::create($validatedData);
        Alert::alert()->success('Sukses', 'Product berhasil ditambahkan');
        return redirect()->route('product.index');
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
            'product_image' => 'required|mimes:jpg,jpeg,png|max:5120',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_stock' => 'required',
            'product_category' => 'required'
        ];

        $validatedData = $request->validate($rules);
        $product_file = $validatedData['product_image'];
        if ($product_file) {
            if ($request->oldImage) {
                File::delete(public_path($request->oldImage));
            }
            $image_name = time() . "." . $product_file->getClientOriginalExtension();
            $path = public_path('/uploads/product-images/');
            File::makeDirectory($path, $mode = 0777, true, true);
            $product_file->move($path, $image_name);
            $product_image = '/uploads/product-images/' . $image_name;
        }
        $product = self::$db->collection('products')->document($id);
        $product->set([
            'product_id' => $id,
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_image' => $product_image,
            'product_price' => (int)$request->product_price,
            'product_desc' => $request->product_desc,
            'product_stock' => (int)$request->product_stock,
            'product_category' => $request->product_category
        ]);
        // Product::where('id', $id)->update($validatedData);
        Alert::toast('Update Success', 'success');
        return redirect()->route('product.index');
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

        foreach ($products as $prd) {
            if ($prd->id() == $id) {
                $imageProduct = $prd['product_image'];
            }
        }

        if ($imageProduct) {
            File::delete(public_path($imageProduct));
        }
        $product->delete();
        // Product::destroy($product->id);
        Alert::toast('Delete Success', 'success');
        return redirect()->route('product.index');
    }
}
