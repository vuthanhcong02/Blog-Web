<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CheckUserRequest;
class AccountController extends Controller
{
    //
    public function login(Request $request){
        return view('Frontend.account.login');
    }
    public function checkLogin(CheckUserRequest $request){
        $dataInfor  = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = isset($request->remember) ? true : false;
        if(Auth::attempt($dataInfor, $remember)){
            //return redirect('/');
            return redirect()->intended('/');
        }
        else{
            return redirect()->back()->with('error','Đăng nhập thất bại.Vui lòng kiểm tra lại email hoặc mật khẩu!');
        }
        // dd($dataInfor);
    }
    public function register(Request $request){
        return view('Frontend.account.register');
    }
}
