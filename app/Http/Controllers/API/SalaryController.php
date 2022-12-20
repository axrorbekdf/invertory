<?php

namespace App\Http\Controllers\API;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    protected $salary;

    public function __construct()
    {
        $this->salary = new Salary();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->salary->with(['employee'])->get();

        return response()->json($data);
    }

    public function paid(Request $request, $id){

        $validate = $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = $this->salary->where('employee_id', $id)->where('salary_month', $month)->first();

        if($check){
            return response()->json("Salary Alrady Paid");            
        }else{
            $data = [];
            $data['employee_id'] = $id;
            $data['amount'] = $request->amount;
            $data['salary_date'] = date("Y-m-d");
            $data['salary_month'] = $month;
            $data['salary_year'] = date("Y");

            $data = $this->salary->create($data);

            return response()->json($data);
        }

    }

    public function allSalary(){
        $data = $this->salary->select('salary_month')->groupBy('salary_month')->get();

        return response()->json($data);
    }

    public function view($month){
        $data = $this->salary->with('employee')->where('salary_month', $month)->get();

        return response()->json($data);
    }

    public function edit($id)
    {   
        $salary = $this->salary->with('employee')->where('id', $id)->get();
        return response()->json($salary);
    }

    public function updateSalary(Request $request, $id)
    {   
        $data = [];
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_date'] = $request->salary_date;
        $data['salary_month'] = $request->salary_month;
        $data['salary_year'] = $request->salary_year;

        $data = $this->salary->where('id', $id)->update($data);

        return response()->json($data);
    }

    
}
