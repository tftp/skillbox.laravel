<?php

namespace App\Models;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dispatchesEvents = [
        'created' => ArticleCreated::class,
        'updated' => ArticleUpdated::class,
        'deleted' => ArticleDeleted::class,
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function isPublished()
    {
        return (bool) $this->published;
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function histories()
    {
        return $this->hasMany(HistoryArticle::class);
    }

    public function getChanges()
    {
        return $this->changes;
    }

    public function getLensBodyAttribute($query)
    {
        return strlen($this->body);
    }

    public function getHistoriesCountAttribute($query)
    {
        return $this->histories()->count();
    }

    public function getCommentsCountAttribute($query)
    {
        return $this->comments()->count();
    }
}
