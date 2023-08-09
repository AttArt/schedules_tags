<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accessories;
 
class Room_accessories extends Model
{
    use HasFactory;
    protected $primaryKey = 'rlistid';
    protected $keyType = 'string';
    protected $fillable = ['rlistid','accid', 'mrid', 'active', 'requisition']; 

    public function accessories() {
        return $this->hasMany(Accessories::class, 'accid', 'accid');
    }
}
