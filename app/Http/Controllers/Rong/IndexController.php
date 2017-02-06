<?php

namespace App\Http\Controllers\Rong;

use App\Http\Model\Admin\Picture;
use App\Http\Model\admin\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

class IndexController extends CommController
{
    //用户中心
    public function user()
    {
        $uid = 4;//特定id
        $userinfo = User::find($uid);
        $userinfo['count'] = Picture::count();//照片张数
        $userinfo['pop'] = Picture::where('is_delete',0)->sum('pop');//关注人数



        $msg = [
            'title' => '博客首页',
            'cate' => $this->cate,
        ];
        return view('rong/user/user')->with('msg',$msg)->with('userinfo',$userinfo);

    }
    //找照片列表
    public function index($cid=0)
    {

        $model = new Picture();
        $input = Input::except('_token');
        if(!empty($input['typeid'])){
            $condition = [
                'is_delete' =>0,
                'typeid' =>$input['typeid'],
            ];
        }else{
            $input['typeid'] = 0;
            $condition = [
                'is_delete' =>0,
            ];
        }

        $dataList = $model->where($condition)->orderBy('id','desc')->get();
        foreach($dataList as $key=>$value){
            $images = User::where('username',$value['author'])->first(['images']);
            $dataList[$key]['images'] = $images['images'];
            $resttime =time()-$value['create_time'];
            if($resttime < 3600){
                $dataList[$key]['btime'] = ceil($resttime/60);
            }else{
                $dataList[$key]['btime'] = 0;
            }
        }
        $msg = [
            'title' => '照片列表',
            'dataList' => $dataList,
            'cate' => $this->cate,
            'typeid' => $input['typeid'],
        ];

        return view('rong/index/index')->with('msg',$msg)->with('cid',$cid);
    }

    //图片内容页
    public function imageContent($pid)
    {
        $info = Picture::where('id',$pid)->first();
        //判断是否范文出错
        if(!$info){
            return redirect('home/index');
        }
        $images = User::where('username',$info['author'])->first(['images']);
        $info['images'] = $images['images'];
        $resttime =time()-$info['create_time'];
        if($resttime < 3600){
            $info['btime'] = ceil($resttime/60);
        }else{
            $info['btime'] = 0;
        }
        $msg = [
            'title' => '照片详情',
            'cate' => $this->cate,
            'dataInfo' => $info,
        ];
        return view('rong/index/image')->withMsg($msg);
    }



}
