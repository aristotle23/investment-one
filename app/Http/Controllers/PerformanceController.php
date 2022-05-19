<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PerformanceController extends Controller
{
    public function create(Request $request, Employee $employee){
        $data = $request->validate([
            "review" => "required",
        ]);
        $performance = $employee->performances()->create($data);
        $performance->load("employee");
        return $this->response(["performace" => $performance]);
        
    }
    public function index(){
        $performances = Performance::get();
        return $this->response(["performaces" => $performances]);
    }
    public function update(Request $request, Performance $performance){
        $data = $request->validate([
            "review" => "required",
        ]);
        $performance->review = $data['review'];
        $performance->save();
        return $this->response(["performace" => $performance]);
    }
    public function assignEmployee(Request $request, Performance $performance){
        $data = $request->validate([
            "email" => "required|email"
        ]);
        $aEmployee = Employee::where("email", $data['email'])->first();
        if(! $aEmployee){
            return $this->sendFail(401,['msg' => "Employee does not exist"]);
        } 
        if($aEmployee->id == $performance->employee->id){
            return $this->sendFail(401,['msg' => "Can't assign employee to his own performance"]);
        } 
        $performance->assigned_employee_id = $aEmployee->id;
        $performance->save();
        $performance->load("assigned_employee");
        $feebackUrl = URL::signedRoute("performance.feedback",["performance" => $performance->id, "employee" => $aEmployee->id]);
        return $this->response(["url" => $feebackUrl,"performace" => $performance]);

    }
}
