<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function performances (){
        return $this->hasMany(Performance::class);
    }
    public function assigned_perforamce(){
        return $this->hasMany(Performance::class,"assigned_employee_id","id");
    }
}
