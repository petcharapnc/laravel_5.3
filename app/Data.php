<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table="employees"; 
    public $timestamps = false;
    protected $primaryKey = 'employee_id';

}
