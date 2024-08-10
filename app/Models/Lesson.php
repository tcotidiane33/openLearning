<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{   
    use HasMedia;
    protected $fillable = [
        'course_id', 'title', 'content', 'media_type', 'media_url', 'order','video_url', 'pdf_material'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}
