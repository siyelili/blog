@extends('rong/public/rong')
@section('content')
<div class="am_tuya">
    <div class="am_tuya_user">
        <div class="am_tuya_user_ico"><img src="/{{$msg['dataInfo']['images']}}" alt="" ></div>
        <div class="am_tuya_user_info">
              <div class="am_tuya_user_info_name">{{$msg['dataInfo']['picture_name']}}</div>
              <div class="am_tuya_user_info_coordinate">
                  <span class="am_tuya_user_info_time">
                      @if($msg['dataInfo']['btime']>0)
                        {{$msg['dataInfo']['btime']}}分钟前更新
                      @else
                          时间:{{date('Y/m/d',$msg['dataInfo']['create_time'])}}
                      @endif
                  </span>
                  类型:
                  @if($msg['dataInfo']['typeid'] == 1)
                      亲子
                  @elseif($msg['dataInfo']['typeid'] == 2)
                      家庭
                  @elseif($msg['dataInfo']['typeid'] == 3)
                      美景
                  @elseif($msg['dataInfo']['typeid'] == 4)
                      旅行
                  @elseif($msg['dataInfo']['typeid'] == 5)
                      工作
                  @elseif($msg['dataInfo']['typeid'] == 6)
                      其他
                  @endif
              </div>
        </div>
    </div>

    <div class="am_tuya_content">
          <div class="am_tuya_content_l">
              <div class="am_albums">
                <img src="/{{$msg['dataInfo']['picture']}}" alt="" style="width: 100%" >
              </div>
              <div class="am_tuya_more">
                <div class="am_tuya_oneword">介绍：{{$msg['dataInfo']['intro']}}</div>
                <div class="am_tuya_comment">
              <div class="am_tuya_comment_user">
                <div class="am_tuya_comment_user_l">
            <img src="{{asset('public/rong/img/kj.png')}}" alt="">我是超级小短腿柯基 <span>  •  15分钟前</span>
                </div>
                <div class="am_tuya_comment_user_r">新疆维吾尔自治区 哈萨克自治州
                </div>
            <div class="am_tuya_comment_text">站酷9周年，突然发现自己的酷龄已经8岁。回忆点滴，设计路漫漫，有你相伴。</div>
                </div>
              </div>
              </div>
              <div class="am_news_load"><span><i  class="am-icon-spinner am-icon-spin"></i> 查看更多讨论</span></div>
          </div>
        <div class="am_tuya_content_r">
    <ul class="am_tuya_r_info">
      <li><i class="am-icon-heart"></i><span>{{$msg['dataInfo']['pop']}} 人喜欢</span></li>
      <li><i class="am-icon-comments"></i><span>4 条讨论</span></li>
      <li><i class="am-icon-comments"></i><span>作者&nbsp;{{$msg['dataInfo']['author']}}</span></li>
      <li><i class="am-icon-clock-o"></i><span>发布
              @if($msg['dataInfo']['btime']>0)
                  {{$msg['dataInfo']['btime']}}分钟前更新
              @else
                  {{date('Y/m/d',$msg['dataInfo']['create_time'])}}
              @endif</span></li>
    </ul>
    <ul class="am_tuya_tag">
        <li><span class="am_tuya_tag_title">TAG</span></li>
        <li><a href=""><span>汪星人</span><span>15623</span></a></li>
        <li><a href=""><span>柯基</span><span>6251</span></a></li>
        <li><a href=""><span>主人合影</span><span>3256</span></a></li>
        <li><a href=""><span>棕白色</span><span>54</span></a></li>
    </ul>
    <div class="page_hot">
                <div class="page_hot_title">人气涂鸦</div>
                <div class="page_hot_list"><div class="page_hot_block">
        <dl>
            <dt><a href="/21712.html"><img src="http://img.petshow.cc/pet_show/2015_08/9271536e6bba236ff7ac4621304a935b.jpg" alt=""></a></dt>
            <dd>
                <i>路见不平Eason吼 ♫</i>
                <em>广西壮族自治区钦州市</em>
                <div class="hot_block_info">
                    <div class="hot_info_l am-icon-heart">16</div>
                    <div class="hot_info_r am-icon-comments">1</div>
                </div>
            </dd>
        </dl>
    </div>
    <div class="page_hot_block">
        <dl>
            <dt><a href="/19866.html"><img src="http://img.petshow.cc/pet_show/2015_08/a06efc530d8220cb30a711c5e0ea92a8.jpg" alt=""></a></dt>
            <dd>
                <i>张子玉^_-@</i>
                <em>北京市北京市</em>
                <div class="hot_block_info">
                    <div class="hot_info_l am-icon-heart">14</div>
                    <div class="hot_info_r am-icon-comments">1</div>
                </div>
            </dd>
        </dl>
    </div>
    <div class="page_hot_block">
        <dl>
            <dt><a href="/23083.html"><img src="http://img.petshow.cc/pet_show/2015_08/49c8a8256eb95f549fa843fb8b9a61eb.jpg" alt=""></a></dt>
            <dd>
                <i>梦里花落</i>
                <em>重庆市重庆市</em>
                <div class="hot_block_info">
                    <div class="hot_info_l am-icon-heart">13</div>
                    <div class="hot_info_r am-icon-comments">5</div>
                </div>
            </dd>
        </dl>
    </div>
    <div class="page_hot_block">
        <dl>
            <dt><a href="/21687.html"><img src="http://img.petshow.cc/pet_show/2015_08/3e2d201e234fc5be999710726f89b895.jpg" alt=""></a></dt>
            <dd>
                <i>神秘人</i>
                <em>广西壮族自治区南宁市</em>
                <div class="hot_block_info">
                    <div class="hot_info_l am-icon-heart">13</div>
                    <div class="hot_info_r am-icon-comments">3</div>
                </div>
            </dd>
        </dl>
    </div>
    <div class="page_hot_block">
        <dl>
            <dt><a href="/20603.html"><img src="http://img.petshow.cc/pet_show/2015_08/b1253be5c48cba3eef939c5fb25b99e7.jpg" alt=""></a></dt>
            <dd>
                <i>夜光</i>
                <em>安徽省滁州市</em>
                <div class="hot_block_info">
                    <div class="hot_info_l am-icon-heart">13</div>
                    <div class="hot_info_r am-icon-comments">3</div>
                </div>
            </dd>
        </dl>
    </div>
    <div class="page_hot_block">
        <dl>
            <dt><a href="/21644.html"><img src="http://img.petshow.cc/pet_show/2015_08/3a87a79c8aef235f36876c1ed3295e4c.jpg" alt=""></a></dt>
            <dd>
                <i>吉娃娃_朵朵</i>
                <em>山东省济宁市</em>
                <div class="hot_block_info">
                    <div class="hot_info_l am-icon-heart">12</div>
                    <div class="hot_info_r am-icon-comments">2</div>
                </div>
            </dd>
        </dl>
    </div>
    </div>
              </div>
    </div>
    </div>
</div>

<script>
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