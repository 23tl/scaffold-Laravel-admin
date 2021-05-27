<?php


namespace App\Http\Controllers\Api;


use App\Http\Resources\Api\User\CurrentResources;

class UserController extends ApiController
{
    /**
     * 获取个人详情
     * @return array
     */
    public function current()
    {
        return CurrentResources::make($this->request->user())->resolve();
    }

    public function update()
    {
        
    }
}