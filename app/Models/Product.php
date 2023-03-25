<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=[
        'product_name','category_id','product_qty','photo'
    ];
    protected $hidden=['created_at','updated_at'];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
