<?php

namespace App\Models;

use App\Models\UserReadModule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'description',
        'instructor_id',
        'category_id',
        'price',
        'is_published',
        'estimated_duration'
    ];

    public function isCompleted($user)
    {
        $totalLessons = $this->lessons()->count();
        $completedLessons = $user->progress()
            ->whereIn('lesson_id', $this->lessons()->pluck('id'))
            ->where('completed', true)
            ->count();

        return $totalLessons === $completedLessons;
    }
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function has_reads(): HasMany
    {
        return $this->hasMany(UserReadModule::class);
    }
}
