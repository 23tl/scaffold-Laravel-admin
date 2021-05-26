<?php


namespace App\Http\Resources\Api\News;


use App\Http\Resources\Resources;
use Illuminate\Support\Str;

class ShowResources extends Resources
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => Str::limit($this->description, 100),
            'cover' => $this->cover ? getFile($this->cover) : null,
            'createdTime' => $this->createdTime->toDateTimeString(),
            'category' => optional($this->category)->name,
            'content' => $this->content,
        ];
    }
}