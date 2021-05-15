<?php

namespace App\Models;

use App\Events\ArticleCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
