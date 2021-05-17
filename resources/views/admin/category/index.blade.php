@include('admin._style', [
    'name' => '分类管理'
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
<link rel="stylesheet" href="{{ asset('static/admin/lib/font-awesome-4.7.0/css/font-awesome.css') }}" media="all">

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
            url: '{{ route('admin.category.index') }}'+'?type='+{{ isset($_GET['type']) ? $_GET['type'] : 1 }},
            page: false,
            cols: [[
                {type: "checkbox"},
                {field: 'name', minWidth: 200, title: '名称'},
                {field: 'image', title: '图标', height: 100 , templet:function(res) {
                    if(res.type.code == '{{ \App\Models\Category::TYPE_FAST }}') {
                        return '<div class="layui-table-cell"><span class="treeTable-icon open" lay-tid="1" lay-tpid="0" lay-ttype="file"><i class="'+ res.image +'"></i></span></div>';
                    } else {
                        if(res.image) {
                            return '<div style="height:100px"><img src="'+ res.image +'"style="height:100px"></div>';
                        }
                        return '暂无';
                    }
                }},
                {field: 'url', minWidth: 200, title: '链接'},
                {field: 'sort', title: '排序'},
                {field: 'type', title: '类别', templet:function (res) {
                    return res.type.name;
                }},
                {templet: '#auth-state', width: 120, align: 'center', title: '操作'}
            ]],
            done: function () {
                layer.closeAll('loading');
            }
        });



        $('#btn-add').click(function () {
            var index = openNewWindow('添加分类', '{{ route('admin.category.create') }}'+'?type='+{{ isset($_GET['type']) ? $_GET['type'] : 1 }},)
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
                layer.confirm('真的删除行么', function (index) {
                    postAjaxDestroy('{{ route('admin.category.destroy') }}', {
                        id:obj.data.id,
                    })
                    obj.del();
                });
            } else if (layEvent === 'edit') {
                var index = openNewWindow('编辑分类', '{{ url('admin/category/edit') }}/'+obj.data.id+'?type='+{{ isset($_GET['type']) ? $_GET['type'] : 1 }},)
                $(window).on("resize", function () {
                    layer.full(index);
                });
            }
        });
    });
</script>
</body>
</html>