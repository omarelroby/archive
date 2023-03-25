<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;
    protected $table='other';
    protected $fillable=['other_photo','initiatives_id'];
    public function initiatives(){
        return $this->belongsTo(Initiatives::class,'initiatives_id');
    }
}
