<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;
    use HasMedia;

    protected $fillable = ['lesson_id', 'title'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
