<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fboards extends Model
{
    use HasFactory;
    protected $table='files_board_of_directors';
    protected $fillable=['file_id','board_direct_id','status'];

    public function file()
    {
        return $this->belongsTo(Files::class,'file_id');
    }


}
