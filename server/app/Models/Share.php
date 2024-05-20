<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Share extends Model
{
    use HasFactory;
    protected $fillable = [
        'register_id', 'user_id', 'accepted'
    ];

    public function register():BelongsTo
    {
        return $this->belongsTo(Register::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany {
        return $this->hasMany(Todo::class);
    }

}
