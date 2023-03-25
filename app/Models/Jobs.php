<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $table='jobs';
    protected $fillable=['id','name','description','administration_id'];
    public function administrations()
    {
      return $this->belongsTo(Administrations::class,'administration_id');
    }
    public function board()
    {
        return $this->hasMany(BoardDirectors::class);
    }
}
