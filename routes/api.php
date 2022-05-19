<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post("signin", [AuthController::class, "signin"]);
    Route::post("signup", [AuthController::class, "signup"]);
});
Route::middleware(['auth:sanctum',"throttle:api"])->group(function () {
    Route::prefix("employee")->group(function () {
        Route::post("/", [EmployeeController::class, "create"]);
        Route::get("/", [EmployeeController::class, "index"]);
        Route::put("/{employee}", [EmployeeController::class, "update"]);
        Route::delete("/{employee}", [EmployeeController::class, "delete"]);
        Route::get("/{employee}", [EmployeeController::class, "get"]);
    });

    Route::prefix("performance")->group(function () {
        Route::get("/", [PerformanceController::class, "index"]);
        Route::post("/{employee}", [PerformanceController::class, "create"]);
        Route::put("/{performance}", [PerformanceController::class, "update"]);
        Route::post("/assign/{performance}", [PerformanceController::class, "assignEmployee"]);
    });
});

/*
|--------------------------------------------------------------------------
| Employee accessible api
|--------------------------------------------------------------------------
|
| According to the challenge,the employee view have no login.
| I'm assuming that an employee that have been assigned to a performance
| review only need a signed link to write feedback and use email 
| to view performance review list requiring his feedback
|
*/
/*
|
| I use POST because I'm assuming this request will be coming from a form
| This endpoint return employee's prefromance reviews and performance revies
| that was assigned to the employee
|
*/
Route::post("reviews", [ReviewController::class, "index"])->middleware("throttle:api");
//
Route::post("performance/{performance}/feedback",[ReviewController::class, "feedback"])->middleware("throttle:api");
