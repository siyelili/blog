@extends('admin/public/header')
@section('content')
    <div class="tpl-content-wrapper">

        <div class="row-content am-cf">

            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl"><a style="color: #838FA1;" href="{{url('admin/album/')}}">返回列表</a></div>
                            <div class="widget-title am-fl">-></div>
                            <div class="widget-title am-fl">修改照片信息</div>
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
                                    <label for="user-name" class="am-u-sm-3 am-form-label">照片名称<span class="tpl-form-line-small-title">name</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="picture_name" id="picture_name" value="{{$msg['dataInfo']['picture_name']}}" placeholder="">
                                        <small>照片名称2-16位。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">照片分类 <span class="tpl-form-line-small-title">All</span></label>
                                    <div class="am-u-sm-9">

                                        <select  data-am-selected="{searchBox: 1}" id="typeid" name="typeid" style="display: none;">

                                            <option value="1" @if($msg['dataInfo']['typeid']==1) selected @endif>亲子</option>
                                            <option value="2" @if($msg['dataInfo']['typeid']==2) selected @endif>家庭</option>
                                            <option value="3" @if($msg['dataInfo']['typeid']==3) selected @endif>美景</option>
                                            <option value="4" @if($msg['dataInfo']['typeid']==4) selected @endif>旅行</option>
                                            <option value="5" @if($msg['dataInfo']['typeid']==5) selected @endif>工作</option>
                                            <option value="6" @if($msg['dataInfo']['typeid']==6) selected @endif>其他</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">照片上传<span class="tpl-form-line-small-title">Images</span></label>
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
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">照片简介<span class="tpl-form-line-small-title">Intro</span></label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="6" id="user-intro" name="intro" placeholder="旅途美景">{{$msg['dataInfo']['intro']}}</textarea>
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
                var pimg = $('#picture_img').val();
                var pid = $('input[name="pid"]').val();
                var intro = $("#user-intro").val();
                var typeid = $("#typeid").val();

                if(pname =="" || pimg ==""){
                    layer.msg("标题栏或者上传图片不能为空");
                    return;
                }
                $.post("{{url('admin/album')}}/"+pid,{
                    'pname':pname,
                    'pimg' : pimg,
                    'intro':intro,
                    'typeid':typeid,
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                },function(data){
                    if(data.status==1052){
                        layer.msg(data.info,{time:1500},function(){
                            location.href="{{url('admin/album')}}";
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
