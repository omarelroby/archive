<?php
namespace App\Traits;



Trait ImageTrait{
    public function saveImage($photo,$folder)
    {
        $file_exetension=$photo->getClientOriginalExtension();
        $file_name=time().'.'.$file_exetension;
        $path=$folder;
        $photo->move($path,$file_name);
        return $file_name;
    }








}
