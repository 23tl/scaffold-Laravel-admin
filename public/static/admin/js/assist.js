function openNewWindow(title,url){
    var index = layer.open({
        type: 2,
        area: ['100%', '100%'],
        fix: false, //不固定
        maxmin: true,
        shadeClose: true,
        shade:0.4,
        title: title,
        content: url,
        success: function(){
            //窗口加载成功刷新frame
            // location.replace(location.href);
        },
        cancel:function(){
            //关闭窗口之后刷新frame
            // location.replace(location.href);
        },
        end:function(){
            //窗口销毁之后刷新frame
            // location.replace(location.href);
            location.reload();
        }
    });

    return index;
}

function postAjaxDestroy(url, data, iframeIndex = false) {
     layui.$.ajax({
        url:url,
        method: 'POST',
        data: data,
        headers: {
            'X-CSRF-TOKEN': layui.$('meta[name="csrf-token"]').attr('content')
        },
        success:function (data) {
            if (data.code == 0) {
                layer.msg(data.msg, {icon: 1});
                if (iframeIndex) {
                    parent.layer.close(iframeIndex);
                }

            } else {
                layer.msg(data.msg, {icon: 5});
            }
        },
        error:function(err) {
            // 此处为错误
            // JSON.stringify(data.field)
            layer.msg(err.responseJSON.message, {icon: 5});
            window.reload()
        }
    });
}

function postAjaxTableReload(url, data, table) {
    layui.$.ajax({
        url:url,
        method: 'POST',
        data: data,
        headers: {
            'X-CSRF-TOKEN': layui.$('meta[name="csrf-token"]').attr('content')
        },
        success:function (data) {
            if (data.code == 0) {
                layer.msg(data.msg, {icon: 1});
                layui.table.reload(table);
            } else {
                layer.msg(data.msg, {icon: 5});
            }
        },
        error:function(err) {
            // 此处为错误
            // JSON.stringify(data.field)
            layer.msg(err.responseJSON.message, {icon: 5});
        }
    });
}