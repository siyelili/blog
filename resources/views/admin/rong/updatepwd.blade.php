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
                            <form class="am-form tpl-form-line-form" method="post" action="{{url('admin/pass')}}">
                                {{--用户--}}
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">新密码<span class="tpl-form-line-small-title">new password</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="password" id="user-name" value="" placeholder="">
                                        <small>密码长度为6-16位。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">确认密码<span class="tpl-form-line-small-title">confirm password</span></label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input"  name="confirmpassword" value="" id="user-name" placeholder="">
                                        <small>密码长度为6-16位。</small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" onclick="updatepwd();" class="am-btn am-btn-primary tpl-btn-bg-color-success ">保存</button>
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
        function updatepwd(){
            var password = $("input[name='password']").val();
            var comfirmpwd = $("input[name='confirmpassword']").val();
            var rule=/^[0-9a-zA-Z_#]{6,16}$/;
            if(!rule.test(password)){
                layer.msg("新密码位数不足",{
                    time:1500,
                });
                return;
            }
            if(password !== comfirmpwd){
                layer.msg("两次输入密码不同哟！",{
                    time:1500,
                });
                return;
            }
            $.post("{{url('admin/pass')}}",{pwd:password,_token:"{{csrf_token()}}"},function(data){
//                console.info(data);return;
                if(data.status==1052){
                    layer.msg(data.info+"请重新登录",{time:3000}, function () {
                        location.href =location.href;
                    });
                }else{
                    layer.msg(data.info,{time:1500});
                }
            })

        }
    </script>

@endsection
