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
 *
 */
if ( ! function_exists('setCompanyRouteImages')) {
    function setCompanyRouteImages(array $data = [])
    {
        foreach ($data as $key => $dist) {
            if (isset($dist['images']) && is_array($dist['images'])) {
                $data[$key]['images'] = setImagesUrlPath($dist['images']);
            }
        }

        return $data;
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
