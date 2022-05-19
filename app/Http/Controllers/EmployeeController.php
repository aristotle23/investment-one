<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create(Request $request){
        $data = $request->validate([
            "name" => "required",
            "email" => "required|unique:employees,email"
        ]);
        $employee  = Employee::create($data);
        return $this->response(["employee" => $employee]);
 
    }
    public function index(){
        $employees = Employee::get();
        return $this->response(["employees" => $employees]);
        
    }
    public function get(Employee $employee){
        
        return $this->response(["employees" => $employee]);
        
    }
    public function update(Request $request, Employee $employee){
        $data = $request->validate([
            "email" => "email|unique:employees,email",
            "name" => "",
        ]);
        $employee->email = isset($data['email']) ? $data['email'] : $employee->email;
        $employee->name = isset($data['name']) ? $data['name'] : $employee->email;

        $employee->save();
        return $this->response(["employee" => $employee]);
    }
    public function delete(Employee $employee){
        $employee->delete();
        return $this->response();
    }

    

}
