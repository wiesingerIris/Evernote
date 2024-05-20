<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'due_date','tag_id', 'user_id', 'note_id', 'share_id'];

    public function images() : HasMany
    {
        return $this->hasMany(Image::class);
    }
    public function tag() : BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function share(): BelongsTo {
        return $this->belongsTo(Share::class);
    }
}
