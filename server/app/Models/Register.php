<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Register extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_id','user_id'];


    public function images() : HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'register_id');
    }
    public function share(): HasMany
    {
        return $this->hasMany(Share::class, 'register_id');
    }


}
