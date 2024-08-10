<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use App\Jobs\VideoProcessJob;
use OpenAdmin\Admin\Facades\Admin;
use Illuminate\Support\Facades\Gate;
use OpenAdmin\Admin\Controllers\AdminController;


class CourseController extends AdminController
{

    protected function grid()
    {
        
        $grid = new Grid(new Course());

        // Filtrer les cours pour afficher uniquement ceux de l'instructeur connecté
        $grid->model()->where('instructor_id', Admin::user()->id);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Title'));
        $grid->column('instructor.name', __('Instructor'));
        $grid->column('category.name', __('Category'));
        $grid->column('price', __('Price'));
        $grid->column('is_published', __('Published'))->switch();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Course());

        $form->hidden('instructor_id')->default(Admin::user()->id);
        $form->text('title', __('Title'))->rules('required');
        $form->textarea('description', __('Description'));
        $form->select('category_id', __('Category'))->options(Category::pluck('name', 'id'))->rules('required');
        $form->decimal('price', __('Price'))->rules('required');
        $form->image('cover_image', 'Cover Image')->move(function ($file) {
            return 'courses/course_' . $this->id;
        });
        $form->file('intro_video', 'Introduction Video')->move(function ($file) {
            return 'courses/course_' . $this->id;
        })->rules('mimes:mp4,mov,ogg');
        $form->switch('is_published', __('Published'));

        $form->saving(function (Form $form) {
            if ($form->isCreating()) {
                $form->instructor_id = Admin::user()->id;
            }
        });

        $form->saved(function (Form $form) {
            $this->handleMedia($form->model());
        });

        return $form;
    }

    protected function handleMedia($model)
    {
        if (request()->hasFile('cover_image')) {
            $model->addMedia(request()->file('cover_image'))
                  ->toMediaCollection('cover_images');
        }
        if (request()->hasFile('intro_video')) {
            $media = $model->addMedia(request()->file('intro_video'))
                           ->toMediaCollection('intro_videos');
            VideoProcessJob::dispatch($media->id);
        }
    }
}