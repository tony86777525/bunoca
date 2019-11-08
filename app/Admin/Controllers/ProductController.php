<?php

namespace App\Admin\Controllers;

use App\Product;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends BaseController
{
    protected $title = 'App\Product';
    protected $page_name = 'product';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $lang['title'];
            $this->column_name = $lang['column'];
            $this->display_flg_option = $lang['display_flg_option'];
            $this->display_flg_text = $lang['display_flg_text'];

            return $next($request);
        });
    }

    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->model()->orderBy('p_sort', 'DESC')->orderBy('id', 'DESC');
        $grid->column('id', __($this->column_name['id']));
        $grid->column('p_name', __($this->column_name['p_name']));
        $grid->column('p_title', __($this->column_name['p_title']));
        $grid->column('p_display_flg', __($this->column_name['p_display_flg']))->switch($this->display_flg_option);
        $grid->column('p_sort', __($this->column_name['p_sort']));
//        $grid->column('p_image', __('P image'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));
//        $grid->column('deleted_at', __('Deleted at'));

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
        $display_flg_text = $this->display_flg_text;
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __($this->column_name['id']));
        $show->field('p_name', __($this->column_name['p_name']));
        $show->field('p_tile', __($this->column_name['p_title']));
        $show->field('p_price', __($this->column_name['p_price']));
        $show->field('p_display_flg', __($this->column_name['p_display_flg']))->as(function () use ($display_flg_text) {
            return  $display_flg_text[$this->p_display_flg];
        });
        $show->field('p_sort', __($this->column_name['p_sort']));
        $show->field('p_image', __($this->column_name['p_image']))->image();
//        $show->field('created_at', __('Created at'));
//        $show->field('updated_at', __('Updated at'));
//        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('p_name', __($this->column_name['p_name']));
        $form->text('p_title', __($this->column_name['p_title']));
        $form->number('p_price', __($this->column_name['p_price']));
        $form->switch('p_display_flg', __($this->column_name['p_display_flg']))->options($this->display_flg_option);
        $form->number('p_sort', __($this->column_name['p_sort']));
        $form->image('p_image', __($this->column_name['p_image']))->uniqueName();

        return $form;
    }
}
