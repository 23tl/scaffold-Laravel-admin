<?php


namespace App\Properties\Parameter\Category;


use App\Models\Category;

class Store
{
    public $parentId, $name, $type, $image, $sort, $url;

    public function __construct(
        string $name,
        int $type,
        int $sort = 0,
        string $url = null,
        string $image = null,
        int $parentId = 0
    ) {
        $this->name     = $name;
        $this->type     = $type;
        $this->sort     = $sort;
        $this->image    =  $type === Category::TYPE_FAST ? 'fa '. $image : $image;
        $this->parentId = $parentId;
        $this->url      = $url;
    }
}