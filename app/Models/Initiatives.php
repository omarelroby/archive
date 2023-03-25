<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initiatives extends Model
{
    use HasFactory;
    protected $table='initiatives';
    protected $fillable=['name','date','location','details','photo'];
    public function other(){
        return $this->hasMany(Other::class);
    }
}
