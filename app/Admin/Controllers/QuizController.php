<?php

namespace App\Admin\Controllers;

use App\Models\Quiz;
use App\Models\Lesson;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use OpenAdmin\Admin\Controllers\AdminController;


class QuizController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Quiz());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('lesson.title', __('Lesson'));
        $grid->column('title', __('Title'));
        $grid->column('questions_count', __('Questions'))->display(function () {
            return $this->questions()->count();
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Quiz());

        $form->select('lesson_id', __('Lesson'))->options(Lesson::pluck('title', 'id'))->rules('required');
        $form->text('title', __('Title'))->rules('required');

        $form->hasMany('questions', 'Questions', function (Form\NestedForm $form) {
            $form->text('content', __('Question'))->rules('required');
            $form->image('image', 'Question Image');
            $form->hasMany('answers', 'Answers', function (Form\NestedForm $form) {
                $form->text('content', __('Answer'))->rules('required');
                $form->switch('is_correct', __('Correct Answer'));
            });
        });

        $form->saved(function (Form $form) {
            $this->handleMedia($form->model());
        });

        return $form;
    }

    protected function handleMedia($model)
    {
        foreach ($model->questions as $question) {
            if (request()->hasFile("questions.{$question->id}.image")) {
                $question->addMedia(request()->file("questions.{$question->id}.image"))
                         ->toMediaCollection('question_images');
            }
        }
    }
}