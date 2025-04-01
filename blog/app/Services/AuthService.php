<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(protected UserRepository $userRepository) {}

    public function login($request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = isset($request->remember) ? true : false;
        $user = Auth::attempt($data, $remember);

        return $user;
    }

    /**
     * Handle post register
     *
     * @param  mixed  $request
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function register($request)
    {
        if (! $this->verifyHCaptcha($request['h-captcha-response'])) {
            return false;
        }
        $emailExisted = $this->checkEmailExist($request->email);
        if ($emailExisted) {
            return false;
        }
        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        return $user;

    }

    /**
     * Check email exist
     *
     * @return object|User|\Illuminate\Database\Eloquent\Model|null
     */
    public function checkEmailExist(string $email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * Verify email
     *
     * @param  mixed  $request
     * @return void
     */
    public function verify($request)
    {
        $request->fulfill();
        Auth::login($request->user());
    }

    /**
     * Get status HCaptcha
     *
     * @param  mixed  $hCaptchaResponse
     */
    public function verifyHCaptcha($hCaptchaResponse): bool
    {
        $secretKey = config('const.HCAPTCHA_SECRET_KEY');
        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret' => $secretKey,
            'response' => $hCaptchaResponse,
        ]);

        return $response->json()['success'] ?? false;
    }

    public function forgotPassword($request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? true : false;
    }

    public function resetPassword($request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET ? true : false;
    }
}
