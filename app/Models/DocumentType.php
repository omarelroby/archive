<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $table='document_type';
    protected $fillable=['name'];
    public function files()
    {
        return $this->hasMany(Files::class);
    }
}
