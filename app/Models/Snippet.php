<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'description',
        'code',
        'html',
        'disabled',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function downloadLink()
    {
        return $this->hasMany(DownloadLink::class);
    }
}
