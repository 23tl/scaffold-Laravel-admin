@include('admin._style', [
    'name' => '修改菜单'
])
<link rel="stylesheet" href="{{ asset('static/admin/lib/font-awesome-4.7.0/css/font-awesome.css') }}" media="all">
<body>
<div class="layui-form layuimini-form">

    <div class="layui-form-item">
        <label class="layui-form-label">上级菜单</label>
        <div class="layui-input-block">
            <select name="parentId" lay-filter="aihao">
                <option value=""></option>
                @foreach($menus as $eval)
                    <option value="{{ $eval->id }}" @if($eval->id === $menu->pId) selected="" @endif>{{ $eval->title }}</option>
                    @foreach($eval->children as $two)
                        <option value="{{ $two->id }}" @if($two->id === $menu->pId) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;{{ $two->title }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">名称</label>
        <div class="layui-input-block">
            <input type="text" name="title" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('title', $menu->title) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">链接</label>
        <div class="layui-input-block">
            <input type="text" name="href"  placeholder="请输入链接" value="{{ old('href', $menu->href) }}" class="layui-input">
            <tip>该链接同时作用于菜单权限使用。</tip>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">图标</label>
        <div class="layui-input-block">
            <input type="text" name="icon" id="iconPicker" lay-filter="iconPicker" value="fa-500px" style="display:none;">
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $menu->id }}">
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
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
    layui.use(['form', 'iconPickerFa'], function () {
        var form = layui.form
            ,iconPickerFa = layui.iconPickerFa;
        var iframeIndex = parent.layer.getFrameIndex(window.name);

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
        iconPickerFa.checkIcon('iconPicker', '{{ $menu->icon }}');

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            postAjaxDestroy('{{ route('admin.menus.update') }}', data.field, iframeIndex);
            return false;
        });

    });
</script>
</body>
</html>