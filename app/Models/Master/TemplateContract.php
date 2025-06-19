<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateContract extends Model {
    use SoftDeletes;
    
    public $timestamps = false;
    protected $table = 'template_contract';
    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'name', 'file_temp', 'type', 'status'];
}
