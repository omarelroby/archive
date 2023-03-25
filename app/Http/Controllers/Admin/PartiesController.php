<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parties;
use Illuminate\Http\Request;

class PartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties=Parties::all();
        return view('dashboard.parties.index',compact('parties'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.parties.create');
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
        Parties::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return redirect('admin/parties');

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
        $part=Parties::find($id);
        return view('dashboard.parties.edit',compact('part'));
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
      $part=Parties::find($id);
        $rules=['name'=>'required','description'=>'required'];
        $messages=['name.required'=>'الاسم مطلوب','description.required'=> 'الوصف مطلوب '];
        $validation=validator()->make($request->all(),$rules,$messages);
        if ($validation->fails()){
            return $validation->errors()->first();
        }
        $part->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        return redirect('admin/parties');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part=Parties::find($id);
        $part->delete();
        return redirect('admin/parties')->with('error',trans('response.deleted'));


    }
}
