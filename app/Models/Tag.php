<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];


    protected static function booted(): void
    {
        static::creating(function (Tag $tag) {
            // Tag a slug based on the tag name
            $slug = Str::slug($tag->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $tag->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        static::updating(function (Tag $tag) {
            // Tag a slug based on the tag name
            $slug = Str::slug($tag->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $tag->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function posts():BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}
