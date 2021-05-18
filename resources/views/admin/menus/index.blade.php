@include('admin._style', [
    'name' => '菜单管理'
])
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div>
            <div class="layui-btn-group">

                <button class="layui-btn layui-btn-normal" id="btn-add">添加</button>
                <button class="layui-btn" id="btn-expand">全部展开</button>
                <button class="layui-btn layui-btn-normal" id="btn-fold">全部折叠</button>
            </div>
            <table id="munu-table" class="layui-table" lay-filter="munu-table"></table>
        </div>
    </div>
</div>
<!-- 操作列 -->
<script type="text/html" id="auth-state">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script src="{{ asset('static/admin/js/lay-config.js?v=1.0.4') }}" charset="utf-8"></script>
<script>
    layui.use(['table', 'treetable'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var treetable = layui.treetable;

        // 渲染表格
        layer.load(2);
        treetable.render({
            treeColIndex: 1,
            treeSpid: '0',
            treeIdName: 'title',
            treePidName: 'parentId',
            elem: '#munu-table',
            url: '{{ route('admin.menus.index') }}',
            page: false,
            cols: [[
                {type: "checkbox"},
                {field: 'title', minWidth: 200, title: '名称'},
                {field: 'href', title: '权限标识'},
                {field: 'href', title: '菜单url'},
                {
                    field: 'pId', width: 80, align: 'center', templet: function (d) {
                        if (d.parentId == 0) {
                            return '<span class="layui-badge layui-bg-blue">模块</span>';
                        } else if (d.parentId != 0 && d.href == '') {
                            return '<span class="layui-badge-rim">菜单</span>';
                        } else {
                            return '<span class="layui-badge layui-bg-gray">按钮</span>';
                        }
                    }, title: '类型'
                },
                {templet: '#auth-state', width: 120, align: 'center', title: '操作'}
            ]],
            done: function () {
                layer.closeAll('loading');
            }
        });

        $('#btn-add').click(function () {
            var index = openNewWindow('添加菜单', '{{ route('admin.menus.create') }}')
            $(window).on("resize", function () {
                layer.full(index);
            });
        })

        $('#btn-expand').click(function () {
            treetable.expandAll('#munu-table');
        });

        $('#btn-fold').click(function () {
            treetable.foldAll('#munu-table');
        });

        //监听工具条
        table.on('tool(munu-table)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;

            if (layEvent === 'del') {
                layer.confirm('真的删除该菜单么？', function (index) {
                    var result = postAjaxDestroy('{{ route('admin.menus.destroy') }}', {
                        id:obj.data.id,
                    })
                    if(result.status == 200) {
                        obj.del();
                    }
                });
            } else if (layEvent === 'edit') {
                var index = openNewWindow('编辑菜单', '{{ url('admin/menus/edit') }}/'+obj.data.id)
                $(window).on("resize", function () {
                    layer.full(index);
                });
            }
        });
    });
</script>
</body>
</html>