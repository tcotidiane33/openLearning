<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Progress;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use OpenAdmin\Admin\Controllers\AdminController;

class ProgressController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Progress());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('user.name', __('User'));
        $grid->column('lesson.title', __('Lesson'));
        $grid->column('completed', __('Completed'))->display(function($completed) {
            return $completed ? 'Yes' : 'No';
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Progress());

        $form->select('user_id', __('User'))->options(User::pluck('name', 'id'))->rules('required');
        $form->select('lesson_id', __('Lesson'))->options(Lesson::pluck('title', 'id'))->rules('required');
        $form->switch('completed', __('Completed'));

        return $form;
    }
}