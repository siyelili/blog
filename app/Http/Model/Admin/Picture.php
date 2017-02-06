<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;
/*
 * 图片类型
 * */
class Picture extends Comm
{
    //
    protected $table ="picture";
    protected $primaryKey='id';
    public $timestamps=false;//关闭系统框架自动时间更新
    protected $guarded=[];
}
