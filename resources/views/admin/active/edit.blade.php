@extends('admin/public/header')
@section('content')
    <div class="tpl-content-wrapper">

        <div class="row-content am-cf">

            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl"><a style="color: #838FA1;" href="{{url('admin/active/')}}">返回列表</a></div>
                            <div class="widget-title am-fl">-></div>
                            <div class="widget-title am-fl">修改信息</div>
                            <div class="widget-function am-fr">
                                <span style="color:#a9c31e;"> 已上传相片{{$msg['count']}}张</span>
                            </div>
                        </div>
                        <div class="widget-body am-fr">
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
                            <form class="am-form tpl-form-line-form" >
                                {{--用户--}}
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="pid" value="{{$msg['dataInfo']['id']}}">

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">标题<span class="tpl-form-line-small-title">title</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="title" id="picture_name" value="{{$msg['dataInfo']['title']}}" placeholder="">
                                        <small>标题名称2-16位。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">分类 <span class="tpl-form-line-small-title">All</span></label>
                                    <div class="am-u-sm-9">

                                        <select  data-am-selected="{searchBox: 1}" id="typeid" name="type" style="display: none;">

                                            <option value="1" @if($msg['dataInfo']['typeid']==1) selected @endif>动态</option>
                                            <option value="2" @if($msg['dataInfo']['typeid']==2) selected @endif>领域</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">图片<span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img">
                                                <img id="headimg" src="/{{$msg['dataInfo']['picture']}}" width="175" alt="">
                                                <input type="hidden" name="picture" id="picture_img" value="{{$msg['dataInfo']['picture']}}">
                                            </div>

                                            <input id="doc-form-file" name="file_upload" type="file" multiple="true" accept="image/png,image/gif,image/jpeg">
                                        </div>
                                        <span style="font-size: 1.2rem;color: #00a23f;">蓉姐，对不起哦！暂不支持手机端上传相片!</span>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">内容<span class="tpl-form-line-small-title">Intro</span></label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="6" id="user-intro" name="intro" placeholder="">{{$msg['dataInfo']['content']}}</textarea>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success add_post">保存</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        <?php $timestamp = time();?>
        $(function() {
                $('#doc-form-file').uploadify({
                    'buttonText' : '图片上传',
                    'formData'     : {
                        'timestamp' : '<?php echo $timestamp;?>',
                        '_token'     : "{{csrf_token()}}"
                    },
                    'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                    'uploader' : "{{url('admin/upload')}}",
                    'onUploadSuccess' : function(file, data, response) {
                        $('input[name="picture"]').val(data);
                        $('#headimg').attr('src','/'+data);
                    }
                });
            //提交
            $('.add_post').on('click', function () {
                var pname = $('#picture_name').val();
                var pimg = $('#picture_img').val();//picture
                var pid = $('input[name="pid"]').val();//id
                var intro = $("#user-intro").val();//content
                var typeid = $("#typeid").val();//type

                if(pname =="" || pimg ==""){
                    layer.msg("标题栏或者上传图片不能为空");
                    return;
                }
                $.post("{{url('admin/active')}}/"+pid,{
                    'pname':pname,
                    'pimg' : pimg,
                    'intro':intro,
                    'type':typeid,
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                },function(data){
                    if(data.status==1052){
                        layer.msg(data.info,{time:1500},function(){
                            location.href="{{url('admin/active')}}";
                        });
                    }else{
                        layer.msg(data.info);
                    }

                });

            })
            });
    </script>
    <style>
        .uploadify{display:inline-block;}
        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
    </style>
@endsection
