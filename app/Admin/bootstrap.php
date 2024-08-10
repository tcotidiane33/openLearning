<?php

use OpenAdmin\Admin\Facades\Admin;
use Illuminate\Support\Facades\Auth;

/**
 * Open-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * OpenAdmin\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * OpenAdmin\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

OpenAdmin\Admin\Form::forget(['editor']);
// Vérifiez d'abord si Admin::menu() retourne bien un tableau.
Admin::extend('menu', function($menu) {
    $menu->add([
        'title' => 'Annonces',
        'icon'  => 'fa-bullhorn',
        'uri'   => 'announcements',
    ]);
    $menu->add([
        'title' => 'Courses',
        'icon'  => 'fa-book',
        'uri'   => 'courses',
    ]);
    
    $menu->add([
        'title' => 'Lessons',
        'icon'  => 'fa-file-text',
        'uri'   => 'lessons',
    ]);
    $menu->add([
        'title' => 'Categories',
        'icon'  => 'fa-tags',
        'uri'   => 'categories',
    ]);
    $menu->add([
        'title' => 'Quizzes',
        'icon'  => 'fa-question-circle',
        'uri'   => 'quizzes',
    ]);
    $menu->add([
        'title' => 'Progress',
        'icon'  => 'fa-tasks',
        'uri'   => 'progress',
    ]);
    // Ajoutez les autres éléments de menu de la même manière
});



// Admin::auth()->extend('instructor', function ($user) {
//     return $user->role === 'instructor';
// });