<?php


namespace App\Http\Resources\Api\User;


use App\Http\Resources\Resources;

class CurrentResources extends Resources
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'invite' => $this->invite,
            'parent' => $this->parentId ? optional($this->parent)->name : null,
            'avatar' => $this->avatar ? getFile($this->avatar) : null,
            'availableBalance' => $this->availableBalance,
            'electronicBalance' => $this->electronicBalance,
            'integral' => $this->integral,
            'freezeBalance' => $this->freezeBalance,
        ];
    }
}