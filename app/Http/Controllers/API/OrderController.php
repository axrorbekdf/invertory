<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    
    public function TodayOrder(){

        $data = date('Y-m-d');

        $order = DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->where('order_date', $data)
            ->select('customers.name','orders.*')
            ->orderBy('orders.id', 'DESC')->get();

        return response()->json($order);
    }

}
