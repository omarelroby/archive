<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='main_category';
    protected $fillable=[
        'name','translation_lang',
        'translation_of','slug','active'
    ];
    public function product(){
        return $this->hasMany(Product::class,'category_id');
    }

}
