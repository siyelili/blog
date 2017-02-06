<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Comm extends Model
{
    /*
    * @param $model 当前模型
    * @param $pageNum 每页显示条数
    * @param $pageNow 当前页码
    * @param $condition 查询条件
    * @param $field 根据某字段排序
    * @param $order 排序方式 asc desc
    * @return Array
    * */
        public function AjaxPage($model,$pageNum=10,$condition=['is_delete'=>0],$pageNow=1,$field="id",$order="desc")
        {
            //1、查询数据库总条数
            $count = count($model->where($condition)->orderBy($field,$order)->get());
    //2、设置每页显示条数
            $rev = $pageNum;
    //3、求总页数
            $sums = ceil($count/$rev);
    //4、当前前页
            $page = $pageNow;
    //5、设置上一页、下一页
            $prev = ($page-1)>0?$page-1:1;
            $next = ($page+1)<$sums?$page+1:$sums;
    //6、求偏移量
            $offset = ($page-1)*$rev;
    //7、sql查询数据库
            $data= $model->where($condition)->orderBy($field,$order)->take($rev)->skip($offset)->get();
    //8、数字分页
            $pp = array();
            for($i=1;$i<=$sums;$i++){
                $pp[$i]=$i;
            }
            $array = ['data'=>$data,'rev'=>$rev,'prev'=>$prev,'next'=>$next,'sums'=>$sums,'pp'=>$pp,'page'=>$page,'count'=>$count];
            return $array;
        }
}
