<?php

namespace App\Models;


class Menu extends BaseModel
{
    protected $table = 'menus';

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany($this, 'pId', 'id');
    }

}
