<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
require_once 'resources/org/code/Code.class.php';
/*
 * 公共控制基类
 * */
class CommController extends Controller
{

    public function __construct()
    {
        //栏目信息
        $condition = [
            'is_delete'=>0,
            'status' => 1,
        ];
        $dataList = Category::where($condition)->get();
        $this->cate = $dataList;
    }

    //验证码生成函数
    public function Verify()
    {
        $code = new \Code($codeLen=6);
        $fourcode = session('code'); //若存在code则销毁
        if($fourcode){
            session_unset('code');
        }
        $fourcode = $code->make();
        return $fourcode;
    }
    //返回验证码
    public function confirmVerify()
    {
        $code = new \Code($codeLen=6);
        $fourcode = $code->get();
        return $fourcode;
    }





}
