<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'title', 'register_id'];

    public function register():belongsTo
    {
        return $this->belongsTo(Register::class);
    }

    public function note():belongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function task():belongsTo
    {
        return $this->belongsTo(Task::class);
    }





}
