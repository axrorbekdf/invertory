<?php

namespace App\Http\Controllers\API;

use Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    protected $product;

    public function __construct(){
        $this->product = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->product->with(['category','supplier'])->get();

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        if($request->image){
            $position = strpos($request->image, ";");
            $sub = substr($request->image, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($request->image)->resize(240, 200);
            $upload_path = "backend/product/";
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $this->product->category_id = $request->category_id;
            $this->product->product_name = $request->product_name;
            $this->product->product_code = $request->product_code;
            $this->product->root = $request->root;
            $this->product->buying_price = $request->buying_price;
            $this->product->selling_price = $request->selling_price;
            $this->product->supplier_id = $request->supplier_id;
            $this->product->buying_date = $request->buying_date;
            $this->product->image = $image_url;
            $this->product->product_quantity = $request->product_quantity;

        }else{

            $this->product->category_id = $request->category_id;
            $this->product->product_name = $request->product_name;
            $this->product->product_code = $request->product_code;
            $this->product->root = $request->root;
            $this->product->buying_price = $request->buying_price;
            $this->product->selling_price = $request->selling_price;
            $this->product->supplier_id = $request->supplier_id;
            $this->product->buying_date = $request->buying_date;
            $this->product->product_quantity = $request->product_quantity;
        }
        
        $this->product->save();

        return response()->json([
            'status' => 'success',
            'data' => 'Insert data',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = [];
        $data['category_id'] = $request->category_id;
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['root'] = $request->root;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_date'] = $request->buying_date;
        $data['product_quantity'] = $request->product_quantity;

        $image = $request->newimage;
        if($image){
            $position = strpos($image, ";");
            $sub = substr($image, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = "backend/product/";
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);

            if($success){
                $data['photo'] = $image_url;
                unlink($product->image);
            }
        }else{
            $data['image'] = $request->image;;
        }

        $product->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $product,
        ]);
    }

    public function updateStock(Request $request, $id){

        $this->product->where('id', $id)->update(['product_quantity' => $request->product_quantity]);

        return response()->json(['status' => true]);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['status' => true]);
    }
}
