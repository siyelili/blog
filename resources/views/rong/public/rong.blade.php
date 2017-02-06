<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$msg['title']}}</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('/public/rong/css/amazeui.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/rong/css/petshow.css?6')}}">
    <link rel="stylesheet" href="{{asset('/public/rong/css/animate.min.css')}}">
    <script src="{{asset('/public/rong/js/jquery.min.js')}}"></script>
    <script src="{{asset('/public/rong/js/amazeui.min.js')}}"></script>
    <script src="{{asset('/public/rong/js/countUp.min.js')}}"></script>
    <script src="{{asset('/public/rong/js/amazeui.lazyload.min.js')}}"></script>
    <script src="{{asset('/public/admin/assets/layer/layer.js')}}"></script>
</head>
<body>
<header class="am-topbar am-topbar-inverse">
    <div class="amz-container">
        <h1 class="am-topbar-brand">
            <a href="#" class="am-topbar-logo">
                <img src="{{asset('/public/rong/img/logo.png?1')}}" alt="">
            </a>
        </h1>
        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
                data-am-collapse="{target: '#doc-topbar-collapse-5'}">
            <span class="am-sr-only">
                导航切换
            </span>
            <span class="am-icon-bars">
            </span>
        </button>
        <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse-5">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li @if(empty($cid)) class="am-active"@endif>
                    <a href="{{url('/')}}">
                        首页
                    </a>
                </li>
                @foreach($msg['cate'] as $value)
                    @if(!empty($cid))
                        <li @if($cid == $value->id) class="am-active" @endif>
                            <a   href="{{url($value->homepath)}}/{{$value->id}}">
                                {{$value->type_name}}
                            </a>
                        </li>
                    @else
                        <li >
                            <a   href="{{url($value->homepath)}}/{{$value->id}}">
                                {{$value->type_name}}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</header>

@yield('content')

<footer class="am_footer">
    <div class="am_footer_con">

        <div class="am_footer_don">
            <span>唯美似夏花</span>
            <dl>
                <dt><img src="{{asset('/public/rong/img/footdon.png?1')}}" alt=""></dt>
                <dd>一起Show我们的爱宠吧！宠物秀是图片配文字、涂鸦、COSPLAY的移动手机社区，这里有猫狗鱼龟兔子仓鼠龙猫等各种萌图。
                    <a href="###" class="footdon_pg ">
                        <div class="foot_d_pg am-icon-apple "> App store</div>
                    </a><a href="###" class="footdon_az animated">
                        <div class="foot_d_az am-icon-android "> Android</div>
                    </a></dd>

            </dl>
        </div>

        <div class="am_footer_erweima">
            <div class="am_footer_weixin"><img src="{{asset('/public/rong/img/wx.jpg')}}" alt="">

                <div class="am_footer_d_gzwx am-icon-weixin"> 关注微信</div>
            </div>
            <div class="am_footer_ddon"><img src="{{asset('/public/rong/img/wx.jpg')}}" alt="">

                <div class="am_footer_d_dxz am-icon-cloud-download"> 扫码下载</div>
            </div>

        </div>

    </div>
    <div class="am_info_line">Copyright(c)2015 <span>PetShow</span> All Rights Reserved</div>
</footer>

</body>
</html>