<?php

namespace App\Http\Controllers\API;

use Image;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{

    protected $supplier;

    public function __construct(){
        $this->supplier = new Supplier();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = $this->supplier->all();
        return response()->json($supplier);
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
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:suppliers'
        ]);

        if($request->photo){
            $position = strpos($request->photo, ";");
            $sub = substr($request->photo, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = "backend/supplier/";
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->address = $request->address;
            $supplier->photo = $image_url;
            $supplier->save();
            
        }else{
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->address = $request->address;
            $supplier->save();
        }

        return response()->json([
            'status' => 'success',
            'data' => 'Insert data',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['shopname'] = $request->shopname;
        $data['address'] = $request->address;

        $image = $request->newphoto;
        if($image){
            $position = strpos($image, ";");
            $sub = substr($image, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = "backend/supplier/";
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);

            if($success){
                $data['photo'] = $image_url;
                unlink($supplier->photo);
                
                $supplier->update($data);
            }
        }else{
            $data['photo'] = $request->photo;;

            $supplier->update($data);
        }

        return response()->json([
            'status' => 'success',
            'data' => $supplier,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if($supplier->photo){
            unlink($supplier->photo);
            $supplier->delete();
        }else{
            $supplier->delete();
        }
    }
}
