@include('admin._style', [
    'name' => '添加广告'
])
<body>
<div class="layui-form layuimini-form">

    <div class="layui-form-item">
        <label class="layui-form-label required">广告位置</label>
        <div class="layui-input-block">
            <select name="type" lay-verify="required" lay-reqtext="请选择广告位置">
                <option value="">请选择广告位置</option>
                @foreach(\App\Models\Banner::$typeMap as $str => $value)
                    <option value="{{ $str }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('name') }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">跳转类型</label>
        <div class="layui-input-block">
            <select name="urlType" lay-verify="required" lay-reqtext="请选择跳转类型">
                <option value="">请选择跳转类型</option>
                @foreach(\App\Models\Banner::$urlTypeMap as $str => $value)
                    <option value="{{ $str }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">链接</label>
        <div class="layui-input-block">
            <input type="text" name="url" lay-verify="required" lay-reqtext="链接不能为空" placeholder="请输入链接" value="{{ old('url', '#') }}" class="layui-input">
            <tip>如跳转类型为商品，则链接规定为：/goods/show/{id};该 id 为商品编号，比如：/goods/show/1</tip>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">排序</label>
        <div class="layui-input-block">
            <input type="text" name="sort" lay-verify="required" lay-reqtext="链接不能为空" placeholder="请输入链接" value="{{ old('sort', 0) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">广告图</label>
        <div class="layui-input-block">
            <div class="layui-upload-drag" id="test10">
                <i class="layui-icon"></i>
                <p>点击上传，或将文件拖拽到此处，尺寸比为750*470</p>
                <div class="layui-hide" id="uploadDemoView">
                    <hr>
                    <img src="" alt="上传成功后渲染" style="max-width: 196px;">

                </div>
            </div>
        </div>

        <input type="hidden" value="" id="cover" name="image">

    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<button hidden="" type="button" id="importModel" class="image_btn" ></button>
<script>

    layui.use(['form', 'upload'], function () {
        var form = layui.form
            , upload = layui.upload;
        var iframeIndex = parent.layer.getFrameIndex(window.name);


        //监听提交
        form.on('submit(saveBtn)', function (data) {
            postAjaxDestroy('{{ route('admin.banner.store') }}', data.field, iframeIndex);
            return false;
        });

        upload.render({
            elem: '#test10'
            ,url: '//upload.qiniup.com' //改成您自己的上传接口
            ,data:{
                token:'{{ \App\Facades\QiNiu\Auth::uploadToken(config('qiniu.bucket')) }}',
            }
            ,done: function(res){
                layer.msg('上传成功');
                layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', '{{ config('qiniu.url') }}/'+res.key);
                layui.$("#cover").val(res.key);
                console.log(res)
            }
        });
    });


</script>
</body>
</html>