<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index(){
        $users=User::all();
        //return view('user.index',['users'=>$users]);
        return view('Admin.user.index', compact('users'));
    }
    public function add(){
        return view('Admin/user/add');

    }
    public function update(User $user,Request $request){
        $this->validate($request, [
            'name' => 'required|min:2|max:6',
            'email' => 'email',
            'password' => [
                'required',
                'regex:/^\d{6}$/'
            ],
            'head' => 'required'
        ],
            [//错误信息展示
                'name.required'=>'用户名不能为空',
                'name.min'=>'用户名长度不能小于两位数',
                'name.max'=>'用户名最大长度为6',
                'email'=>'邮箱格式不正确',
                'password.required'=>'密码不能为空',
                'password.regex'=>'密码长度不能小于6位数',
                'head.required'=>'头像不能为空'
            ]);
            $user->update($request->input());
        session()->flash('success','修改用户信息成功');
        return redirect()->route('Admin.user.index');


    }
    public function edit(User $user){

        return view('Admin.user.edit',compact('user'));
    }
    public function delete(User $user){
        $user->delete();
        session()->flash('success',$user->name.'被删除成功');
        return redirect()->route('Admin.user.index');
    }
    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required|min:2|max:6',
            'email' => 'email',
            'password' => [
                'required',
                'regex:/^\d{6}$/'
        ],
            'head' => 'required',
            'captcha' => 'required|captcha'
        ],
            [//错误信息展示
                'name.required'=>'用户名不能为空',
                'name.min'=>'用户名长度不能小于两位数',
                'name.max'=>'用户名最大长度为6',
                'email'=>'邮箱格式不正确',
                'password.required'=>'密码不能为空',
                'password.regex'=>'密码长度不能小于6位数',
                'head.required'=>'头像不能为空',
                 'captcha.required'=> '验证码不能为空',
                'captcha.captcha'=> '请输入正确的验证码'

            ]);


        $user=new user();
        $user->name = $request->name;

        $user->email =$request->email;
        $user->password =$request->password;
        $user->save();
        //操作成功后的信息显示
        session()->flash('success','用户添加成功');
        return redirect()->route('Admin.user.index');

    }


}
