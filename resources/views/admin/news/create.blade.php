@include('admin._style', [
    'name' => '添加新闻'
])
<body>
<div class="layui-form layuimini-form">

    <div class="layui-form-item">
        <label class="layui-form-label required">分类</label>
        <div class="layui-input-block">
            <select name="categoryId" lay-verify="required" lay-reqtext="请选择分类">
                <option value="">请选择分类</option>
                @foreach($categories->where('parentId', 0) as $one)
                    <optgroup label="{{ $one->name }}">
                        @foreach($categories->where('parentId', '!=', 0) as $category)
                            @if($one->id === $category->parentId)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
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
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="desc" class="layui-textarea">{{ old('desc') }}</textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">封面图</label>
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

        <input type="hidden" value="" id="image" name="image">

    </div>



    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<button hidden="" type="button" id="importModel" class="image_btn" ></button>
<script>
    var imgListDiv;
    layui.use(['form', 'upload', 'transfer'], function () {
        var form = layui.form
            ,transfer = layui.transfer
            , upload = layui.upload;
        var iframeIndex = parent.layer.getFrameIndex(window.name);



        //监听提交
        form.on('submit(saveBtn)', function (data) {
            if (layui.$('#image').val() === '') {
                layer.msg('请上传课程封面图', {icon: 5});
                return false;
            }

            postAjaxDestroy('{{ route('admin.news.store') }}', data.field, iframeIndex);
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
                layui.$("#image").val(res.key);
                console.log(res)
            }
        });
    });


</script>
</body>
</html>