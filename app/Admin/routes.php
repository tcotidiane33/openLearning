<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\AnnouncementController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('/courses', CourseController::class);
    $router->resource('/lessons', LessonController::class);
    $router->resource('/categories', CategoryController::class);
    $router->resource('/announcements', AnnouncementController::class);
    $router->resource('quizzes', QuizController::class);
$router->resource('progress', ProgressController::class);

});
