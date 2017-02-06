@extends('admin/public/header')
@section('content')
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title  am-cf">相片列表</div>
                        {{--信息提示--}}
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

                    </div>
                    <div class="widget-body  am-fr">

                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="button" class="am-btn am-btn-default am-btn-success " onclick="addurl();">
                                            <span class="am-icon-plus"></span> 新增
                                        </button>
                                        <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-save"></span> 批量上传</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{url('admin/active')}}" method="get" id="formName">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">

                                    <input type="text" name="picture_name" @if(!empty($msg['picture_name'])) value="{{$msg['picture_name']}}" @else value="" @endif class="am-form-field ">
                                    <span class="am-input-group-btn">
                                        <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search " onclick="nameFound();" type="button"></button>
                                    </span>
                                </div>
                            </div>
                        </form>

                        <div class="am-u-sm-12" id="box">
                            <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="div_img_list_c">
                                <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>标题</th>
                                    <th>图片</th>
                                    <th>作者</th>
                                    <th>类型</th>
                                    <th>人气</th>
                                    <th>内容</th>
                                    <th>发布时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($msg['data'])>0)
                                @foreach($msg['data'] as $key=>$value)
                                    <tr class="gradeX">
                                        <td class="am-text-middle">{{$key+1}}</td>
                                        <td class="am-text-middle">{{$value->title}}</td>
                                        <td>
                                            <img src="/{{$value->picture}}" class="tpl-table-line-img" alt="" data-original="/{{$value->picture}}">
                                        </td>
                                        <td class="am-text-middle">{{$value->author}}</td>
                                        <td class="am-text-middle">
                                            @if($value->type == 1)
                                                动态
                                                @elseif($value->type == 2)
                                                领域
                                            @endif
                                        </td>
                                        <td class="am-text-middle">{{$value->pop}}</td>
                                        <td class="am-text-middle">{{$value->content}}</td>
                                        <td class="am-text-middle">{{date('Y-m-d H:i',$value->create_time)}}</td>
                                        <td class="am-text-middle">
                                            <div class="tpl-table-black-operation">
                                                <a href="{{url('admin/active/'.$value->id.'/edit')}}">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="javascript:;" class="tpl-table-black-operation-del">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr><td>没有更多的数据了</td></tr>
                                @endif
                                <!-- more data -->
                                </tbody>
                            </table>
                            <div class="am-u-lg-12 am-cf">
                                {{--ajax分页--}}
                                <div class="am-fr">
                                    <div >每页显示{{$msg['rev']}}条记录 共{{$msg['count']}}条记录</div>

                                    <ul class="am-pagination tpl-pagination">
                                        <li ><a href="javascript:;" onclick="page({{$msg['prev']}})">«</a></li>
                                        @foreach($msg['pp'] as $key=>$val)
                                            @if($val == $msg['page'])
                                                <li class="am-active"><a href="javascript:;" >{{$val}}</a></li>
                                            @else
                                                <li ><a href="javascript:;" onclick="page({{$val}})">{{$val}}</a></li>
                                            @endif
                                        @endforeach
                                        <li><a href="javascript:;" onclick="page({{$msg['next']}})">»</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   function addurl(){
       location.href= "{{url('admin/active/create')}}"
   }

    $(function(){
//        图片放大
        var viewImg=new Viewer(document.getElementById('div_img_list_c'), {
            url: 'data-original'
        });
        $(".tpl-content-wrapper").click(function(e){
            var t=e.target;
            if(!t.closest("img")&&!t.closest(".viewer-footer")){
                viewImg.hide();
            }
        });

    })
//分页查询
   function page(page){
       $.ajax({
           type:"get",
           url :"{{url('admin/ajaxNewsPage')}}",
           data:{
               page:page
           },
           success:function(data){
               if(data.status==0){
                   layer.msg(data.info);
               }else{
                   $("#box").html(data);
               }
           }
       })
   }
    //类型查询
    function typeFound(){
        $('#formType').submit();
    }
   //查询
   function nameFound(){
       $('#formName').submit();
   }
   //单条删除
   function delUser(pid) {
       layer.confirm('您确定要删该管理员吗？', {
           btn: ['确定','取消'] //按钮
       }, function(){
           $.post("{{url('admin/active/')}}/"+pid,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                         console.info(data);
               if(data.status==1){
                   layer.msg(data.info,{icon:6});
                   location.reload();
               }else if(data.status == "210"){
                   layer.alert(data.info,{icon:5,title:"warnning"});
               }else{
                   layer.msg(data.info,{icon:5});
                   location.reload();
               }
           });
       }, function(){

       });
   }

</script>
@endsection