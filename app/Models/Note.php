<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'body'
    ];

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function category()
    {
        return $this->belongsTo(Category::class);
    }
}
