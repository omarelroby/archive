<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocFiles extends Model
{
    use HasFactory;
    protected $table='document_files';
    protected $fillable=['file_name','file_id'];
    public function docs()
    {
        return $this->belongsTo(Files::class,'file_id');
    }

    public function getFileNameAttribute()
    {
        return asset('files/docs').'/'.$this->attributes['file_name'];
    }
}
