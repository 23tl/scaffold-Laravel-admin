@include('admin._style', [
    'name' => '广告管理'
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

        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
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
            url: '{{ route('admin.banner.index')  }}',
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
                {field: 'image', title: '广告图', height: 150 , templet:function(res) {
                        if(res.image) {
                            return '<div style="height:50px"><img src="'+ res.image +'" style="height:50px"></div>';
                        }
                        return '暂无';
                    }},
                {field: 'url', title: '链接'},
                {field: 'urlType', title: '链接类型'},
                {field: 'type', title: '类型'},
                {field: 'createdTime', title: '创建时间'},
                {title: '操作', minWidth: 150, toolbar: '#currentTableBar', align: "center"}
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
                var index = openNewWindow('添加广告', '{{ route('admin.banner.create') }}')
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
                var index = openNewWindow('编辑新闻', '{{ url('admin/banner/edit') }}/'+obj.data.id)
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除行么', function (index) {
                    var result = postAjaxDestroy('{{ route('admin.banner.destroy') }}', {
                        id:obj.data.id,
                    })
                    if(result.status == 200) {
                        obj.del();
                    }
                });
            }
        });

    });
</script>

</body>
</html>