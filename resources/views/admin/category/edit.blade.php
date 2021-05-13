@include('admin._style', [
    'name' => '编辑分类'
])
<link rel="stylesheet" href="{{ asset('static/admin/lib/font-awesome-4.7.0/css/font-awesome.css') }}" media="all">
<body>
<div class="layui-form layuimini-form">
    <input type="hidden" value="{{ $category->type }}" name="type">

    @if($category->type !== \App\Models\Category::TYPE_FAST)
    <div class="layui-form-item">
        <label class="layui-form-label">上级菜单</label>
        <div class="layui-input-block">
            <select name="parentId">
                <option value=""></option>
                @foreach($categories as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    <div class="layui-form-item">
        <label class="layui-form-label required">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('name', $category->name) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">链接</label>
        <div class="layui-input-block">
            <input type="text" name="url" lay-verify="required" lay-reqtext="链接不能为空" placeholder="请输入链接" value="{{ old('url', $category->url) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">排序</label>
        <div class="layui-input-block">
            <input type="text" name="sort" lay-verify="required" lay-reqtext="排序不能为空" placeholder="请输入排序" value="{{ old('sort', $category->sort ?? 0) }}" class="layui-input">
        </div>
    </div>
    @if(isset($_GET['type']) && (int)$_GET['type'] === \App\Models\Category::TYPE_FAST)
        <div class="layui-form-item">
            <label class="layui-form-label required">图标</label>
            <div class="layui-input-block">
                <input type="text" name="image" id="iconPicker" lay-filter="iconPicker" value="fa-500px" style="display:none;">
            </div>
        </div>
    @else
        <div class="layui-form-item">
            <label class="layui-form-label required">图标</label>
            <div class="layui-input-block">
                <div class="layui-upload-drag" id="test10">
                    <i class="layui-icon"></i>
                    <p>点击上传，或将文件拖拽到此处，尺寸比为750X268</p>
                    <div class="layui-hide" id="uploadDemoView">
                        <hr>
                        <img src="{{ getFile($category->image) }}" alt="上传成功后渲染" style="max-width: 196px">
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ $category->image }}" id="image" name="image">
        </div>
    @endif
    <input type="hidden" value="{{ $category->id }}" name="id">
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认修改</button>
        </div>
    </div>
</div>
<script>
    layui.config({
        base: "/static/admin/js/lay-module/",
        version: true
    }).extend({
        iconPickerFa: 'iconPicker/iconPickerFa', // fa图标选择扩展
    });

    layui.use(['form', 'upload', 'iconPickerFa'], function () {
        var form = layui.form
            , iconPickerFa = layui.iconPickerFa
            , upload = layui.upload;
        var iframeIndex = parent.layer.getFrameIndex(window.name);

        @if((int)$category->type === \App\Models\Category::TYPE_FAST)
        iconPickerFa.render({
            // 选择器，推荐使用input
            elem: '#iconPicker',

            url: '{{ asset('static/admin/lib/font-awesome-4.7.0/less/variables.less') }}',

            // 是否开启搜索：true/false，默认true
            search: true,
            // 是否开启分页：true/false，默认true
            page: true,
            // 每页显示数量，默认12
            limit: 12,
            // 每个图标格子的宽度：'43px'或'20%'
            cellWidth: '43px',
            // 点击回调
            click: function (data) {
                console.log(data);
            },
            // 渲染成功后的回调
            success: function(d) {
                console.log(d);
            }
        });

        /**
         * 选中图标 （常用于更新时默认选中图标）
         * @param filter lay-filter
         * @param iconName 图标名称，自动识别fontClass/unicode
         */

        iconPickerFa.checkIcon('iconPicker', '{{ $category->image }}');
        @endif

        upload.render({
            elem: '#test10'
            ,url: '//upload.qiniup.com' //改成您自己的上传接口
            ,data:{
                token:'{{ \App\Cache\UploadToken::getUploadToken() }}',
            }
            ,done: function(res){
                layer.msg('上传成功');
                layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', '{{ config('qiniu.url') }}/'+res.key);
                layui.$("#image").val(res.key);
                console.log(res)
            }
        });

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            postAjaxDestroy('{{ route('admin.category.update') }}', data.field, iframeIndex);
            return false;
        });
    });
</script>
</body>
</html>