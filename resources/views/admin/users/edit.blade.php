@include('admin._style', [
    'name' => '编辑用户'
])
<body>

<div class="layui-form layuimini-form">
    @if(isset($_GET['method']) && $_GET['method'] === 'info')
    <div class="layui-form-item">
        <label class="layui-form-label required">邀请码</label>
        <div class="layui-input-block">
            <input type="text" name="invite" disabled lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('invite', $user->invite) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">名称</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('name', $user->name) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">联系方式</label>
        <div class="layui-input-block">
            <input type="text" name="mobile" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('mobile', $user->mobile) }}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="text" name="password"   placeholder="为空则不修改" value="{{ old('password') }}" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">状态</label>
        <div class="layui-input-block">
            <select name="status" lay-verify="required" lay-reqtext="请选择状态">
                <option value="">请选择状态</option>
                @foreach(\App\Models\User::$statusMap as $str => $value)
                    <option value="{{ $str }}" @if($str === $user->status) selected="" @endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">头像</label>
        <div class="layui-input-block">
            <div class="layui-upload-drag" id="test10">
                <i class="layui-icon"></i>
                <p>点击上传，或将文件拖拽到此处，尺寸比为750*470</p>
                <div  @if($user->avatar) class="layui-show" @else class="layui-hide" @endif id="uploadDemoView">
                    <hr>
                    <img src="{{ getFile($user->avatar) }}" alt="上传成功后渲染" style="max-width: 196px;">
                </div>
            </div>
        </div>

        <input type="hidden" value="{{ $user->avatar }}" id="cover" name="image">

    </div>

    @elseif(isset($_GET['method']) && $_GET['method'] === 'fund')
        <div class="layui-form-item">
            <label class="layui-form-label required">可用金额</label>
            <div class="layui-input-block">
                <input type="text" name="availableBalance" disabled lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('availableBalance', $user->availableBalance) }}" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">冻结金额</label>
            <div class="layui-input-block">
                <input type="text" name="freezeBalance" disabled lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('freezeBalance', $user->freezeBalance) }}" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">电子币</label>
            <div class="layui-input-block">
                <input type="text" name="electronicBalance" disabled lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('electronicBalance', $user->electronicBalance) }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label required">积分</label>
            <div class="layui-input-block">
                <input type="text" name="integral" disabled lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="{{ old('integral', $user->integral) }}" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">币种</label>
            <div class="layui-input-block">
                <select name="currency" lay-verify="required" lay-reqtext="请选择币种">
                    <option value="">请选择币种</option>
                    @foreach(\App\Models\FundLogs::$fundType as $str => $value)
                        <option value="{{ $str }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">类型</label>
            <div class="layui-input-block">
                <select name="type" lay-verify="required" lay-reqtext="请选择币种">
                    <option value="">请选择币种</option>
                    @foreach(\App\Models\FundLogs::$typeMap as $str => $value)
                        <option value="{{ $str }}" >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">操作类型</label>
            <div class="layui-input-block">
                <select name="group" lay-verify="required" lay-reqtext="请选择操作类型">
                    <option value="">请选择操作类型</option>
                    @foreach(\App\Models\FundLogs::$groupMap as $str => $value)
                        <option value="{{ $str }}" >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">操作金额</label>
            <div class="layui-input-block">
                <input type="text" name="amount" lay-verify="required" lay-reqtext="请输入操作金额" placeholder="操作金额" value="{{ old('amount') }}" class="layui-input">
            </div>
        </div>

    @elseif(isset($_GET['method']) && $_GET['method'] === 'node')

    @endif
    <input type="hidden" value="{{ $user->id }}" name="id">
        <input type="hidden" name="method" value="{{ $_GET['method'] ?? 'info' }}">


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
            postAjaxDestroy('{{ route('admin.users.update') }}', data.field, iframeIndex);
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