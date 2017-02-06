<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Comm;
use App\Http\Model\Admin\News;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

/*
 * 动态控制基类
 * */
class NewsController extends CommController
{
    //栏目列表
    public function index()
    {
        $model =new News();
        $condition = [
            'is_delete'=>0,
        ];
        $page = Input::get('page');
        if(empty($page)){
            $page = "1";
        }
        $dataList = $model->AjaxPage($model,10,$condition,$page);

        $msg = [
            'title' => '动态列表',
            'cate'  => $this->cate,

        ];
        $msg = array_merge($msg,$dataList);

        return view('admin/active/index')->with('msg',$msg);

    }



    /*
 * ajax分页内容 暂时无法封装为公用方法
 * */
    public function ajaxPage()
    {
        $model = new News();
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
            return view('admin/public/news')->with('dataList',$dataList);
        }
    }
    //添加页面
    public function create(){
        $msg = [
            'title' => '添加',
            'cate'  => $this->cate,
        ];
        return view('admin/active/add')->withMsg($msg);
    }
    //新增操作 post
    public function store()
    {
        $input = Input::except('_token');
//        dd($input);
        if(empty($input)){
            return back()->withErrors("栏目信息提交错误");
        }else{
            $model = new News();
            $data = [
                'title'       => $input['title'],
                'picture'     => $input['picture'],
                'type'        => $input['type'],
                'content'     => $input['content'],
                'author'      => session('userinfo')['username'],
                'pop'         => 100,
                'create_time' => time(),
            ];
            $result = $model->create($data);
            if($result){
                return redirect('admin/active')->withErrors("新增成功");
            }else{
                return back()->withErrors("新增失败");
            }
        }
    }
//修改页面
    public function edit($id)
    {
        $dataInfo = News::where('is_delete',0)->find($id);
        $count = News::where('is_delete',0)->count();
        $msg = [
            'title' => '修改',
            'cate'  => $this->cate,
            'dataInfo'=>$dataInfo,
            'count'  => $count
        ];
        return view('admin/active/edit')->with('msg',$msg);
    }

    //新增操作 put/patch
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
                'title'=>$input['pname'],
                'picture'=>$input['pimg'],
                'type'=>$input['type'],
                'content' =>$input['intro'],
            ];
            $result = News::where('id',$id)->update($data);
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


}
