<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class EmpEvaluator extends Model{
    public $timestamps = false;
    protected $table = 'emp_evaluator';

    protected $fillable = ['emp_number','emp_evaluation','evaluator_status','created_at','created_by','updated_at','updated_by'];
}
