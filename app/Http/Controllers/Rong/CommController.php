<?php

namespace App\Http\Controllers\Rong;

use App\Http\Model\Admin\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommController extends Controller
{
    //
    public function __construct()
    {
        $model = new Category();
        $cate = $model->where('status',1)->orderBy('id','asc')->get();
        $this->cate = $cate;
    }
}
