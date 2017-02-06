@extends('rong/public/rong')
@section('content')
<div class="get">
    <div class="am-g">
        <div class="am-u-lg-12">
            <div class="get-title">
                <div class="get_font_left"><img src="{{asset('/public/rong/img/font_yjy.png')}}" alt=""></div>
                <div class="get_font_center" id="banner_num"></div>
                <div class="get_font_rigth"><img src="{{asset('/public/rong/img/font_zty.png')}}" alt=""></div>
            </div>

            <div class="font_line"><img src="{{asset('/public/rong/img/font_line.png')}}" alt=""></div>
            <p>
                <a href="###" class="am-btn am-btn-sm get-btn  am-radius banner_ios am-icon-apple"> App store</a> <a
                    href="###" class="am-btn am-btn-sm  am-radius get-btn banner_android am-icon-android"> Android</a>
            </p>
        </div>
    </div>
</div>
<div class="banner_navbg">
    <div class="am-g">
        <form action="{{url('home/index')}}" method="get" id="formType">
            <div class="banner_nav"><span class="am-icon-caret-right">  筛选：</span>
                {{csrf_field()}}
                <input type="hidden" name="typeid" value="0" id="typeid">
                <a href="javascript:;" onclick="typeget(1);" @if($msg['typeid'] && $msg['typeid']==1) class="banner_hover" @endif>亲子</a>
                <a href="javascript:;" onclick="typeget(2);" @if($msg['typeid'] && $msg['typeid']==2) class="banner_hover" @endif>家庭</a>
                <a href="javascript:;" onclick="typeget(3);" @if($msg['typeid'] && $msg['typeid']==3) class="banner_hover" @endif>美景</a>
                <a href="javascript:;" onclick="typeget(4);" @if($msg['typeid'] && $msg['typeid']==4) class="banner_hover" @endif>旅行</a>
                <a href="javascript:;" onclick="typeget(5);" @if($msg['typeid'] && $msg['typeid']==5) class="banner_hover" @endif>工作</a>

            </div>
        </form>
    </div>
</div>

<div class="am-g am-imglist">
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
  am-avg-md-3 am-avg-lg-6 am-gallery-default">
        @if(count($msg['dataList'])>0)
            @foreach($msg['dataList'] as $value)
                <li>
                    <div class="am-gallery-item am_list_block">
                        <a href="{{url('home/content')}}/{{$value->id}}" class="am_img_bg" >
                            <img class="am_img animated" src="/{{$value->picture}}" alt="{{$value->picture_name}}" />
                        </a>
                        <div class="am_listimg_info">
                            <span class="am-icon-heart"> {{$value->pop}}</span>
                            <span class="am-icon-comments"> 67</span>
                            <span class="am_imglist_time">
                                @if($value->btime > 0)
                                    {{$value->btime}}分钟前更新
                                @else
                                {{date('Y/m/d',$value->create_time)}}
                                @endif
                            </span>
                        </div>
                    </div>
                    <a class="am_imglist_user"><span class="am_imglist_user_ico"><img src="/{{$value->images}}" alt=""></span><span
                            class="am_imglist_user_font">{{$value->picture_name}}</span></a>
                </li>
            @endforeach
        @endif
    </ul>
</div>
<script>
    function typeget(id){
       var tid = $('#typeid');
        tid.val(id);
        $('#formType').submit();
    }
</script>
@endsection