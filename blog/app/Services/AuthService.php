<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthService
{
    public function __construct(protected UserRepository $userRepository) {}

    public function login($request): bool {}

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
}
