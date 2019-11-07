<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends BaseController
{

    protected $title = 'App\User';
    protected $page_name = 'user';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $lang['title'];
            $this->column_name = $lang['column'];
            $this->sex_text = $lang['sex_text'];

            return $next($request);
        });
    }
    protected function grid()
    {
        $sex_text = $this->sex_text;
        $column_name = $this->column_name;
        $grid = new Grid(new User);

        $grid->model()->orderBy('id', 'DESC');
        $grid->column('id', __($this->column_name['id']));
        $grid->column('name', __($this->column_name['name']));
        $grid->column('sex', __($this->column_name['sex']))->display(function() use ($sex_text) {
            return '<span class="option' . count($sex_text) . '_text_' . $this->sex .'">' . $sex_text[$this->sex] . '</span>';
        });
        $grid->column('address', __($this->column_name['address']));
        $grid->column('phone', __($this->column_name['phone']));
        $grid->column('email', __($this->column_name['email']));
        $grid->column('times', __($this->column_name['times']));
//        $grid->column('email_verified_at', __('Email verified at'));
//        $grid->column('password', __('Password'));
//        $grid->column('remember_token', __('Remember token'));
//        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __($this->column_name['updated_at']));

        $grid->actions(function ($actions) {
            // $actions->disableView();
            $actions->disableDelete();
            if(!Admin::user()->isRole('admin')){
                $actions->disableEdit();
            }
        });

        $grid->disableExport();
        if(!Admin::user()->isRole('admin')) {
            $grid->disableCreateButton();
        }

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->filter(function ($filter) use ($column_name) {
            $filter->disableIdFilter();
            $filter->like('name', $column_name['name']);
            $filter->like('phone', $column_name['phone']);
            $filter->like('email', $column_name['email']);
        });
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __($this->column_name['id']));
        $show->field('name', __($this->column_name['name']));
        $show->field('sex', __($this->column_name['sex']));
        $show->field('address', __($this->column_name['address']));
        $show->field('phone', __($this->column_name['phone']));
        $show->field('email', __($this->column_name['email']));
//        $show->field('email_verified_at', __('Email verified at'));
//        $show->field('password', __('Password'));
//        $show->field('remember_token', __('Remember token'));
//        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', __($this->column_name['id']));
        $form->select('sex', __($this->column_name['sex']))->options($this->sex_text);
        $form->text('address', __($this->column_name['address']));
        $form->mobile('phone', __($this->column_name['phone']));
        $form->email('email', __($this->column_name['email']));
//        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
//        $form->password('password', __('Password'));
//        $form->text('remember_token', __('Remember token'));
        return $form;
    }
}
