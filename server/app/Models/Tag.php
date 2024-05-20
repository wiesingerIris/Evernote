<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function notes():HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }





}
