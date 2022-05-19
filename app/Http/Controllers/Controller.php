<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($data = []){

        return response()->json(array_merge(["status" => "ok"],$data));
    }
    public function sendFail($code, $data = []){
        return response()->json(array_merge(["status" => "fail"],$data),$code);
    }
    
    
}
