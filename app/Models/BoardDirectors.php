<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BoardDirectors extends Authenticatable
{
    use HasFactory;
    protected $table='board_directors';
    protected $fillable=['id','name','password','job_id','position','email','signature','phone','job_number'];
    public function administrations()
    {
        return $this->belongsTo(Administrations::class,'position');
    }
    public function getSignatureAttribute()
    {
        if($this->attributes['signature'])
        return asset('images/signature').'/'.$this->attributes['signature'];
        else
            return '';
    }
    public function files()
    {
        return $this->belongsToMany(Files::class,'files_board_of_directors','board_direct_id','file_id')->withPivot('id','status');
    }
    public function jobs()
    {
        return $this->belongsTo(Jobs::class,'job_id');
    }



}
