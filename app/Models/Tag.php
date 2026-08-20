<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Scope: trending tags based on post count in the last 24 hours.
     */
    public function scopeTrending($query, int $limit = 5)
    {
        return $query->withCount(['posts' => function ($q) {
                $q->where('post_tag.created_at', '>=', now()->subDay());
            }])
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take($limit);
    }
}
