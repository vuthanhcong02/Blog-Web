<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\CheckUserRequest;
use App\Http\Requests\CheckUserRegisterRequest;
use App\Http\Requests\CheckUserChangeProfileRequest;
use App\Utilities\UploadFile;
class AccountController extends Controller
{
    //
    public function login(Request $request)
    {
        return view('Frontend.account.login');
    }
    public function checkLogin(CheckUserRequest $request)
    {
        $dataInfor  = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = isset($request->remember) ? true : false;
        if (Auth::attempt($dataInfor, $remember)) {
            //return redirect('/');
            $previousUrl = $request->input('previous');
            if ($previousUrl) {
                return redirect()->to($previousUrl);
            } else {
                return redirect()->intended('/');
            }
        } else {
            return redirect()->back()->with('error', 'Đăng nhập thất bại.Vui lòng kiểm tra lại email hoặc mật khẩu!');
        }
        // dd($dataInfor);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
    public function register(Request $request)
    {
        return view('Frontend.account.register');
    }
    public function checkRegister(CheckUserRegisterRequest $request){
        $email_exsist = User::where('email',$request->email)->first();
        if($email_exsist){
            return redirect()->back()->with('error','Email đã tồn tại! Hãy sử dụng email khác!');
        }
        $dataInfor  = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::create($dataInfor);
        session(['registered_email' => $request->email]);
        session(['registered_password' => $request->password]);
        return redirect('/account/login');
    }
    public function settingAccount(){
        return view('Frontend.account.setting');
    }
    public function changeAvatar(Request $request){
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $avatar_old = Auth::user()->avatar;
            $fileName = UploadFile::uploadFile($file, 'assets/images/avatar');
            User::where('id',Auth::user()->id)->update(['avatar' => $fileName]);
            if ($avatar_old && file_exists(public_path('assets/images/avatar/' . $avatar_old))) {
                unlink(public_path('assets/images/avatar/' . $avatar_old));
            }
            return redirect()->back();
        }
    }
    public function updateProfile(CheckUserChangeProfileRequest $request){

        if($request->password == null){
            $dataInfor  = [
                'name' => $request->name,
                'email' => $request->email,
            ];
        }else{
            $dataInfor  = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
        }
        User::where('id',Auth::user()->id)->update($dataInfor);
        return redirect()->back()->with('success','Thông tin đã được thành công');
    }
}
