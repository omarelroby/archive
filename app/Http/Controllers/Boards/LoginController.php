<?php

namespace App\Http\Controllers\Boards;

use App\Models\Admin;
use App\Models\BoardDirectors;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function get() {

        return view('boards.login');
    }

    public function post() {
//       dd(request()->all());
//            dd('aa');

        $this->validate(request(),[
            'email' => 'required|email|max:225',
            'password' => 'required|string|max:191',
        ]);
        $user = BoardDirectors::where('email',request()->email)->first();
        if (!$user) {
//            dd('mm');

            return back()->with('error','البيانات غير صحيحة');
        }


        $remember = request()->has('remember')? true:false;
        $credentials = array('email' => request()->email, 'password' => request()->password);
        $checkLogin = Auth::guard('board')->attempt($credentials,$remember);

        if (!$checkLogin){

            session()->flash('error','البيانات غير صحيحة');
            return redirect('dashboard/boards/login');

        }
        return redirect('/boards/boards');

    }

    public function logout () {
        auth()->guard('admin')->logout();
        return redirect('/dashboard/admin/login');
    }
}
