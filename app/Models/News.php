<?php

namespace App\Models;

use Illuminate\Support\Str;

class News extends BaseModel
{
    protected $table = 'news';

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    /**
     * @param $value
     */
    public function setDescriptionAttribute($value)
    {
        if ($value) {
            $value = Str::limit($value, 200);
        }

        $this->attributes['description'] = $value;
    }
}
