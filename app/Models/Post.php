<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }   

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Extract #hashtags from the description and sync tags.
     */
    public function syncTagsFromDescription(): void
    {
        preg_match_all('/#([\w]+)/u', $this->description ?? '', $matches);

        $tagNames = collect($matches[1])
            ->map(fn($name) => strtolower($name))
            ->unique();

        if ($tagNames->isEmpty()) {
            $this->tags()->detach();
            return;
        }

        $tagIds = $tagNames->map(fn($name) => 
            Tag::firstOrCreate(['name' => $name])
        )->pluck('id');

        $this->tags()->sync($tagIds);
    }
}
