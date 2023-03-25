<?php

namespace App\Http\Controllers\Boards;

use App\Http\Controllers\Controller;
use App\Models\Administrations;
use App\Models\BoardDirectors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function index(){
        $positions=Administrations::all();
        $user=Auth::guard('board')->user();
        return view('boards.files.edit',compact('user','positions'));
    }
    public function update($id,Request $request){
        $board=BoardDirectors::find($id);
        $data=$request->all();
        $data['password']=bcrypt($data['password']);
        if($request->photo!=null) {
            $path = 'images/signature';
            $file_exetension = $request->file('photo')->getClientOriginalExtension();
            $file_name = time() . '.' . $file_exetension;
            $request->file('photo')->move($path, $file_name);
            $data['signature']=$file_name;
        }
        $board->update($data);
       return  redirect('boards/boards');
    }

}
