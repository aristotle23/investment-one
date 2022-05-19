<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/**
 * this is a signed link. That will display a feedback form
 */
Route::get("feedback/performance/{performance}/employee/{employee}", function(Request $request){
    if (! $request->hasValidSignature()) return $this->sendFail(401, ["msg" => "Invalid url signature"]);
    /**
     * The feedback view (form) will be here 
     */  
})->name("performance.feedback");