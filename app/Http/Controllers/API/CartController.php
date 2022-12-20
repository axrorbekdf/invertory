<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class CartController extends Controller
{
   

   public function AddToCart(Request $request, $id){
        $produt = Product::find($id);

        $check = DB::table('pos')->where('pro_id', $id)->first();

        if($check){
            DB::table('pos')->where('pro_id', $id)->increment('pro_quantity');

            $product = DB::table('pos')->where('pro_id', $id)->first();
             $sub_total = $product->pro_quantity*$product->product_price;
             DB::table('pos')->where('pro_id', $id)->update(['sub_total' => $sub_total]);
        }else{
            $data = [];
            $data['pro_id'] = $id;
            $data['pro_name'] = $produt->product_name;
            $data['pro_quantity'] = 1;
            $data['product_price'] = $produt->selling_price;
            $data['sub_total'] = $produt->selling_price;

            DB::table('pos')->insert($data);
        }

        return response()->json(['status'=>'success']);
   }


   public function CartProduct(){

        $data = DB::table('pos')->get();
        return response()->json($data);
   }

   public function RemoveCart($id){

        DB::table('pos')->where('id', $id)->delete();

        return response()->json(['status'=>'success']);

   }

    public function IncrementCart($id){
        $quantity = DB::table('pos')->where('id', $id)->increment('pro_quantity');

         $product = DB::table('pos')->where('id', $id)->first();
         $sub_total = $product->pro_quantity*$product->product_price;
         DB::table('pos')->where('id', $id)->update(['sub_total' => $sub_total]);

         return response()->json(['status'=>'success']); 
    }

    public function DecrementCart($id){
        $quantity = DB::table('pos')->where('id', $id)->decrement('pro_quantity');

        $product = DB::table('pos')->where('id', $id)->first();
        $sub_total = $product->pro_quantity*$product->product_price;
        DB::table('pos')->where('id', $id)->update(['sub_total' => $sub_total]);

        return response()->json(['status'=>'success']);
    }

    public function Vats(){
        $vat = DB::table('extras')->first();

        return response()->json($vat);
    }
}
