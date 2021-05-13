<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $name ?? config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('static/admin/lib/layui-v2.5.5/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('static/admin/css/public.css') }}" media="all">
    <script src="{{ asset('static/admin/lib/layui-v2.5.5/layui.js') }}" charset="utf-8"></script>
    <script src="{{ asset('static/admin/lib/layui-v2.5.5/layui.js') }}" charset="utf-8"></script>
    <script src="{{ asset('static/admin/js/assist.js') }}?v=1" charset="utf-8"></script>
</head>