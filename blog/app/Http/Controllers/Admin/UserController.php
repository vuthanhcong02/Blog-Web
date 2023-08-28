<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CheckUserRegisterRequest;
use App\Http\Requests\CheckUserChangeProfileRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->search ?? '';
        if($keyword != ''){
            $list_users = User::where('name', 'like', '%'.$keyword.'%')
                            ->orWhere('email', 'like', '%'.$keyword.'%')
                            ->orWhere('role', 'like', '%'.$keyword.'%')
                            ->orderBy('id', 'desc')->paginate(5);
        }
        else{
            $list_users = User::where('role', '!=', 'admin')
            ->orderBy('id', 'desc')->paginate(5);
        }
        return view('Dashboard.user.index',compact('list_users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CheckUserRegisterRequest $request)
    {
        //
        $data_infor = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'user',
        ];
        User::create($data_infor);
        // toastr()->success('Thêm mới thành công');
        return redirect()->route('users.index')->with('success','Thêm mới người dùng thành công');
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
        $user =  User::findOrFail($id);
        return view('Dashboard.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CheckUserChangeProfileRequest $request, string $id)
    {
        //
        if(($request->password!=null)){
            $data_infor = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role ?? 'user',
            ];
        }
        else{
            $data_infor = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role ?? 'user',
            ];
        }
        User::where('id',$id)->update($data_infor);
        return redirect()->route('users.index')->with('success','Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::destroy($id);
        return redirect()->route('users.index')->with('success','Xóa người dùng thành công');
    }
}
