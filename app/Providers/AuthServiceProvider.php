<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Course;
use App\Policies\CoursePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Définir les permissions
        $permissions = [
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
            'manage users',
            'manage roles',
            'view analytics',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Créer les rôles et assigner les permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $instructorRole = Role::firstOrCreate(['name' => 'instructor']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        $adminRole->syncPermissions(Permission::all());
        $instructorRole->syncPermissions(['view courses', 'create courses', 'edit courses']);
        $studentRole->syncPermissions(['view courses']);

        // Définir les Gates
        Gate::define('view-course', function (User $user, Course $course) {
            return $user->hasRole('admin') || $user->hasRole('instructor') || $user->hasPermissionTo('view courses');
        });

        Gate::define('create-course', function (User $user) {
            return $user->hasRole('admin') || $user->hasRole('instructor');
        });

        Gate::define('edit-course', function (User $user, Course $course) {
            return $user->hasRole('admin') || ($user->hasRole('instructor') && $user->id === $course->instructor_id);
        });

        Gate::define('delete-course', function (User $user, Course $course) {
            return $user->hasRole('admin') || ($user->hasRole('instructor') && $user->id === $course->instructor_id);
        });

        Gate::define('manage-users', function (User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage-roles', function (User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('view-analytics', function (User $user) {
            return $user->hasRole('admin') || $user->hasRole('instructor');
        });
    }
}