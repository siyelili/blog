<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$msg['title']}}</title>
    <meta name="description" content="For RongSister">
    <meta name="keywords" content="family">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{asset('/public/admin/assets/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('/public/admin/assets/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="{{asset('/public/admin/assets/js/echarts.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/public/admin/assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/admin/assets/css/amazeui.datatables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/public/admin/assets/css/app.css')}}">
    <script src="{{asset('/public/admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('/public/admin/assets/layer/layer.js')}}"></script>

    {{--viewer--}}
    <link rel="stylesheet" href="{{asset('/public/admin/viewer/viewer.min.css')}}">
    <script src="{{asset('/public/admin/viewer/viewer.min.js')}}"></script>
</head>
<body data-type="widgets">
<script src="{{asset('/public/admin/assets/js/theme.js')}}"></script>
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header>
        <!-- logo -->
        <div class="am-fl tpl-header-logo">
            <a href="javascript:;"><img src="{{asset('/public/admin/assets/img/logo.png')}}" alt=""></a>
        </div>
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span>
                </span>
            </div>
            <!-- 搜索 -->
            <div class="am-fl tpl-header-search">
                <form class="tpl-header-search-form" action="javascript:;">
                    <button class="tpl-header-search-btn am-icon-search"></button>
                    <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
                </form>
            </div>
            <!-- 其它功能-->
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    @if(session()->has('userinfo'))
                        <li class="am-text-sm tpl-header-navbar-welcome">
                            <a href="javascript:;">欢迎你, <span >{{session('userinfo')['username']}}</span> </a>
                        </li>
                        @endif
                                <!-- 新邮件 -->
                        <li class="am-dropdown tpl-dropdown" data-am-dropdown>
                            <a href="javascript:;" class="am-dropdown-toggle tpl-dropdown-toggle" data-am-dropdown-toggle>
                                <i class="am-icon-envelope"></i>
                                <span class="am-badge am-badge-success am-round item-feed-badge">4</span>
                            </a>
                            <!-- 弹出列表 -->
                            <ul class="am-dropdown-content tpl-dropdown-content">
                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <div class="menu-messages-ico">
                                            <img src="{{asset('/public/admin/assets/img/user04.png')}}" alt="">
                                        </div>
                                        <div class="menu-messages-time">
                                            3小时前
                                        </div>
                                        <div class="menu-messages-content">
                                            <div class="menu-messages-content-title">
                                                <i class="am-icon-circle-o am-text-success"></i>
                                                <span>夕风色</span>
                                            </div>
                                            <div class="am-text-truncate"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI 的成长，则离不开用户的支持。 </div>
                                            <div class="menu-messages-content-time">2016-09-21 下午 16:40</div>
                                        </div>
                                    </a>
                                </li>

                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <div class="menu-messages-ico">
                                            <img src="{{asset('/public/admin/assets/img/user02.png')}}" alt="">
                                        </div>
                                        <div class="menu-messages-time">
                                            5天前
                                        </div>
                                        <div class="menu-messages-content">
                                            <div class="menu-messages-content-title">
                                                <i class="am-icon-circle-o am-text-warning"></i>
                                                <span>禁言小张</span>
                                            </div>
                                            <div class="am-text-truncate"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。 </div>
                                            <div class="menu-messages-content-time">2016-09-16 上午 09:23</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="tpl-dropdown-menu-messages">
                                    <a href="javascript:;" class="tpl-dropdown-menu-messages-item am-cf">
                                        <i class="am-icon-circle-o"></i> 进入列表…
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- 退出 -->
                        <li class="am-text-sm">
                            <a href="javascript:;" onclick="logout();">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                </ul>
            </div>
        </div>

    </header>
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
    <!-- 侧边导航栏 -->
    <div class="left-sidebar">
        <!-- 用户信息 -->
        @if(session()->has('userinfo'))
            <div class="tpl-sidebar-user-panel">
                <div class="tpl-user-panel-slide-toggleable">
                    <div class="tpl-user-panel-profile-picture">
                        <img src="/{{session('userinfo')['images']}}" alt="">
                    </div>
                    <span class="user-panel-logged-in-text">
                    <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
                        {{session('userinfo')['username']}}
                    </span>
                    <a href="{{url('admin/user')}}" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
                    <br/>
                    <a href="{{url('admin/pass')}}" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 修改密码</a>
                </div>
            </div>
            @endif

                    <!-- 菜单 -->
            <ul class="sidebar-nav">
                <li class="sidebar-nav-heading">Components <span class="sidebar-nav-heading-info"> 附加组件</span></li>
                <li class="sidebar-nav-link">
                    <a href="{{url('admin/index')}}" class="active">
                        <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
                    </a>
                </li>
                @if(session('userinfo')['id'] == 1 )
                <li class="sidebar-nav-link">
                    <a href="{{url('admin/category')}}">
                        <i class="am-icon-calendar sidebar-nav-link-logo"></i> 栏目
                    </a>
                </li>
                @endif
                @foreach($msg['cate'] as $val)
                    <li class="sidebar-nav-link">
                        <a href='{{url("$val->path")}}'>
                            <i class="am-icon-calendar sidebar-nav-link-logo"></i> {{$val->type_name}}
                        </a>
                    </li>
                @endforeach
                {{--<li class="sidebar-nav-link">
                    <a href="{{url('admin/album')}}">
                        <i class="am-icon-calendar sidebar-nav-link-logo"></i> 相册
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="{{url('admin/album')}}">
                        <i class="am-icon-calendar sidebar-nav-link-logo"></i> 文章
                    </a>
                </li>--}}
                {{--<li class="sidebar-nav-link">--}}
                    {{--<a href="javascript:;" class="sidebar-nav-sub-title">--}}
                        {{--<i class="am-icon-table sidebar-nav-link-logo"></i> 相册--}}
                        {{--<span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>--}}
                    {{--</a>--}}
                    {{--<ul class="sidebar-nav sidebar-nav-sub">--}}
                        {{--<li class="sidebar-nav-link">--}}
                            {{--<a href="{{url('admin/album')}}">--}}
                                {{--<span class="am-icon-angle-right sidebar-nav-link-logo"></span> 照片列表--}}
                            {{--</a>--}}
                        {{--</li>--}}

                        {{--<li class="sidebar-nav-link">--}}
                            {{--<a href="table-list-img.html">--}}
                                {{--<span class="am-icon-angle-right sidebar-nav-link-logo"></span> 照片类型--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}


            </ul>
    </div>

@yield('content')

</div>
</div>
</body>
<script src="{{asset('/public/admin/assets/js/amazeui.min.js')}}"></script>
<script src="{{asset('/public/admin/assets/js/amazeui.datatables.min.js')}}"></script>
<script src="{{asset('/public/admin/assets/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/public/admin/assets/js/app.js')}}"></script>
{{--上传插件--}}
<script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
<script>

    function logout(){
        layer.msg('确定要离开么？', {
            time: 0 ,//不自动关闭
            btn: ['YES', 'NO'],
            yes: function(index){
                $.get("{{url('rongjie/logout')}}",{user:1052,_token:"{{csrf_token()}}"},function(data){
                    if(data.status==1052){
                        window.location.href="{{url('rongjie/login')}}";//后期需完善跳转到首页
                    }
                });
            }
        });
    }
</script>
</html>

