@include('admin._style', [
    'name' => '添加管理员'
])
<body>
<div class="layui-form layuimini-form">
    <div class="layui-form-item">
        <label class="layui-form-label required">账号</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" lay-reqtext="账号不能为空" placeholder="请输入账号" value="{{ old('name') }}" class="layui-input">
            <tip>该名称作为登录账号使用。</tip>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">名称</label>
        <div class="layui-input-block">
            <input type="text" name="account" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('account') }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label ">号码</label>
        <div class="layui-input-block">
            <input type="text" name="mobile"  placeholder="请输入号码" value="{{ old('mobile') }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" lay-verify="required" lay-reqtext="密码不能为空" placeholder="请输入密码" value="{{ old('password') }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">选择角色</label>
        <div class="layui-input-block">
            <select name="roleId" lay-filter="aihao">
                <option value=""></option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->displayName }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<script>
    layui.use(['form'], function () {
        var form = layui.form;
        var iframeIndex = parent.layer.getFrameIndex(window.name);

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            postAjaxDestroy('{{ route('admin.account.store') }}', data.field, iframeIndex);
            return false;
        });

    });
</script>
</body>
</html>