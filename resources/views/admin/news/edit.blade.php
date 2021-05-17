@include('admin._style', [
    'name' => '编辑新闻'
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
                            <option value="{{ $category->id }}" @if($category->id === $news->categoryId) selected="" @endif>{{ $category->name }}</option>
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
            <input type="text" name="name" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('name', $news->name) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入描述" name="description" class="layui-textarea">{{ old('description', $news->description) }}</textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">封面图</label>
        <div class="layui-input-block">
            <div class="layui-upload-drag" id="test10">
                <i class="layui-icon"></i>
                <p>点击上传，或将文件拖拽到此处，尺寸比为750*470</p>
                <div  @if($news->image) class="layui-show" @else class="layui-hide" @endif id="uploadDemoView">
                    <hr>
                    <img src="{{ getFile($news->image) }}" alt="上传成功后渲染" style="max-width: 196px;">
                </div>
            </div>
        </div>

        <input type="hidden" value="{{ $news->image }}" id="cover" name="image">

    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">内容</label>
        <div class="layui-input-block">
            <textarea id="content" name="content" lay-verify="请输入新闻正文" style="display: none;">{{ $news->content }}</textarea>

        </div>
    </div>

    <input type="hidden" value="{{ $news->id }}" name="id">


    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<button hidden="" type="button" id="importModel" class="image_btn" ></button>
<script>

    layui.use(['form', 'upload', 'layedit'], function () {
        var form = layui.form
            , layedit = layui.layedit
            , upload = layui.upload;
        var iframeIndex = parent.layer.getFrameIndex(window.name);

        var content =layedit.build('content', {
            height: 180, //设置编辑器高度
            tool: [
                'strong' //加粗
                ,'italic' //斜体
                ,'underline' //下划线
                ,'del' //删除线
                ,'|' //分割线
                ,'left' //左对齐
                ,'center' //居中对齐
                ,'right' //右对齐
                ,'link' //超链接
            ]
        })

        form.verify({
            'content':function (value) {
                layedit.sync('content');
            }
        });


        //监听提交
        form.on('submit(saveBtn)', function (data) {
            postAjaxDestroy('{{ route('admin.news.update') }}', data.field, iframeIndex);
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