<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrations;
use App\Models\Jobs;
use Illuminate\Http\Request;

class AdministrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrations=Administrations::all();
        return view('dashboard.administrations.index',compact('administrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.administrations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=['name'=>'required','description'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب','description.required'=> 'الوصف مطلوب '];
        $validation=validator()->make($request->all(),$rules,$messages);
        if ($validation->fails()){
            return $validation->errors()->first();
        }
        Administrations::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return redirect('admin/administrations')->with('success',trans('response.added'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins=Administrations::find($id);
        return view('dashboard.administrations.edit',compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admins=Administrations::find($id);
        $rules=['name'=>'required','description'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب','description.required'=> 'الوصف مطلوب '];
        $validation=validator()->make($request->all(),$rules,$messages);
        if ($validation->fails()){
            return $validation->errors()->first();
        }
        $admins->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return redirect('admin/administrations')->with('success',trans('response.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $admins=Administrations::find($id);
      $admins->delete();
      return redirect('admin/administrations')->with('error',trans('response.deleted'));

    }

    public function get_job($id){
        $positions =Jobs::where("administration_id",$id)->get();
        return ($positions);
    }
}
