<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\admin\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
/*
 * 登录控制基类
 * */
class LoginController extends CommController
{
    //登录页面
    public function login()
    {
//        dd(Crypt::encrypt("hurong"));

        $msg = [
            'title' => '登录中心',
        ];
        return view('admin/login/login')->withMsg($msg);
    }
    //执行登录方法
    public function doLogin()
    {
        $input = Input::except('_token');
        if(empty($input)){
            $msg = [
                'status' => 400,
                'info'   => '非法访问数据来源！'
            ];
        }else{
            $code = $input['code'];
            $fourcode = $this->confirmVerify();
            if($fourcode != strtoupper($code)){
                $msg = [
                    'status' => 400,
                    'info'   => '验证码填错啦！',
                ];
            }else{
                $model = new User();
                $condition = [
                    'is_delete'=> 0,
                    'username' => $input['username'],
                ];
                $userinfo = $model->where($condition)->first();
//                $confirmpwd = sha1(md5($input['password'])); //加密规则sha1 md5
                $confirmpwd = Crypt::decrypt($userinfo['password']);
                if(!$userinfo || $confirmpwd != $input['password']){
                    $msg = [
                        'status' => 400,
                        'info'   => '蓉姐，密码错了!忘记密码请找我哦！',
                    ];
                }else{
                    session(['userinfo' => $userinfo]);
                    $where = [
                        'last_login_time' => time(),
                        'times'           => $userinfo['times']+1,
                    ];
                    $model->where('id',$userinfo['id'])->update($where);
                    $msg = [
                        'status' => 1052,
                        'info'   => '欢迎您回来，蓉姐',
                    ];
                }
            }
        }
        return $msg;
    }
   //登出 退出
    public function logout()
    {
       session()->flush();
       if(!session()->has('userinfo')){
        $msg = [
            'status' => 1052,
        ];
        }else{
            $msg = [
                'status' => 400,
            ];
        }
        return $msg;
    }
    
}
