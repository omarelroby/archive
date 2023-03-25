<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function index(){
        $response=Response::all();
        return view('dashboard.response.index',compact('response'));
    }
    public function create(){
        return view('dashboard.response.create');
    }
    public function store(Request $request){
        $rules=['name'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        Response::create($request->all());
        return redirect('admin/response')->with('success',trans('response.added'));

    }
    public function edit($id)
    {
        $response=Response::find($id);
        return view('dashboard.response.edit',compact('response'));
    }
    public function update($id,Request $request)
    {
        $response=Response::find($id);
        $rules=['name'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails()){
            return $validation->errors()->first();
        }
        $response->update($request->all());
        return redirect('admin/response')->with('success',trans('response.updated'));

    }
    public function destroy($id){
        $follows=Response::find($id);
        $follows->delete();
        return redirect('admin/response')->with('error',trans('response.deleted'));



    }
}
