@extends('rong/public/rong')
@section('content')
<div class="am_user">
<div class="am_user_head">
<div class="am_user_head_content">
    <div class="am_user_head_l">
<div class="am_user_head_l_ico"> <img src="/{{$userinfo['images']}}" style="width: 65px;height: 65px" alt=""></div>
<div class="am_user_head_l_ico_info">
    <span class="am_user_head_l_name">{{$userinfo['username']}}</span>
    <span class="am_user_head_l_map"><i class="am-icon-map-marker"></i> 四川绵阳</span>
</div>
    </div>
    <div class="am_user_head_r">
<div class="am_user_head_r_tag">
<div class="am_user_head_l_ico_info_ti">已发布<span class="cff5656">{{$userinfo['count']}}</span>张照片</div>
<span>
    <i class="am-icon-star"></i> 粉丝：<span class="am_user_head_unm">459</span>
</span>
<span>
    <i class="am-icon-user"></i> 关注：<span class="am_user_head_unm">278</span>
</span>
<span>
    <i class="am-icon-heart"></i>被喜欢：<span class="am_user_head_unm">{{$userinfo['pop']}}</span>
</span>
</div>
    </div>
    </div>
</div>
<div class="am-g am-imglist am_user_list_li">
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
  am-avg-md-3 am-avg-lg-6 am-gallery-default">
        <li>
            <div class="am-gallery-item am_list_block">
                <a href="###" class="am_img_bg">
                    <img class="am_img animated" src="{{asset('/public/rong/img/loading.gif')}}" alt="远方 有一个地方 那里种有我们的梦想"/>
                </a>

                <div class="am_listimg_info"><span class="am-icon-heart"> 132</span><span
                        class="am-icon-comments"> 67</span><span class="am_imglist_time">15分钟前</span></div>

            </div>

        </li>

    </ul>
</div>
</div>

<script>
console.log($.AMUI);
 $(function(){
  if ($(window).width() < 600 ) {
 $('.am_list_item_text').each(
  function(){
     if($(this).text().length >= 26){
        $(this).html($(this).text().substr(0,26)+'...');
     }});}[]

});

</script>
@endsection