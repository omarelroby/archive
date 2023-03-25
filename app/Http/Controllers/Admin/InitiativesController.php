<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Initiatives;
use App\Models\Other;
use Illuminate\Http\Request;

class InitiativesController extends Controller
{
   public function index()
   {
       $initiatives=Initiatives::all();
       return view('dashboard.initiatives.index',compact('initiatives'));
   }
   public function create(){
       return view('dashboard.initiatives.create');
   }
   public function store(Request $request)
   {
       $rules=['name'=>'required','details'=>'required','location'=>'required',
           'date'=>'required'];
       $messages=['name.required'=>'ادخل اسم المبادرة','details.required'=>'ادخل تفاصيل المبادرة',
           'location.required'=>'ادخل مكان المبادرة','date.required'=>'ادخل تاريخ المبادرة'];
       $validation=validator()->make($request->all(),$rules,$messages);
       if($validation->fails()){
           return $validation->errors()->first();
       }

       $path='public/initiatives/photos';
       $file_exetension=$request->file('photo')->getClientOriginalExtension();
       $file_name=time().'.'.$file_exetension;
       $img=$request->file('photo')->move($path,$file_name);
       $data=$request->all();
       $data['photo']= $img;
       $initiatives=Initiatives::create($data);
       foreach ($request->images as $image)
       {
           $path='images';
           $imageName = md5(rand(1000,9999).time()). '.'.$image->getClientOriginalExtension();
           $image->move(public_path('initiatives/'.$path),$imageName);
           Other::create(['other_photo'=>$imageName,'initiatives_id'=>$initiatives->id]);
       }
       return redirect('admin/initiatives');
   }
   public function show($id)
   {
       $others=Other::where('initiatives_id',$id)->get();
       return view('dashboard.initiatives.show',compact('others'));


   }
}
