<script>
    layui.use(['layer'], function() {
        var layer = layui.layer;

        @if ($errors->any())
            layer.msg('{{ $errors->first() }}', {icon: 5});
        @endif

        @if(\Illuminate\Support\Facades\Session::has('success'))
        layer.msg('{{ \Illuminate\Support\Facades\Session::get('success') }}', {icon: 1});
        @endif

        @if(\Illuminate\Support\Facades\Session::has('error'))
        layer.msg('{{ \Illuminate\Support\Facades\Session::get('error') }}', {icon: 5});
        @endif
    });
</script>