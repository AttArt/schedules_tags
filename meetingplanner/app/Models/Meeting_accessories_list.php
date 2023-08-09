<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting_accessories_list extends Model
{
    use HasFactory;
    protected $primaryKey = 'listid';
    protected $keyType = 'string';
    protected $fillable = ['listid', 'planid', 'accid', 'comment', 'quantity']; 
}