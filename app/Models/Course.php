<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Models\UserReadModule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    use HasMedia;

    protected $fillable = [
        'title',
        'level',
        'content',
        'subject',
        'description',
        'instructor_id',
        'category_id',
        'price',
        'revenue',
        'feature',
        'is_published',
        'estimated_duration',
        'average_rating',
          'cover_image', 'intro_video'
    ];

    public function isCompletedBy($user)
    {
        $totalLessons = $this->lessons()->count();
        $completedLessons = $user->progress()
            ->whereIn('lesson_id', $this->lessons()->pluck('id'))
            ->where('completed', true)
            ->count();

        return $totalLessons === $completedLessons;
    }
    
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // public function ratings(): HasMany
    // {
    //     return $this->hasMany(Rating::class);
    // }

    public function userReadModules(): HasMany
    {
        return $this->hasMany(UserReadModule::class);
    }

    public function updateAverageRating()
    {
        $this->average_rating = $this->reviews()->avg('rating');
        $this->save();
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id');
    }
}