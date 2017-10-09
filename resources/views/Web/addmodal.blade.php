<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/modal.css')}}"/>
</head>
<body>

<div class="section1">添加模板后，您可以使用模板快速报价，抢占先机</div>
@if($add)
    {{--<-- 添加模板 -->--}}
    <form action="{{URL('form/add/model')}}" method="post">
        <div class="content">
            <p style="margin-top: 10px;">模板分类</p>
            <select name="column_id" class="choseclass" required="required">
                @foreach($server as $key=> $value )
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
            <p style="margin-top: 10px;">模板名称</p>
            <input type="text" name="name" id="" required="required" placeholder="请输入模板名称(四个字以内)" value=""
                   class="modalinp"/>
            <p style="margin-top: 10px;">模板价格</p>
            <input type="number" required="required" name="price" id="" placeholder="请输入参考价格" value="" class="modalinp"
                   style="width: 70%;"/>
            <span>元</span>
            <p style="margin-top: 10px;">模板留言</p>
            <textarea class="text" name="message" id="message" placeholder="我的电话是{{$phone}}，希望可以帮您解决问题哦"></textarea>
            <button id="save" class="save" type="submit">保存</button>
        </div>
    </form>

@else
    {{--<-- 修改模板 -->--}}
    <div class="content">
        <p style="margin-top: 10px;"></p>
        @foreach($mode as $value)
            <form action="{{URL('add/model/'.$value->mode_id)}}" method="post">
                <select name="column_id" class="choseclass" required="required">
                    <option value="{{ $value->id }}">{{$value->column_name}}</option>
                </select>
                <p style="margin-top: 10px;">模板名称</p>
                <input type="text" name="name" id="" required="required" placeholder="请输入模板名称(四个字以内)"
                       value="{{ $value->name }}" class="modalinp"/>
                <p style="margin-top: 10px;">模板价格</p>
                <input type="number" required="required" name="price" id="" placeholder="请输入参考价格" value="{{$value->price}}"
                       class="modalinp" style="width: 70%;"/>
                <span>元</span>
                <p style="margin-top: 10px;">模板留言</p>
                <textarea class="text" name="message" id="message"
                          placeholder="我的电话是16890897878，希望可以帮您解决问题哦">{{$value->message}}</textarea>
                <button id="update" class="save " type="submit">更新</button>
                @endforeach
            </form>
            <button class="delbtn" id="{{$value->mode_id}}">删除本条模板</button>
    </div>
@endif

<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(function () {
        $('.delbtn').click(function () {
            $.ajax({
                type: 'post',
                data: {'table': 'mode', 'id': $(this).attr('id')},
                dataType: 'json',
                url: '{{ URL("pur/del") }}',
                success: function (obj) {
                    if (obj.info == 'success') {
                        alert('删除成功');
                        window.location.href = '{{ URL("model") }}';
                    }
                },
                error: function (obj) {

                }
            })

        })
    })
</script>


</body>
</html>
