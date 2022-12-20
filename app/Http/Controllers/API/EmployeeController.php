<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Image;

class EmployeeController extends Controller
{   
    protected $employe;

    public function __construct()
    {
        $this->employe = new Employee();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->employe->all();
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
            'name' => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required|unique:employees'
        ]);

        if($request->photo){
            $position = strpos($request->photo, ";");
            $sub = substr($request->photo, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = "backend/employee/";
            $image_url = $upload_path.$name;
            $image->save($image_url);

            $imployee = new Employee();
            $imployee->name = $request->name;
            $imployee->email = $request->email;
            $imployee->phone = $request->phone;
            $imployee->sallery = $request->sallery;
            $imployee->address = $request->address;
            $imployee->photo = $image_url;
            $imployee->nid = $request->nid;
            $imployee->joining_date = $request->joining_date;
            $imployee->save();
            
        }else{
            $imployee = new Employee();
            $imployee->name = $request->name;
            $imployee->email = $request->email;
            $imployee->phone = $request->phone;
            $imployee->sallery = $request->sallery;
            $imployee->address = $request->address;
            $imployee->nid = $request->nid;
            $imployee->joining_date = $request->joining_date;
            $imployee->save();
        }

        return response()->json([
            'status' => 'success',
            'data' => 'Insert data',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['sallery'] = $request->sallery;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;

        $image = $request->newphoto;
        if($image){
            $position = strpos($image, ";");
            $sub = substr($image, 0, $position);
            $ext = explode("/", $sub)[1];

            $name = time().".".$ext;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = "backend/employee/";
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);

            if($success){
                $data['photo'] = $image_url;
                unlink($employee->photo);

                $employee->update($data);
            }
        }else{
            $data['photo'] = $request->photo;;

            $employee->update($data);
        }

        return response()->json([
            'status' => 'success',
            'data' => $employee,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if($employee->photo){
            unlink($employee->photo);   
        }

        return response()->json([
            'status' => 'success',
            'data' => $employee->delete()
        ]);

    }
}
