<div class="am-u-sm-12" id="box">
    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="div_img_list_c">
        <thead>
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>图片</th>
            {{--<th>作者</th>--}}
            <th>类型</th>
            <th>人气</th>
            <th>内容</th>
            <th>发布时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if(count($msg['data'])>0)
            @foreach($msg['data'] as $key=>$value)
                <tr class="gradeX">
                    <td class="am-text-middle">{{$key+1}}</td>
                    <td class="am-text-middle">{{$value->title}}</td>
                    <td>
                        <img src="/{{$value->picture}}" class="tpl-table-line-img" alt="" data-original="{{asset('/public/admin/assets/img/k.jpg')}}">
                    </td>
                    {{--<td class="am-text-middle">{{$value->author}}</td>--}}
                    <td class="am-text-middle">
                        @if($value->type == 0)
                            动态
                        @elseif($value->type == 1)
                            领域
                        @endif
                    </td>
                    <td class="am-text-middle">{{$value->pop}}</td>
                    <td class="am-text-middle">{{$value->content}}</td>
                    <td class="am-text-middle">{{date('Y-m-d H:i',$value->create_time)}}</td>
                    <td class="am-text-middle">
                        <div class="tpl-table-black-operation">
                            <a href="{{url('admin/album/'.$value->id.'/edit')}}">
                                <i class="am-icon-pencil"></i> 编辑
                            </a>
                            <a href="javascript:;" class="tpl-table-black-operation-del">
                                <i class="am-icon-trash"></i> 删除
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr><td>没有更多的数据了</td></tr>
            @endif
                    <!-- more data -->
        </tbody>
    </table>
    <div class="am-u-lg-12 am-cf">
        {{--ajax分页--}}
        <div class="am-fr">
            <div >每页显示{{$msg['rev']}}条记录 共{{$msg['count']}}条记录</div>

            <ul class="am-pagination tpl-pagination">
                <li ><a href="javascript:;" onclick="page({{$msg['prev']}})">«</a></li>
                @foreach($msg['pp'] as $key=>$val)
                    @if($val == $msg['page'])
                        <li class="am-active"><a href="javascript:;" >{{$val}}</a></li>
                    @else
                        <li ><a href="javascript:;" onclick="page({{$val}})">{{$val}}</a></li>
                    @endif
                @endforeach
                <li><a href="javascript:;" onclick="page({{$msg['next']}})">»</a></li>

            </ul>
        </div>
    </div>
</div>
