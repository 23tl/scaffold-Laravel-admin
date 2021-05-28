@include('admin._style', [
    'name' => '用户管理'
])
<style type="text/css">
    .layui-table-cell{
        text-align:center;
        height: auto;
        white-space: normal;
    }
    .layui-table img{

        max-width:300px

    }
</style>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">关键字</label>
                            <div class="layui-input-inline">
                                <input type="text" name="keywords" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
{{--                <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>--}}
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
            <a class="layui-btn  layui-btn-xs " lay-event="node">修改节点</a>
            <a class="layui-btn layui-btn-warm layui-btn-xs data-count-edit" lay-event="fund">修改资金</a>
            <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
        </script>

    </div>
</div>
<script>
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;

        table.render({
            elem: '#currentTableId',
            url: '{{ route('admin.users.index')  }}',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                {type: "checkbox"},
                {field: 'id', title: 'ID', sort: true},
                {field: 'name', title: '名称'},
                {field: 'avatar', title: '头像', height: 150 , templet:function(res) {
                        if(res.cover) {
                            return '<div style="height:50px"><img src="'+ res.avatar +'" style="height:50px"></div>';
                        }
                        return '暂无';
                }},
                {field: 'invite', title: '推荐码'},
                {field: 'parent', title: '推荐人'},
                {field: 'mobile', title: '联系方式'},
                {field: 'availableBalance', title: '可用余额'},
                {field: 'electronicBalance', title: '电子币'},
                {field: 'freezeBalance', title: '冻结金额'},
                {field: 'status', title: '状态'},
                {field: 'createdTime', title: '创建时间'},
                {title: '操作', minWidth: 150, width:300, toolbar: '#currentTableBar', align: "center"}
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 15,
            page: true,
            skin: 'line'
        });

        /**
         * 监听搜索操作
         * */
        form.on('submit(data-search-btn)', function (data) {
            var result = JSON.stringify(data.field);
            //执行搜索重载
            table.reload('currentTableId', {
                page: {
                    curr: 1
                }
                , where: {
                    searchParams: result
                }
            }, 'data');

            return false;
        });

        /**
         * toolbar监听事件
         */
        table.on('toolbar(currentTableFilter)', function (obj) {
            if (obj.event === 'add') {  // 监听添加操作
                var index = openNewWindow('添加新闻', '{{ route('admin.users.create') }}')
                $(window).on("resize", function () {
                    layer.full(index);
                });
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
                layer.alert(JSON.stringify(data));
            }
        });

        //监听表格复选框选择
        table.on('checkbox(currentTableFilter)', function (obj) {
            console.log(obj)
        });

        table.on('tool(currentTableFilter)', function (obj) {
            var data = obj.data;
            if (obj.event === 'edit') {
                var index = openNewWindow('编辑用户', '{{ url('admin/users/edit') }}/'+obj.data.id + '?method=info')
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除行么', function (index) {
                    var result = postAjaxDestroy('{{ route('admin.users.destroy') }}', {
                        id:obj.data.id,
                    })
                    if(result.status == 200) {
                        obj.del();
                    }
                });
            } else if (obj.event === 'fund') {
                var index = openNewWindow('编辑用户资金', '{{ url('admin/users/edit') }}/'+obj.data.id + '?method=fund')
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'node') {
                var index = openNewWindow('编辑用户节点', '{{ url('admin/users/edit') }}/'+obj.data.id + '?method=node')
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            }
        });

    });
</script>

</body>
</html>