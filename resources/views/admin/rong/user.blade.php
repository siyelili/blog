@extends('admin/public/header')
@section('content')
    <div class="tpl-content-wrapper">

        <div class="row-content am-cf">

            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">{{session('userinfo')['username']}}&nbsp;&nbsp;个人资料</div>
                            <div class="widget-function am-fr">
                                <span style="color:#a9c31e;"> 登录次数 {{session('userinfo')['times']}}次</span>
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
                            <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/user')}}">
                                {{--用户--}}
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">用户名<span class="tpl-form-line-small-title">username</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="rongusername" id="user-name" value="{{session('userinfo')['username']}}" placeholder="">
                                        <small>用户名(字母)2-16位。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">真实姓名<span class="tpl-form-line-small-title">realname</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"  name="rongrealname" value="{{session('userinfo')['nickname']}}" id="user-name" placeholder="">
                                        <small>真实姓名2-8位。</small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-weibo" class="am-u-sm-3 am-form-label">头像 <span class="tpl-form-line-small-title">Images</span></label>
                                    <div class="am-u-sm-9">
                                        <div class="am-form-group am-form-file">
                                            <div class="tpl-form-file-img">
                                                <img id="headimg" src="/{{session('userinfo')['images']}}" width="175" alt="">
                                                <input type="hidden" name="images" value="{{session('userinfo')['images']}}">
                                            </div>
                                            {{--<button type="button" class="am-btn am-btn-danger am-btn-sm">--}}
                                                {{--<i class="am-icon-cloud-upload"></i> 选择图片</button>--}}
                                            <input id="doc-form-file" name="file_upload" type="file" multiple="true" accept="image/png,image/gif,image/jpeg">
                                        </div>
                                        <span style="font-size: 1.2rem;color: #00a23f;">蓉姐，对不起哦！暂不支持手机端修改头像!</span>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">蓉姐概要<span class="tpl-form-line-small-title">Intro</span></label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="6" id="user-intro" name="intro" placeholder="蓉姐的辉煌">{{session('userinfo')['intro']}}</textarea>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存</button>
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
                        console.info(data);
                        $('input[name="images"]').val(data);
                        $('#headimg').attr('src','/'+data);
                    }
                });
            });
    </script>
    <style>
        .uploadify{display:inline-block;}
        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}

    </style>
@endsection
