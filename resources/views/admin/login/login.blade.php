<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$msg['title']}}</title>
    <meta name="description" content="">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{asset('public/admin/assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('/public/admin/assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="{{asset('/public/admin/assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/admin/assets/css/amazeui.datatables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/admin/assets/css/app.css')}}">
    <script src="{{asset('/public/admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('/public/admin/assets/layer/layer.js')}}"></script>

</head>
<style>
    .layui-layer {
        left:0;
    }
</style>
<body data-type="login">
    <script src="{{asset('/public/admin/assets/js/theme.js')}}"></script>
    <div class="am-g tpl-g">
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>

        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">
                </div>
                {{--错误信息--}}
                @if(session()->has('error'))
                <span style="font-size: 12px;color:orangered;">{{session('error')}}</span>
                @endif
                <form class="am-form tpl-form-line-form" id="loginform" action="{{url('rongjie/dologin')}}">
                    <div class="am-form-group">
                        <input type="text" class="tpl-form-input" id="user-name" name="rongusername" placeholder="请输入专属账号">
                    </div>

                    <div class="am-form-group">
                        <input type="password" class="tpl-form-input" id="user-password" name="rongpassword" placeholder="请输入专属密码">
                    </div>

                    <div class="am-form-group">
                        <input type="text" class="tpl-form-input" id="user-code" name="rongcode" placeholder="请输入验证码">
                    </div>
                    <div class="am-form-group">
                        <img src="{{url('rongjie/verify')}}" onclick="this.src='{{url('rongjie/verify')}}?'+Math.random()" />
                        <span style="font-size: 12px">如看不清验证码，请蓉姐点击刷新哦！</span>
                    </div>

                    {{--<div class="am-form-group tpl-login-remember-me">--}}
                        {{--<input id="remember-me" type="checkbox" name="rongremember" checked value="">--}}
                        {{--<label for="remember-me">--}}
                            {{--记住密码--}}
                         {{--</label>--}}
                    {{--</div>--}}

                    <div class="am-form-group">
                        <button type="button" onclick="loginAjax();" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('/public/admin/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('/public/admin/assets/js/app.js')}}"></script>
    <script>
        $(function(){
            layer.msg('Welcome to individual center, there is only one account for a friend. Do not open to the public.<br>', {
                time: 5000, //10s后自动关闭
                btn: ['I do']
            })
        });
        function loginAjax(){
            var username = $('#user-name').val();
            var password = $('#user-password').val();
            var code     = $('#user-code').val();
            if(username.length<2){
                layer.msg("蓉姐，您的账号输入有点小问题。至少要输入2位以上的账户哦！",{
                    btn: ['I do']
                })
                return;
            }
            if(password.length<6){
                layer.msg("蓉姐，您的密码输入有点小问题。至少要输入6位以上的密码哦！",{
                    btn: ['I do']
                });
                return;
            }
            if(code.length != 4){
                layer.msg("蓉姐，您的验证码输入有点小问题。验证码是四位哦！",{
                    btn: ['I do']
                });
                return;
            }
            $.post($("form").attr('action'),{username:username,password:password,code:code,_token :"{{csrf_token()}}"},function(msg){
                console.info(msg);
                if(msg.status==400){
                    layer.msg(msg.info);
                }else if(msg.status==1052){
                    window.location.href = "{!! url('admin/index') !!}";
                }
            });

        }
    </script>
</body>

</html>