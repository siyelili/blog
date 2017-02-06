@extends('admin/public/header')
@section('content')
    <div class="tpl-content-wrapper">

        <div class="row-content am-cf">

            <div class="row">

                <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                    <div class="widget am-cf">
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl"><a style="color: #838FA1;" href="{{url('admin/category')}}">返回列表</a></div>
                            <div class="widget-title am-fl">-></div>
                            <div class="widget-title am-fl">修改栏目栏目</div>

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
                            <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/category/'.$msg['dataInfo']->id.'')}}">
                                {{--用户--}}
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">栏目名称<span class="tpl-form-line-small-title">title</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="type_name" id="type_name" value="{{$msg['dataInfo']->type_name}}" placeholder="">
                                        <small>栏目名称2-16位。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">栏目隐藏</label><span class="tpl-form-line-small-title">show/hidden</span>
                                    <div class="am-u-sm-9">
                                        <div class="tpl-switch">

                                                <input type="checkbox" name="status" value="1" class="ios-switch bigswitch tpl-switch-btn"
                                                       @if($msg['dataInfo']->status == 1)
                                                        checked=""
                                                        @endif
                                                >

                                            <div class="tpl-switch-btn-view">
                                                <div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">路由<span class="tpl-form-line-small-title">path</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="path" id="path" value="{{$msg['dataInfo']->path}}" placeholder="">
                                        <small>栏目名称2-16位。</small>
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
        $('.add_post').on('click', function () {
            var tyname = $('#type_name').val();
            var path = $('#path').val();
            if(tyname =="" || path ==""){
                layer.msg("标题栏或者路由不能为空");
                return;
            }
            $("form").submit();
        })

    </script>

@endsection
