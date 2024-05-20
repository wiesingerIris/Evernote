<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image_id', 'tag_id', 'register_id'];

    public function images() : HasMany
    {
        return $this->hasMany(Image::class);
    }

        public function tag() : BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function register(): BelongsTo
    {
        return $this->belongsTo(Register::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
