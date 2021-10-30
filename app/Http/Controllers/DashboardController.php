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
        $categories = self::$db->collection('categories')->documents();
        $products = self::$db->collection('products')->documents();
        $users = self::$db->collection('users')->documents();
        $orders = self::$db->collection('orders')->documents();
        $totalOrder = 0;
        $orderSuccess = 0;
        $orderUnconfirmed = 0;
        $orderDelivered = 0;
        $orderConfirmed = 0;
        $requestYear = "2021";
        $limitYear = "";
        foreach($orders as $ord){
            if($ord['status'] == 'Success'){
                if($ord ->size() > 0) {
                    $limitYear = substr($ord['orderDateTime'], 6, 4);
                    if($requestYear == $limitYear){
                        $totalOrder += $ord['totalOrder'];
                        $orderSuccess++;   
                    }
                }
            }else if($ord['status'] == 'Unconfirmed'){
                $orderUnconfirmed++;
            }else if($ord['status'] == 'Delivered'){
                $orderDelivered++;
            }else if($ord['status'] == 'Confirmed'){
                $orderConfirmed++;
            }       
        }

        $countProducts = $products->size();
        $countCategories = $categories->size();
        $countUsers = $users->size();
        $countOrders = $orders->size();
        
        

        // $orders = self::$db->collection('orders')->orderBy('userEmail')->documents();

        return view('dashboard.index', compact('requestYear','countProducts', 
            'countCategories', 
            'countUsers', 
            'countOrders', 
            'totalOrder',
            'orderSuccess', 
            'orderUnconfirmed',
            'orderDelivered',
            'orderConfirmed')
        );
    }
}
