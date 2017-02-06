<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Picture;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
/*
 * 相册控制基类
 * */
class AlbumController extends CommController
{
    public function __construct($config="siyezhoxuin021201")
    {
        $this->config=$config;
    }
    //照片列表
    public function index()
    {
//        dd($this->config);
        $condition=[];
        $input = Input::except('_token');
        if(!empty($input)){
            if(!empty($input['typeid'])){
                $condition=[
                    'typeid' => $input['typeid'],
                ];
            }
            if(!empty($input['picture_name'])){
                $name = $input['picture_name'];
                $condition=[['picture_name','like',"%$name%"]];
                $title =  ['picture_name'=>$name];
            }
        }
        //ajax查询分页
        $model = new Picture();
        $page = Input::get('page');
        if(empty($page)){
            $page = "1";
        }

        $dataList = $model->AjaxPage($model,10,$condition,$page);

        $msg = [
            'title' => '相册中心',
            'cate'  => $this->cate,

        ];
        if(!empty($title)){
            $msg = array_merge($msg,$dataList,$title);
        }else{
            $msg = array_merge($msg,$dataList);
        }

        return view('admin/album/album')->with('msg',$msg);

    }
    /*
     * ajax分页内容 暂时无法封装为公用方法
     * */
    public function ajaxPage()
    {
        $model = new Picture();
        $page = Input::get('page');
        if(empty($page)){
            $dataReturn = [
                'status' =>0,
                'info'   => '当前页码不存在',
            ];
            return $dataReturn;
        }else{
            $condition=[
                'is_delete'=>0
            ];
            $dataList = $model->AjaxPage($model,10,$condition,$page);
//            return $dataList;
            return view('admin/public/pagenation')->with('dataList',$dataList);
        }
    }
    //新增照片页面
    public function create()
    {
        $msg = [
            'title' => '添加照片',
            'cate'  => $this->cate
        ];
        return view('admin/album/add')->with('msg',$msg);
    }
    //新增照片操作 post
    public function store()
    {
        $input = Input::except('_token');
        if(empty($input)){
            return back()->withErrors("栏目信息提交错误");
        }else{
            $model = new Picture();
            $data = [
                'picture_name'=> $input['picture_name'],
                'picture'     => $input['picture'],
                'typeid'      => $input['typeid'],
                'intro'       => $input['intro'],
                'author'      => session('userinfo')['username'],
                'pop'         => 100,
                'create_time' => time(),
            ];
            $result = $model->create($data);
            if($result){
                return redirect('admin/album')->withErrors("照片新增成功");
            }else{
                return back()->withErrors("新增失败");
            }
        }
    }

    public function edit($id)
    {
        $dataInfo = Picture::where('is_delete',0)->find($id);
        $count = Picture::where('is_delete',0)->count();
//        dd($count);
       $msg = [
           'title' => '修改照片',
           'cate'  => $this->cate,
           'dataInfo'=>$dataInfo,
           'count'  => $count
        ];
        return view('admin/album/edit')->with('msg',$msg);
    }

    //新增照片操作 put/patch
    public function update($id)
    {
        $input = Input::except('_token');
        if(empty($input)){
            $dataReturn =[
                'status' => 400,
                'info' => '访问出错了400'
            ];
        }else{
//            $info = Picture::where('is_delete',0)->find($id);
            $data = [
                'picture_name'=>$input['pname'],
                'picture'=>$input['pimg'],
                'typeid'=>$input['typeid'],
                'intro' =>$input['intro'],
            ];
            $result = Picture::where('id',$id)->update($data);
            if($result){
                $dataReturn =[
                    'status' => 1052,
                    'info' => '数据修改成功'
                ];
            }else{
                $dataReturn =[
                    'status' => 400,
                    'info' => '数据更新失败'
                ];
            }

        }
        return $dataReturn;

    }


    //删除照片操作 delete
    public function destroy()
    {
        $input = Input::except('_token');
        return 123;
    }
    
}
