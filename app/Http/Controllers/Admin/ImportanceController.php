<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Importance;
use Illuminate\Http\Request;

class ImportanceController extends Controller
{
    public function index(){
        $importances=Importance::all();
        return view('dashboard.importance.index',compact('importances'));
    }
    public function create(){
        return view('dashboard.importance.create');
    }
    public function store(Request $request){
        $rules=['name'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        Importance::create($request->all());
        return redirect('admin/importance')->with('success',trans('response.added'));

    }
    public function edit($id)
    {
        $importance=Importance::find($id);
        return view('dashboard.importance.edit',compact('importance'));
    }
    public function update($id,Request $request)
    {
        $importance=Importance::find($id);
        $rules=['name'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        $importance->update($request->all());
        return redirect('admin/importance')->with('success',trans('response.updated'));



    }
    public function destroy($id){
        $importance=Importance::find($id);
        $importance->delete();
        return redirect('admin/importance')->with('error',trans('response.deleted'));



    }
}
