<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use OpenAdmin\Admin\Controllers\AdminController;


class CategoryController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('courses_count', __('Courses'))->display(function () {
            return $this->courses()->count();
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Category());

        $form->text('name', __('Name'))->rules('required');

        return $form;
    }
}