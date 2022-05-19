<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;
    protected $fillable = [ "review" , "employee_id"]; 

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function assigned_employee(){
        
        return $this->belongsTo(Employee::class,"assigned_employee_id","id");
    }
}
