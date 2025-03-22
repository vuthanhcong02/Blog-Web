<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckUserChangeProfileRequest;
use App\Http\Requests\CheckUserRegisterRequest;
use App\Http\Requests\CheckUserRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Utilities\UploadFile;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function __construct(protected AuthService $authService) {}

    public function login(Request $request)
    {
        return view('frontend.auth.login');
    }

    public function postLogin(CheckUserRequest $request)
    {
        $dataInfor = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = isset($request->remember) ? true : false;

        if (Auth::attempt($dataInfor, $remember)) {
            // if (!Auth::user()->hasVerifiedEmail()) {
            //     Auth::logout();
            //     return back()->with('error', 'Bạn cần xác thực email trước khi đăng nhập.');
            // }
            // return redirect('/');
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

    public function register()
    {
        $hCaptchaSiteKey = config('const.HCAPTCHA_SITE_KEY');

        return view('frontend.auth.register')->with([
            'hCaptchaSiteKey' => $hCaptchaSiteKey,
        ]);
    }

    public function postRegister(CheckUserRegisterRequest $request)
    {
        $user = $this->authService->register($request);
        if (! $user) {
            return redirect()->back();
        }

        return redirect()->back()->with('success', 'Vui lòng kiểm tra email để xác nhận tài khoản!');
    }

    public function settingAccount()
    {
        return view('frontend.auth.setting');
    }

    public function changeAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatar_old = Auth::user()->avatar;
            $fileName = UploadFile::uploadFile($file, 'assets/images/avatar');
            User::where('id', Auth::user()->id)->update(['avatar' => $fileName]);
            if ($avatar_old && file_exists(public_path('assets/images/avatar/'.$avatar_old))) {
                unlink(public_path('assets/images/avatar/'.$avatar_old));
            }

            return redirect()->back();
        }
    }

    public function updateProfile(CheckUserChangeProfileRequest $request)
    {

        if ($request->password == null) {
            $dataInfor = [
                'name' => $request->name,
                'email' => $request->email,
            ];
        } else {
            $dataInfor = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
        }
        User::where('id', Auth::user()->id)->update($dataInfor);

        return redirect()->back()->with('success', 'Thông tin đã được lưu thành công');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $this->authService->verify($request);

        return redirect()->route('home');
    }
}
