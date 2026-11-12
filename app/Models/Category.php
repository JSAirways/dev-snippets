<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'display_order',
    ];

    public function snippets()
    {
        return $this->hasMany(Snippet::class);
    }
}
