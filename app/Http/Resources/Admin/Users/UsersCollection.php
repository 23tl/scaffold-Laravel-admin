<?php


namespace App\Http\Resources\Admin\Users;

use App\Http\Resources\Resources;
use App\Models\User;
use Illuminate\Support\Str;

class UsersCollection extends Resources
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'invite' => $this->invite,
            'parent' => $this->parentId ? optional($this->parent)->name : '暂无推荐人',
            'name' => $this->name,
            'mobile' => $this->mobile,
            'avatar' => $this->avatar ? getFile($this->avatar) : null,
            'availableBalance' => $this->availableBalance,
            'freezeBalance' => $this->freezeBalance,
            'electronicBalance' => $this->electronicBalance,
            'createdTime' => $this->createdTime->toDateTimeString(),
            'status' => User::$statusMap[$this->status],
        ];
    }
}