<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Performance;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request){
        $data = $request->validate([
            "email" => "required|email"
        ]);
        $employee = Employee::where("email",$data['email'])->first();
        $employee->load("performances.assigned_employee","assigned_perforamce");
        return $this->response(["reviews" => $employee]);
    }
    public function feedback(Request $request, Performance $performance){
        $data = $request->validate([
            "feedback" => "required"
        ]);
        $performance->feedback = $data['feedback'];
        $performance->save();

        return $this->response(["performance" => $performance]);
    }

    
}
