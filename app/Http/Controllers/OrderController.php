<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Firestore\FirestoreClient;

class OrderController extends Controller
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
        $orders = self::$db->collection('orders')->orderBy('userEmail')->documents();
        // $carts = self::$db->collection->collection("carts")->document($orders->id())->collection($orders['collectionRef']);
        $items = self::$db->collection("item-orders")->documents();
        // foreach($carts as $cart){
        //     $cart = $carts->document($cart->id())->collection($cart['collectionRef']);
        // }
        return view('order.index', compact('orders', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = self::$db->collection('orders')->document($id)->snapshot();
        $orders = self::$db->collection('orders')->documents();

        foreach($orders as $ord){
            if($ord->id() == $id){
                $itemOrder = $ord['collectionRef'];
                $userId = $ord['userId'];
            }
        }
        $itemsOrder = self::$db->collection('carts')->document($userId)->collection($itemOrder)->documents();
        return view('order.order_show', compact('order', 'itemsOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

        $order = self::$db->collection('orders')->document($id);
        if($request->note == null){
            $note = "-";
        }else{
            $note = $request->note;
        }
        

        //MENGUBAH STOK KETIKA STATUS SUDAH 'CONFIRMED' (DIKONFIRMASI)
        if($request->status == 'Confirmed'){
            // mengambil data user dan nama keranjang produk
            $orders = self::$db->collection('orders')->documents();
            foreach ($orders as $ord) {
                if ($ord->id() == $id) {
                    $userId = $ord['userId'];
                    $collectionReff = $ord['collectionRef'];
                }
            }

            // mengambil data produk sesuai nama keranjang
            $productsOrder = self::$db->collection('carts')->document($userId)->collection($collectionReff)->documents();
            
            if($productsOrder ->size() > 0) {
                
                foreach ($productsOrder as $prdOrder) {
                    if($prdOrder->exists()){
                        $productId = $prdOrder['product_id'];
                        $qty = $prdOrder['product_qty'];
                        $products = self::$db->collection('products')->documents();
                        foreach ($products as $product) {
                            if($product->id() == $productId){
                                $stock = $product['product_stock'];
                                $updateStock = $stock - $qty;
                                // dd($updateStock);
                                $prod = self::$db->collection('products')->document($productId);
                                // dd($prod);
                                $prod->update([
                                    ['path' => 'product_stock', 'value' => (int)$updateStock],
                                ]);  
                            }
                        }
                    }
                }
                
            }
        }
        $order->update([
            ['path' => 'status', 'value' => $request->status],
            ['path' => 'note', 'value' => $note],
        ]);
        return redirect()->route('order.index')->with('success', 'Status transaksi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
