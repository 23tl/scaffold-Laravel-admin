<?php


namespace App\Http\Resources\Admin\Banner;

use App\Http\Resources\Resources;
use App\Models\Banner;
use Illuminate\Support\Str;

class BannerCollection extends Resources
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? getFile($this->image) : null,
            'createdTime' => $this->createdTime->toDateTimeString(),
            'url' => $this->url,
            'type' => Banner::$typeMap[$this->type],
            'urlType' => Banner::$urlTypeMap[$this->urlType],
        ];
    }
}