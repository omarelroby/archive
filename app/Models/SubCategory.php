<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='sub_categories';
    protected $fillable=['subCategory_name','subCategory_types','photo'];
    protected $hidden=['created_at','updated_at'];
}
