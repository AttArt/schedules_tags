<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan_dept extends Model
{
    // protected $connection = 'mysql2';
    
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'color', 'rgb', 'class', 'active']; 
}
 