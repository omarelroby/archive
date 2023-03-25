<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Follows;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function index(){
        $follows=Follows::all();
        return view('dashboard.follows.index',compact('follows'));
    }
    public function create(){
        return view('dashboard.follows.create');
    }
    public function store(Request $request){
        $rules=['name'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        Follows::create($request->all());
        return redirect('admin/follows')->with('success',trans('response.added'));

    }
    public function edit($id)
    {
        $follows=Follows::find($id);
        return view('dashboard.follows.edit',compact('follows'));
    }
    public function update($id,Request $request)
    {
        $follows=Follows::find($id);
        $rules=['name'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        $follows->update($request->all());
        return redirect('admin/follows')->with('success',trans('response.updated'));

    }
    public function destroy($id){
        $follows=Follows::find($id);
        $follows->delete();
        return redirect('admin/follows')->with('error',trans('response.deleted'));



    }
}
