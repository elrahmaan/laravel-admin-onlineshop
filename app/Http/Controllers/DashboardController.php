<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
        // $products = self::$db->collection('products')->orderBy('product_code')->documents();
        // $totalproduct = 

        // $totalproduct = $products->count();



        // $products = self::count();
        // $totalproduct = $reference = $this->db->collection('products')->getSnapshot()->numChildren();

        // $totalproduct = $products->getSnapshot()->numChildren();

        // $totalproduct = $products;
        // $totalproduct->count;
        // $userCount = iterator_count($users);
        // return view('dashboard.index');

        $orders = self::$db->collection('orders')->orderBy('userEmail')->documents();

        $items = self::$db->collection("item-orders")->documents();

        return view('dashboard.index', compact('orders', 'items'));
    }
}
