<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use OpenAdmin\Admin\Controllers\AdminController;

class AnnouncementController extends AdminController
{
    protected $title = 'Annonces';

    protected function grid()
    {
        $grid = new Grid(new Announcement());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Titre'));
        $grid->column('content', __('Contenu'))->limit(100);
        $grid->column('link', __('Lien'))->link();
        $grid->column('is_published', __('Publié'))->bool();
        $grid->column('publish_at', __('Date de publication'));
        $grid->column('expire_at', __('Date d\'expiration'));
        $grid->column('created_at', __('Créé le'));
        $grid->column('updated_at', __('Mis à jour le'));

        $grid->filter(function($filter){
            $filter->like('title', 'Titre');
            $filter->equal('is_published', 'Publié')->select([0 => 'Non', 1 => 'Oui']);
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Announcement::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', __('Titre'));
        $show->field('content', __('Contenu'));
        $show->field('link', __('Lien'));
        $show->field('is_published', __('Publié'))->as(function ($isPub) {
            return $isPub ? 'Oui' : 'Non';
        });
        $show->field('publish_at', __('Date de publication'));
        $show->field('expire_at', __('Date d\'expiration'));
        $show->field('created_at', __('Créé le'));
        $show->field('updated_at', __('Mis à jour le'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Announcement());

        $form->text('title', __('Titre'))->rules('required');
        $form->textarea('content', __('Contenu'))->rules('required');
        $form->url('link', __('Lien'));
        $form->switch('is_published', __('Publié'));
        $form->datetime('publish_at', __('Date de publication'))->default(date('Y-m-d H:i:s'));
        $form->datetime('expire_at', __('Date d\'expiration'));

        $form->saving(function (Form $form) {
            if ($form->is_published && !$form->model()->is_published) {
                $form->publish_at = now();
            }
    
            // Ajouter l'utilisateur actuel comme créateur
            $form->model()->created_by = Auth::id();
        });

        // $form->saving(function (Form $form) {
        //     if ($form->is_published && !$form->model()->is_published) {
        //         $form->publish_at = now();
        //     }
        // });

        return $form;
    }
}