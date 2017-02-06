<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table ="category";
    protected $primaryKey='id';
    public $timestamps=false;//关闭系统框架自动时间更新
    protected $guarded=[];
}
