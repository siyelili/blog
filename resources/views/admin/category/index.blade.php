@extends('admin/public/header')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">栏目列表</div>
                    </div>


                    <div class="widget-body  am-fr">
                        {{-- form 信息提示--}}
                        @if(count($errors)>0)
                            <span style="font-size:12px;color:orangered;">
                                    @if(is_object($errors))
                                    @foreach($errors->all() as $error)
                                        {{$error}}
                                    @endforeach
                                @else
                                    {{$errors}}
                                @endif
                                </span>
                        @endif

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success " onclick="addurl();">
                                            <span class="am-icon-plus"></span> 新增
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="am-u-sm-12">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>栏目标题</th>
                                    <th>时间</th>
                                    <th>是否显示</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($msg['dataList'] as $value)
                                <tr class="gradeX">
                                    <td class="am-text-middle">{{$value->id}}</td>
                                    <td class="am-text-middle">{{$value->type_name}}</td>
                                    <td class="am-text-middle">{{date('Y-m-d H:i',$value->create_time)}}</td>
                                    <td class="am-text-middle">
                                        @if($value->status == 1)
                                        显示
                                            @else
                                        不显示
                                            @endif
                                    </td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="{{url('admin/category/'.$value->id.'/edit')}}">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a href="javascript:;" onclick="delCat({{$value->id}});" class="tpl-table-black-operation-del">
                                                <i class="am-icon-trash"></i> 删除
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                {{--<tr class="even gradeC">--}}

                                <!-- more data -->
                                </tbody>
                            </table>
                        </div>
                        {{--<div class="am-u-lg-12 am-cf">--}}
                            {{--<div class="am-fr">--}}
                                {{--<ul class="am-pagination tpl-pagination">--}}
                                    {{--<li class="am-disabled"><a href="#">«</a></li>--}}
                                    {{--<li class="am-active"><a href="#">1</a></li>--}}
                                    {{--<li><a href="#">2</a></li>--}}
                                    {{--<li><a href="#">3</a></li>--}}
                                    {{--<li><a href="#">4</a></li>--}}
                                    {{--<li><a href="#">5</a></li>--}}
                                    {{--<li><a href="#">»</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //添加
   function addurl(){
       location.href= "{{url('admin/category/create')}}"
   }
   //删除
    function delCat(cid){
        $.post("{{url('admin/category/')}}/"+cid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {

            if(data.status==1){
                layer.msg(data.msg,{time:1500},function(){
                    location.href = location.href;
                });
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    }
</script>
@endsection