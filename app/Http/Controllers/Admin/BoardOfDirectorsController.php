<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrations;
use App\Models\BoardDirectors;
use App\Models\Jobs;
use Illuminate\Http\Request;

class BoardOfDirectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $board_directors=BoardDirectors::all();
        return view('dashboard.board_directors.index',compact('board_directors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions=Administrations::all();
        return view('dashboard.board_directors.create',compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'required', 'password' => 'required', 'email' => 'required' ];
        $messages = ['name.required' => 'الاسم مطلوب', 'password.required' => 'ادخل كلمة السر', 'email.required' => 'ادخل الإيميل',
             ];
        $validation = validator()->make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
            return $validation->errors()->first();
        }
        $data=$request->all();
        $data['password']=bcrypt($data['password']);
        if($request->photo!=null) {
            $path = 'images/signature';
            $file_exetension = $request->file('photo')->getClientOriginalExtension();
            $file_name = time() . '.' . $file_exetension;
            $request->file('photo')->move($path, $file_name);
            $data['signature']=$file_name;
        }
        BoardDirectors::create($data);

        return redirect('admin/BoardOfDirectors')->with('success',trans('response.added'));

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
        $member=BoardDirectors::find($id);
        $positions=Administrations::all();
       $jobs=Jobs::all();
        return view('dashboard.board_directors.edit',compact('member','positions','jobs'));
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
       $member=BoardDirectors::find($id);
        $rules = ['name' => 'required', 'email' => 'required' ];
        $messages = ['name.required' => 'الاسم مطلوب', 'email.required' => 'ادخل الإيميل',
        ];
        $validation = validator()->make($request->all(), $rules, $messages);
        if ($validation->fails())
        {
            return $validation->errors()->first();
        }
        $data=$request->all();
        if ($request->passoword)
        $data['password']=bcrypt($data['password']);
        else
        {
            $data['password']=$member->password;
        }
        if($request->photo!=null)
        {
            $path = 'images/signature';
            $file_exetension = $request->file('photo')->getClientOriginalExtension();
            $file_name = time() . '.' . $file_exetension;
            $request->file('photo')->move($path, $file_name);
            $data['signature']=$file_name;
        }
        $member->update($data);
        return redirect('admin/BoardOfDirectors')->with('success',trans('response.updated'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member=BoardDirectors::find($id);
        $member->delete();
        return redirect('admin/BoardOfDirectors')->with('error',trans('response.deleted'));


    }
}
