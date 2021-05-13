@include('admin._style', [
    'name' => '编辑角色'
])
<body>
<div class="layui-form layuimini-form">
    <div class="layui-form-item">
        <label class="layui-form-label required">标识</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" lay-reqtext="角色标识不能为空" placeholder="请输入角色标识"
                   value="{{ old('name', $role->name) }}" class="layui-input">
            <tip>该标识仅系统使用。</tip>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">名称</label>
        <div class="layui-input-block">
            <input type="text" name="displayName" lay-verify="required" lay-reqtext="角色名称不能为空" placeholder="请输入角色名称"
                   value="{{ old('displayName', $role->displayName) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">权限节点</label>
        <div class="layui-input-block">
            @foreach($menus as $men)
                <input type="checkbox" name="menus[]" @if(in_array($men->id, $roleMenus, true)) checked="" @endif title="{{ $men->title }}" value="{{ $men->id }}">
            @endforeach
        </div>
    </div>

    <input type="hidden" value="{{ $role->id }}" name="id">
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认修改</button>
        </div>
    </div>
</div>
<script>
    layui.use(['form'], function () {
        var form = layui.form;
        var iframeIndex = parent.layer.getFrameIndex(window.name);

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            postAjaxDestroy('{{ route('admin.roles.update') }}', data.field, iframeIndex);
            return false;
        });

    });
</script>
</body>
</html>