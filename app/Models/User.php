<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

// use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory; 
    // use Billable;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'bio', 'photo', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id');
    }

    public function completedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_completions')
                    ->withTimestamps();
    }

    public function instructedCourses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }


    public function isInstructor()
{
    return $this->role === 'instructor'; // Ajustez selon votre logique d'attribution des rôles
}

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function forumThreads()
    {
        return $this->hasMany(ForumThread::class);
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // public function hasRole($role)
    // {
    //     if (is_string($role)) {
    //         return $this->roles->contains('name', $role);
    //     }

    //     return (bool) $role->intersect($this->roles)->count();
    // }

    public function hasRole($role)
{
    return $this->role === $role;
}
    public function hasAnyRole($roles)
    {
        if (is_string($roles)) {
            return $this->hasRole($roles);
        }

        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function subscription()
{
    return $this->hasOne(Subscription::class)->latest();
}
// Méthode helper pour vérifier l'abonnement
public function hasActiveSubscription()
{
    return $this->subscription && $this->subscription->isActive();
}

    // public function instructedCourses()
    // {
    //     return $this->hasMany(Course::class, 'instructor_id');
    // }
}
