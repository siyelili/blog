<table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="div_img_list_c">
    <thead>
    <tr>
        <th>编号</th>
        <th>照片标题</th>
        <th>照片缩略图</th>
        <th>作者</th>
        <th>类型</th>
        <th>人气</th>
        <th>照片描述</th>
        <th>上传时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dataList['data'] as $key=>$value)
        <tr class="gradeX">
            <td class="am-text-middle">{{$key+1}}</td>
            <td class="am-text-middle">{{$value->picture_name}}</td>
            <td>
                <img src="/{{$value->picture}}" class="tpl-table-line-img" alt="" data-original="{{asset('/public/admin/assets/img/k.jpg')}}">
            </td>
            <td class="am-text-middle">{{$value->author}}</td>
            <td class="am-text-middle">
                @if($value->typeid == 1)
                    亲子
                @elseif($value->typeid == 2)
                    家庭
                @elseif($value->typeid == 3)
                    美景
                @elseif($value->typeid == 4)
                    旅行
                @elseif($value->typeid == 5)
                    工作
                @elseif($value->typeid == 6)
                    其他
                @endif
            </td>
            <td class="am-text-middle">{{$value->pop}}</td>
            <td class="am-text-middle">{{$value->intro}}</td>
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
                <!-- more data -->
    </tbody>
</table>

<div class="am-u-lg-12 am-cf">
    {{--ajax分页--}}
    <div class="am-fr">
        <div >每页显示{{$dataList['rev']}}条记录 共{{$dataList['count']}}条记录</div>
        <ul class="am-pagination tpl-pagination">
            <li><a href="javascript:;" onclick="page({{$dataList['prev']}})">«</a></li>
            @foreach($dataList['pp'] as $key=>$val)
                @if($val == $dataList['page'])
                    <li class="am-active"><a href="javascript:;" >{{$val}}</a></li>
                @else
                    <li ><a href="javascript:;" onclick="page({{$val}})">{{$val}}</a></li>
                @endif
            @endforeach
            <li><a href="javascript:;" onclick="page({{$dataList['next']}})">»</a></li>

        </ul>
    </div>
</div>