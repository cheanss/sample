<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        // 验证用户提交数据
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed',
        ]);

        // 创建用户并写入数据库
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // 用户注册成功后自动登录
        Auth::login($user);
        // 提示语，flash 第一个参数和 bootstrap 的类进行结合提示成功样式语句
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        // 跳转到用户详情页
        return redirect()->route('users.show', [$user]);
    }
}
