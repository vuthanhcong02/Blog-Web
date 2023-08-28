<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckUserRequest;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('Dashboard.login.index');
    }
    public function checkAdminLogin (CheckUserRequest $request){
        $data_infor = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember_pass = $request->remember ? true : false;

        if(Auth::attempt($data_infor, $remember_pass)){
            return redirect()->intended('/admin');
        }
        toastr()->timeOut(2000)
            ->addError('Tài khoản hoặc mật khẩu không đúng');
        return redirect()->back();
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
