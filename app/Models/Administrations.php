<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrations extends Model
{
    use HasFactory;
    protected $table='administrations';
    protected $fillable=['id','name','description'];
    public function members()
    {
        return $this->hasMany(BoardDirectors::class,'position');
    }
    public function jobs()
    {
        return $this->hasMany(Jobs::class);
    }
}
