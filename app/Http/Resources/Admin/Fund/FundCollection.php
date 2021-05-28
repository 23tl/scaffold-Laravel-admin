<?php


namespace App\Http\Resources\Admin\Fund;

use App\Http\Resources\Resources;
use App\Models\FundLogs;
use App\Models\User;
use Illuminate\Support\Str;

class FundCollection extends Resources
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => optional($this->user)->name,
            'currency' => FundLogs::$fundType[$this->currency],
            'type' => FundLogs::$typeMap[$this->type],
            'group' => FundLogs::$groupMap[$this->group],
            'amount' => $this->amount,
            'releaseTime' => $this->releaseTime ? date('Y-m-d H:i:s', $this->releaseTime) : '暂无',
            'createdTime' => $this->createdTime->toDateTimeString(),

        ];
    }
}