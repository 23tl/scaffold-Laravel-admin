
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页二</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('static/admin/lib/layui-v2.5.5/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('static/admin/lib/font-awesome-4.7.0/css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('static/admin/css/public.css') }}" media="all">
    <script src="{{ asset('static/admin/js/assist.js') }}" charset="utf-8"></script>
    <style>
        .layui-card {border:1px solid #f2f2f2;border-radius:5px;}
        .icon {margin-right:10px;color:#1aa094;}
        .icon-cray {color:#ffb800!important;}
        .icon-blue {color:#1e9fff!important;}
        .icon-tip {color:#ff5722!important;}
        .layuimini-qiuck-module {text-align:center;margin-top: 10px}
        .layuimini-qiuck-module a i {display:inline-block;width:100%;height:60px;line-height:60px;text-align:center;border-radius:2px;font-size:30px;background-color:#F8F8F8;color:#333;transition:all .3s;-webkit-transition:all .3s;}
        .layuimini-qiuck-module a cite {position:relative;top:2px;display:block;color:#666;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;font-size:14px;}
        .welcome-module {width:100%;height:210px;}
        .panel {background-color:#fff;border:1px solid transparent;border-radius:3px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}
        .panel-body {padding:10px}
        .panel-title {margin-top:0;margin-bottom:0;font-size:12px;color:inherit}
        .label {display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em;margin-top: .3em;}
        .layui-red {color:red}
        .main_btn > p {height:40px;}
        .layui-bg-number {background-color:#F8F8F8;}
        .layuimini-notice:hover {background:#f6f6f6;}
        .layuimini-notice {padding:7px 16px;clear:both;font-size:12px !important;cursor:pointer;position:relative;transition:background 0.2s ease-in-out;}
        .layuimini-notice-title,.layuimini-notice-label {
            padding-right: 70px !important;text-overflow:ellipsis!important;overflow:hidden!important;white-space:nowrap!important;}
        .layuimini-notice-title {line-height:28px;font-size:14px;}
        .layuimini-notice-extra {position:absolute;top:50%;margin-top:-8px;right:16px;display:inline-block;height:16px;color:#999;}
    </style>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header"><i class="fa fa-warning icon"></i>数据统计</div>
                            <div class="layui-card-body">
                                <div class="welcome-module">
                                    <div class="layui-row layui-col-space10">
                                        <div class="layui-col-xs6">
                                            <div class="panel layui-bg-number">
                                                <div class="panel-body">
                                                    <div class="panel-title">
                                                        <span class="label pull-right layui-bg-blue">实时</span>
                                                        <h5>用户统计</h5>
                                                    </div>
                                                    <div class="panel-content">
                                                        <h1 class="no-margins">{{ $statistics['user'] }}</h1>
                                                        <small>当前用户总记录数</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-col-xs6">
                                            <div class="panel layui-bg-number">
                                                <div class="panel-body">
                                                    <div class="panel-title">
                                                        <span class="label pull-right layui-bg-cyan">实时</span>
                                                        <h5>机构统计</h5>
                                                    </div>
                                                    <div class="panel-content">
                                                        <h1 class="no-margins">{{ $statistics['organ'] }}</h1>
                                                        <small>当前机构总记录数</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-col-xs6">
                                            <div class="panel layui-bg-number">
                                                <div class="panel-body">
                                                    <div class="panel-title">
                                                        <span class="label pull-right layui-bg-orange">实时</span>
                                                        <h5>课程统计</h5>
                                                    </div>
                                                    <div class="panel-content">
                                                        <h1 class="no-margins">{{  $statistics['courses'] }}</h1>
                                                        <small>当前课程总记录数</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-col-xs6">
                                            <div class="panel layui-bg-number">
                                                <div class="panel-body">
                                                    <div class="panel-title">
                                                        <span class="label pull-right layui-bg-green">实时</span>
                                                        <h5>直播统计</h5>
                                                    </div>
                                                    <div class="panel-content">
                                                        <h1 class="no-margins">{{ $statistics['live'] }}</h1>
                                                        <small>当前直播总记录数</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header"><i class="fa fa-credit-card icon icon-blue"></i>快捷入口</div>
                            <div class="layui-card-body">
                                <div class="welcome-module">
                                    <div class="layui-row layui-col-space10 layuimini-qiuck">
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/account" data-title="用户管理" data-icon="fa fa-users">
                                                <i class="fa fa-users"></i>
                                                <cite>用户管理</cite>
                                            </a>
                                        </div>
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/config" data-title="系统设置" data-icon="fa fa-gears">
                                                <i class="fa fa-gears"></i>
                                                <cite>系统设置</cite>
                                            </a>
                                        </div>
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/agency" data-title="表机构管理格示例" data-icon="fa fa fa-american-sign-language-interpreting">
                                                <i class="fa fa fa-american-sign-language-interpreting"></i>
                                                <cite>机构管理</cite>
                                            </a>
                                        </div>
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/news" data-title="新闻管理" data-icon="fa  fa-newspaper-o">
                                                <i class="fa  fa-newspaper-o"></i>
                                                <cite>新闻管理</cite>
                                            </a>
                                        </div>
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/course" data-title="课程管理" data-icon="fa fa-align-justify">
                                                <i class="fa fa-align-justify"></i>
                                                <cite>课程管理</cite>
                                            </a>
                                        </div>
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/school" data-title="学校管理" data-icon="fa fa-sort-amount-asc">
                                                <i class="fa fa-sort-amount-asc"></i>
                                                <cite>学校管理</cite>
                                            </a>
                                        </div>
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/research/application" data-title="研学管理" data-icon="fa fa-whatsapp">
                                                <i class="fa fa-whatsapp"></i>
                                                <cite>研学管理</cite>
                                            </a>
                                        </div>
                                        <div class="layui-col-xs3 layuimini-qiuck-module">
                                            <a href="javascript:;" layuimini-content-href="admin/live/room" data-title="直播管理" data-icon="fa fa-sort-amount-desc">
                                                <i class="fa fa-sort-amount-desc"></i>
                                                <cite>直播管理</cite>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-header"><i class="fa fa-line-chart icon"></i>报表统计</div>
                            <div class="layui-card-body">
                                <div id="echarts-records" style="width: 100%;min-height:500px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-col-md4">

                <div class="layui-card">
                    <div class="layui-card-header"><i class="fa fa-bullhorn icon icon-tip"></i>最新新闻</div>
                    <div class="layui-card-body layui-text">
                        @foreach($news as $item)
                        <div class="layuimini-notice">
                            <div class="layuimini-notice-title">{{ $item->title }}</div>
                            <div class="layuimini-notice-extra">{{ $item->createdTime->toDateTimeString() }}</div>
                            <div class="layuimini-notice-content layui-hide">
                                {{ $item->desc }}
                            </div>
                            <div class="layuimini-notice-id" style="display:none">{{ $item->id }}</div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="layui-card">
                    <div class="layui-card-header"><i class="fa fa-bullhorn icon icon-tip"></i>最新路线</div>
                    <div class="layui-card-body layui-text">
                        @foreach($routes as $route)
                            <div class="layuimini-notice layuimini-route">
                                <div class="layuimini-notice-title layuimini-route-title">{{ $route->title }}</div>
                                <div class="layuimini-notice-extra ">{{ $route->createdTime->toDateTimeString() }}</div>
                                <div class="layuimini-notice-id layuimini-route-id" style="display:none">{{ $route->id }}</div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="layui-card">
                    <div class="layui-card-header"><i class="fa fa-fire icon"></i>版本信息</div>
                    <div class="layui-card-body layui-text">
                        <table class="layui-table">
                            <colgroup>
                                <col width="100">
                                <col>
                            </colgroup>
                            <tbody>
                            <tr>
                                <td>名称</td>
                                <td>
                                    {{ config('app.name') }}
                                </td>
                            </tr>
                            <tr>
                                <td>PHP版本</td>
                                <td>{{ PHP_VERSION }}</td>
                            </tr>
                            <tr>
                                <td>操作系统</td>
                                <td>{{ php_uname('s') }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
<script src="{{ asset('static/admin/lib/layui-v2.5.5/layui.js') }}" charset="utf-8"></script>
<script src="{{ asset('static/admin/js/lay-config.js?v=1.0.4') }}" charset="utf-8"></script>
<script>
    layui.use(['layer', 'miniTab','echarts'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            miniTab = layui.miniTab,
            echarts = layui.echarts;

        miniTab.listen();

        /**
         * 查看公告信息
         **/
        $('body').on('click', '.layuimini-notice', function () {
            var title = $(this).children('.layuimini-notice-title').text(),
                id = $(this).children('.layuimini-notice-id').text();
            openNewWindow(title, '{{ url('admin/news/edit') }}/'+id);
        });

        $('body').on('click', '.layuimini-route', function () {
            var title = $(this).children('.layuimini-route-title').text(),
                id = $(this).children('.layuimini-route-id').text();
           // openNewWindow(title, '{{ url('admin/news/edit') }}/'+id);
        });

        /**
         * 报表功能
         */
        var echartsRecords = echarts.init(document.getElementById('echarts-records'), 'walden');
        var optionRecords = {
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['用户','机构','学校','路线','直播']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
               // data: ['周一','周二','周三','周四','周五','周六','周日']
                data: [
                    @foreach($trend['days'] as $day)
                    '{{ $day }}',
                    @endforeach
                ]
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:'用户',
                    type:'line',
                    data:[
                        @foreach($trend['user'] as $user)
                        {{ $user }},
                        @endforeach
                    ]
                },
                {
                    name:'机构',
                    type:'line',
                    data:[
                        @foreach($trend['organ'] as $organ)
                        {{ $organ }},
                        @endforeach
                    ]
                },
                {
                    name:'学校',
                    type:'line',
                    data:[
                        @foreach($trend['school'] as $school)
                        {{ $school }},
                        @endforeach
                    ]
                },
                {
                    name:'路线',
                    type:'line',
                    data:[
                        @foreach($trend['route'] as $route)
                        {{ $route }},
                        @endforeach
                    ]
                },
                {
                    name:'直播',
                    type:'line',
                    data:[
                        @foreach($trend['live'] as $live)
                        {{ $live }},
                        @endforeach
                    ]
                }
            ]
        };
        echartsRecords.setOption(optionRecords);

        // echarts 窗口缩放自适应
        window.onresize = function(){
            echartsRecords.resize();
        }

    });
</script>
</body>
</html>
