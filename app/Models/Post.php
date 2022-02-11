<?php

namespace App\Models;

use App\Http\Traits\HasMentions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasMentions;

    protected $fillable = ['content'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePostsFeed(Builder $builder, $id)
    {
        return $builder->leftJoin('followings', 'followings.user_id', '=', 'posts.author_id')
            ->where('followings.follower_id', $id)
            ->orderByDesc('posts.id')
            ->select('posts.*')
            ->distinct();
    }
}

