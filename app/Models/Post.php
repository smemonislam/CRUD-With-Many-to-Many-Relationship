<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id ', 'title', 'slug', 'image', 'body', 'view_count', 'status', 'is_approved'];


    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            // Tag a slug based on the tag name
            $slug = Str::slug($post->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        static::updating(function (Post $post) {
            // Tag a slug based on the tag name
            $slug = Str::slug($post->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_post')->withTimestamps();
    }

    public function tags():BelongsToMany
    {
        return $this->BelongsToMany(Tag::class, 'post_tag')->withTimestamps();
    }
}
