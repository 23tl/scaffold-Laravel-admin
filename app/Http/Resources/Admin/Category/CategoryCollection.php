<?php


namespace App\Http\Resources\Admin\Category;


use App\Http\Resources\Resources;
use App\Models\Category;

class CategoryCollection extends Resources
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parentId' => $this->parentId,
            'sort' => $this->sort,
            'url' => $this->url,
            'type' => [
                'code' => $this->type,
                'name' =>  Category::$typeMap[$this->type] ??'',
            ],
            'image' => (int)$this->type === Category::TYPE_FAST ? $this->image : getFile($this->image),
        ];
    }
}