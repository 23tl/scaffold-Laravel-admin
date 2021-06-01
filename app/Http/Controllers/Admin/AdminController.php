<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    /**
     * 后台列表格式化数据使用
     * @param  array   $data
     * @param  string  $msg
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = [], $msg = '操作成功')
    {
        return response()->json([
            'code' => 0,
            'msg' => $msg,
            'count' => $data instanceof Collection ? count($data) : $data->total(),
            'data' => $data,
                                ]);
    }
}