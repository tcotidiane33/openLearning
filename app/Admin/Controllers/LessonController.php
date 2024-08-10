<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Jobs\VideoProcessJob;
use OpenAdmin\Admin\Controllers\AdminController;

class LessonController extends AdminController
{   
    
    protected function grid()
    {
        $grid = new Grid(new Lesson());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('course.title', __('Course'));
        $grid->column('title', __('Title'));
        $grid->column('order', __('Order'))->sortable();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Lesson());

        $form->select('course_id', __('Course'))->options(Course::pluck('title', 'id'))->rules('required');
        $form->text('title', __('Title'))->rules('required');
        $form->textarea('content', __('Content'));
        $form->number('order', __('Order'))->default(0);
        $form->file('video_url', 'Lesson Video')->rules('mimes:mp4,mov,ogg');
        $form->file('pdf_material', 'PDF Material')->rules('mimes:pdf');

        $form->saved(function (Form $form) {
            $this->handleMedia($form->model());
        });

        return $form;
    }

    protected function handleMedia($model)
    {
        if (request()->hasFile('video_url')) {
            $media = $model->addMedia(request()->file('video_url'))
                           ->toMediaCollection('lesson_videos');
            VideoProcessJob::dispatch($media->id);
        }
        if (request()->hasFile('pdf_material')) {
            $model->addMedia(request()->file('pdf_material'))
                  ->toMediaCollection('lesson_pdfs');
        }
    }
}
