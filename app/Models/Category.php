<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug'
    ];

    protected function users()
    {
        return $this->belongsTo(User::class);
    }

    protected function notes()
    {
        return $this->hasMany(Note::class);
    }

}
