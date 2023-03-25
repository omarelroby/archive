<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrations;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;

class JobsController extends Controller
{
    public function index()
    {
        $jobs=Jobs::all();
        return view('dashboard.jobs.index',compact('jobs'));
    }
    public function create()
    {
        $administrations=Administrations::all();
        return view('dashboard.jobs.create',compact('administrations'));
    }
    public function store(Request $request){
        $rules=['name'=>'required' ];
        $messages=['name.required'=>'الاسم مطلوب' ];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails())
        {
            return $validation->errors()->first();
        }
        Jobs::create($request->all());
        return redirect('admin/jobs')->with('success',trans('response.added'));
    }
    public function edit($id)
    {
        $job=Jobs::find($id);
        $administrations=Administrations::all();
        return view('dashboard.jobs.edit',compact('job','administrations'));
    }
    public function update($id,Request $request)
    {
        $job=Jobs::find($id);
        $rules=['name'=>'required' ];
        $messages=['name.required'=>'الاسم مطلوب' ];
        $validation=validator()->make($request->all(),$rules,$messages);
        if($validation->fails())
        {
            return $validation->errors()->first();
        }
        $job->update($request->all());
        return redirect('admin/jobs')->with('success',trans('response.updated'));
    }
    public function destroy($id)
    {
        $job=Jobs::find($id);
        $job->delete();
        return  redirect('admin/jobs')->with('error',trans('response.deleted'));
    }

}
