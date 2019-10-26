<?php

namespace App\Admin\Controllers;

use App\Config;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConfigController extends AdminController
{
    protected $title = 'App\Config';
    protected $page_name = 'config';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $lang['title'];
            $this->column_name = $lang['column'];

            return $next($request);
        });
    }

    protected function grid()
    {
        $grid = new Grid(new Config);

        $grid->column('id', $this->column_name['id']);
        $grid->column('account', $this->column_name['account']);

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

        $grid->disableExport();
        $grid->disableCreateButton();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Config::findOrFail($id));

        $show->field('id', $this->column_name['id']);
        $show->field('account', $this->column_name['account']);

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Config);

        $form->text('account', $this->column_name['account']);

        return $form;
    }
}
