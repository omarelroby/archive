<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parties extends Model
{
    use HasFactory;

    protected $table = 'parties';
    protected $fillable = ['id','name', 'description'];

    public function files()
    {
        return $this->hasMany(Files::class);
    }


}
