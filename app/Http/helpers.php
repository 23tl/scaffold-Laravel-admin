<?php

use Illuminate\Support\Str;


/**
 * 获取上传云储存的远程地址
 */
if ( ! function_exists('getFile')) {
    function getFile($path)
    {
        if (Str::contains($path, '//')) {
            return $path;
        }

        return config('qiniu.url') . '/' . $path;
    }
}

/**
 * 设置数组中文件资源全路径
 */
if ( ! function_exists('setImagesUrlPath')) {
    function setImagesUrlPath(array $images = [])
    {
        foreach ($images as $key => $image) {
            $images[$key] = getFile($image);
        }

        return $images;
    }
}

/**
 * 菜单节点
 */
if ( ! function_exists('myTree')) {
    function myTree(array $data = [], int $pid = 0)
    {
        $tree = [];

        foreach ($data as $value) {
            if ($value['pId'] === $pid) {
                $value['child'] = myTree($data, $value['id']);
                if ($value['child'] === null) {
                    unset($value['child']);
                }
                $tree[] = $value;
            }
        }

        return $tree;
    }
}

if (! function_exists('getMenusAuthorityTree')) {
    function getMenusAuthorityTree(array $data = [], int $pid = 0)
    {
        $tree = [];
        foreach ($data as $value) {
            if ($value['pId'] === $pid) {
                unset($value['pId']);
                $value['children'] = getMenusAuthorityTree($data, $value['id']);
                if ($value['children'] === null) {
                    unset($value['children']);
                }
                $tree[] = $value;
            }
        }
        return $tree;
    }
}

/**
 * 生成唯一邀请码
 */
if (!function_exists('enCode'))
{
    function enCode(int $userId, int $length = 6)
    {
        $code = ''; // 邀请码
        $key = 'qsahquwhashnldnoq12312';
        $num = strlen($key);
        while ($userId > 0) { // 转进制
            $mod = $userId % $num; // 求模
            $userId = ($userId - $mod) / $num;
            $code = $key[$mod] . $code;
        }
        $code = str_pad($code, $length, '0', STR_PAD_LEFT); // 不足用0补充
        return $code;
    }
}