<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLink extends Model
{
    protected $fillable = [
        'snippet_id',
        'title',
        'url',
    ];

    public function snippet()
    {
        return $this->belongsTo(Snippet::class);
    }
}
