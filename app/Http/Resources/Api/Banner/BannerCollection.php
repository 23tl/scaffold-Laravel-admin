<?php


namespace App\Http\Resources\Api\Banner;

use App\Http\Resources\Resources;
use Illuminate\Support\Str;

class BannerCollection extends Resources
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? getFile($this->image) : null,
            'url' => $this->url,
        ];
    }
}