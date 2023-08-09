<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting_rooms extends Model
{
    use HasFactory;
    protected $primaryKey = 'mrid';
    protected $keyType = 'string';
    protected $fillable = ['mrid', 'mrname', 'isopen']; 
}