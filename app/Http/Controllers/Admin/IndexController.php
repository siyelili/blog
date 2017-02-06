<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\admin\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
/*
 * 系统中心控制基类
 * */
class IndexController extends CommController
{
    //个人中心
    public function index()
    {
        $msg = [
            'title' => '蓉姐的个人中心',
            'cate'  => $this->cate
        ];
        return view('admin/rong/index')->with('msg',$msg);
    }
    //登录次数查询
    public function logintimes()
    {
        $input = Input::except('_token');
        if(empty($input)){
            $msg = [
                'status' => 400,
                'info'   => '当前登录时不存在',
            ];
        }else{
            $userinfo = session('userinfo');
            $times = User::where('id',$userinfo['id'])->value('times');
            if($times){
                $msg = [
                    'status' => 1052,
                    'times'  => $times,
                ];
            }else{
                $msg = [
                    'status' => 400,
                    'info'   => '当前登录时不存在',
                ];
            }
        }
        return $msg;
    }
    //用户资料修改
    public function updateuserinfo()
    {
        $input =Input::except('_token');

        if($input){
           
            $rules = [
                'rongusername'=>'required|min:2',
                'rongrealname'=>'required|min:2',
                'intro'       =>'required'
            ];

            $message = [
                'rongusername.required'=>'用户名不能不填哦！',
                'rongusername.min'=>'用户名不能少于2位哦！',
                'rongrealname.required'=>'姓名不能不填哦！',
                'rongrealname.min'=>'姓名不能少于2位哦！',
                'intro.required'=>'蓉姐 概要不能不填哦！',
            ];
           $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $model = new User();
                $data = [
                    'username' => $input['rongusername'],
                    'nickname' => $input['rongrealname'],
                    'images'   => $input['images'],
                    'intro'    => $input['intro']
                ];
                $upResult = $model->where('id',session('userinfo')['id'])->update($data);
                if($upResult){
                    $userinfo = $model->where('id',session('userinfo')['id'])->first();
                    session(['userinfo'=>$userinfo]); //修改资料后重新生成用户session
                    return redirect('admin/user');
                }else{
                    return back()->withErrors("修改失败");
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            $msg = [
                'title' => '信息修改',
                'cate'  => $this->cate
            ];
            return view('admin/rong/user')->withMsg($msg);
        }
    }

    //头像上传
    public function imagesUpload()
    {
        $file = Input::file('Filedata');
        if($file -> isValid()){
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $uploadpath = public_path().'/uploads';
            if(!file_exists($uploadpath)) {
                mkdir($uploadpath, 0777,true);
            }
            $path = $file -> move($uploadpath,$newName);
            $filepath = 'public/uploads/'.$newName;
            return $filepath;
        }else{
            return back()->withErrors("文件上传错误！");
        }
    }

    //修改密码
    public function updatepwd()
    {
       $input = Input::except('_token');
        if($input){
            $password = preg_match('/^[0-9a-zA-Z_#]{6,16}$/',$input['pwd']);
            if(!$password){
                $msg = [
                    'status' => 400,
                    'info'   => '密码存在非法字符'
                ];
            }else{
                $uid = session('userinfo')['id'];
                $info = User::find($uid);
                $info->password = Crypt::encrypt($input['pwd']);
                $updateInfo = $info->save();
                if($updateInfo){
                    $msg = [
                        'status' => 1052,
                        'info'   => '密码修改成功啦！'
                    ];
                    session()->forget('userinfo');
                }else{
                    $msg = [
                        'status' => 400,
                        'info'   => '密码修改失败啦！'
                    ];
                }

            }
            return $msg;
        }else{
            $msg=[
                'title' =>'密码中心',
                'cate'  => $this->cate
            ];
            return view("admin/rong/updatepwd")->withMsg($msg);
        }

    }



}
