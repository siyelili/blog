<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
/*
 * 栏目分类控制基类
 * */
class CategoryController extends CommController
{
    //栏目列表
    public function index()
    {
//        $user = Crypt::encrypt("siyezhouxin");
//        dd($user);
        $dataList = Category::where('is_delete',0)->get();
        $msg = [
            'title' => '栏目中心',
            'dataList' =>$dataList,
            'cate'  => $this->cate
        ];
        return view('admin/category/index')->with('msg',$msg);

    }
    //新增栏目页面
    public function create()
    {
        $msg = [
            'title' => '添加栏目',
            'cate'  => $this->cate
        ];
        return view('admin/category/add')->with('msg',$msg);
    }
    //新增栏目操作 post
    public function store()
    {
        $input = Input::except('_token');
        if(empty($input)){
            return back()->withErrors("栏目信息提交错误");
        }else{
            $model = new Category();
            if(empty($input['status'])){
                $input['status'] = 0;
            }
            $data = [
                'type_name' => $input['type_name'],
                'status'    => $input['status'],
                'path'      => $input['path'],
                'create_time' => time(),
            ];
            $result = $model->create($data);
            if($result){
                return redirect('admin/category')->withErrors("栏目新增成功");
            }else{
                return back()->withErrors("栏目信息新增失败");
            }
        }
        return $input;
    }
    //更新栏目页面
    public function edit($id)
    {
        $dataInfo = Category::where('is_delete',0)->find($id);
        $msg = [
            'title' => '修改照片',
            'dataInfo' => $dataInfo,
            'cate'  => $this->cate
        ];
        return view('admin/category/edit')->with('msg',$msg);
    }

    //更新栏目操作 put/patch
    public function update($id)
    {
        $input = Input::except('_token');
//        return $input;
        if(empty($input)){
            return back()->withErrors("栏目信息提交错误");
        }else{
            $info = Category::find($id);
            if(empty($input['status'])){
                $input['status'] = 0;
            }
            $info->type_name= $input['type_name'];
            $info->path = $input['path'];
            $info->status = $input['status'];
            $resuful = $info->save();
            if($resuful){
                return redirect('admin/category')->withErrors('信息修改成功');
            }else{
                return back()->withErrors("栏目信息修改失败");
            }
        }

    }

    //删除删除 delete
    public function destroy($id)
    {
        $input = Input::except('_token');
        $re = Category::where('id',$id)->delete();
        if($re){
            $data = [
                'status' => 1,
                'msg' => '栏目删除成功！',
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '栏目删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
}
