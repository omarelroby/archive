<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $table='files';
    protected $fillable=['id','name','file_number','revision','document_type_id','import_date','export_date','parties_id','transaction','priority','reply'];
    public function document()
    {
        return $this->belongsTo(DocumentType::class,'document_type_id');
    }
    public function parties()
    {
        return $this->belongsTo(Parties::class,'parties_id');
    }
    public function boards()
    {
        return $this->belongsToMany(BoardDirectors::class,'files_board_of_directors','file_id','board_direct_id')->withPivot('status');
    }
    public function files()
    {
        return $this->hasMany(DocFiles::class,'file_id');
    }


    public function confirmation()
    {
        return $this->hasMany(Fboards::class,'file_id')->where('status','1');
    }
    public function fboards()
    {
        return $this->hasMany(Fboards::class,'file_id');
    }


}
