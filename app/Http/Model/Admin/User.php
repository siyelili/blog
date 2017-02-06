<?php

namespace App\Http\Model\admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table ="user";
    protected $primaryKey='id';
    public $timestamps=false;//关闭系统框架自动时间更新
    protected $guarded=[];
}
