<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $Services=Service::all();
      // dd($Services);
        return view('dashboard.service.index',compact('Services'));
    }
    public function create(){
        return view('dashboard.service.create');
    }
    public function store(Request $request)
    {
        $rules=['name'=>'required','details'=>'required','photo'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب','details.required'=>'التفاصيل مطلوبة','photo.required'=>'الصورة مطلوبة'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        $path='public/photos';
        $file_exetension=$request->file('photo')->getClientOriginalExtension();
        $file_name=time().'.'.$file_exetension;
        $img=$request->file('photo')->move($path,$file_name);

        $data=$request->all();
        $data['photo']= $img;

        Service::create($data);
        return redirect('admin/service')->with('success',trans('response.added'));

    }
    public function edit($id)
    {
        $service=Service::find($id);
        return view('dashboard.service.edit',compact('service'));
    }
    public function update($id,Request $request)
    {
        $service=Service::find($id);
        $rules=['name'=>'required','details'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب','details.required'=>'التفاصيل مطلوبة'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        $path='public/photos';
        $file_exetension=$request->file('photo')->getClientOriginalExtension();
        $file_name=time().'.'.$file_exetension;
        $img=$request->file('photo')->move($path,$file_name);
        $data=$request->all();
        $data['photo']= $img;
        $service->update($data);
        return redirect('admin/service')->with('success',trans('response.updated'));


    }
    public function destroy($id){
        $service=Service::find($id);
        $service->delete();
        return redirect('admin/service')->with('error',trans('response.deleted'));

    }

}
