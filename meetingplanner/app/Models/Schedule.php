<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $primaryKey = 'planid';
    protected $keyType = 'string';
    protected $fillable = ['planid', 'planner', 'title', 'detail', 'mrid', 'deptid', 'startdate', 'enddate']; 
}
 