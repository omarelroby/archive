<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents=DocumentType::all();
        return view('dashboard.document_type.index',compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.document_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=['name'=>'required'];
        $messages=['name.required'=>'name is required'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if ($validation->fails())
        {
            return $validation->errors()->first();
        }
        DocumentType::create([
            'name'=>$request->name
        ]);
       return redirect('admin/document_type')->with('success',trans('response.added'));


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
        $document=DocumentType::find($id);
        return view('dashboard.document_type.edit',compact('document'));
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
        $document=DocumentType::find($id);
        $rules=['name'=>'required'];
        $messages=['name.required'=>'name is required'];
        $validation=validator()->make($request->all(),$rules,$messages);
        if ($validation->fails())
        {
            return $validation->errors()->first();
        }
        $document->update([
            'name'=>$request->name
        ]);
        return redirect('admin/document_type')->with('success',trans('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc=DocumentType::find($id);
        $doc->delete();
        return redirect('admin/document_type')->with('error',trans('response.deleted'));

    }
}
