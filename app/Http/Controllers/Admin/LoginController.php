<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function get() {
        return view('auth.login');
    }

    public function post() {
//       dd(request()->all());


        $this->validate(request(),[
            'email' => 'required|email|max:225',
            'password' => 'required|string|max:191',
        ]);
        $user = Admin::where('email',request()->email)->first();
        if (!$user) {
//            dd('mm');

            return back()->with('error','البيانات غير صحيحة');
        }


        $remember = request()->has('remember')? true:false;
        $credentials = array('email' => request()->email, 'password' => request()->password);
        $checkLogin = Auth::guard('admin')->attempt($credentials,$remember);

        if (!$checkLogin){
//            dd('ss');
            session()->flash('error','البيانات غير صحيحة');
            return redirect('dashboard/admin/login');

        }
        return redirect('/admin/document_type');

    }

    public function logout () {
        auth()->guard('admin')->logout();
        return redirect('/dashboard/admin/login');
    }
}
