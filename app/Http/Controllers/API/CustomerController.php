<?php

namespace App\Http\Controllers\API;

use Image;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    protected $customer;

    public function __construct(){

        $this->customer = new Customer();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->customer->all();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:customers|max:255',
            'email' => 'required',
            'phone' => 'required|unique:customers',
        ]);

        if($request->photo){
            $position = strpos($request->photo, ";");
            $sub = substr($request->photo, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = "backend/customer/";
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $this->customer->name = $request->name;
            $this->customer->email = $request->email;
            $this->customer->phone = $request->phone;
            $this->customer->address = $request->address;
            $this->customer->photo = $image_url;
            $this->customer->save();
            
        }else{
            $this->customer->name = $request->name;
            $this->customer->email = $request->email;
            $this->customer->phone = $request->phone;
            $this->customer->address = $request->address;
            $this->customer->save();
        }

        return response()->json([
            'status' => 'success',
            'data' => 'Insert data',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

        $image = $request->newphoto;
        if($image){
            $position = strpos($image, ";");
            $sub = substr($image, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = "backend/customer/";
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);

            if($success){
                $data['photo'] = $image_url;
                unlink($customer->photo);

                $customer->update($data);
            }
        }else{
            $data['photo'] = $request->photo;;

            $customer->update($data);
        }

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if($customer->photo){
            unlink($customer->photo);
        }

        return response()->json([
            'status' => 'success',
            'data' => $customer->delete()
        ]);
        
    }
}
