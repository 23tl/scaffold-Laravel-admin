<?php


namespace App\Properties\Parameter\Category;


use App\Models\Category;

class Update
{
    public $id, $parentId, $name, $type, $image, $sort, $url;

    public function __construct(
        int $id,
        string $name,
        int $type,
        int $sort = 0,
        string $url = null,
        string $image = null,
        int $parentId = 0
    ) {
        $this->id       = $id;
        $this->name     = $name;
        $this->type     = $type;
        $this->sort     = $sort;
        $this->image    = $image ;
        $this->parentId = $parentId;
        $this->url      = $url;
    }
}