<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room_accessories;

class Accessories extends Model
{
    use HasFactory;
    protected $primaryKey = 'accid';
    protected $keyType = 'string';
    protected $fillable = ['accid', 'accname', 'detail', 'image', 'stock', 'requisition']; 

    // public function roomAcc() {
    //     return $this->belongsTo(Room_accessories::class);

    // }
}