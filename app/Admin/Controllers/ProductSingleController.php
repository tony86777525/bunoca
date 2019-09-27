<?php

namespace App\Admin\Controllers;

use App\ProductSingle;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductSingleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\ProductSingle';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductSingle);

        $grid->column('id', __('Id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('ps_type', __('Ps type'));
        $grid->column('ps_price', __('Ps price'));
        $grid->column('ps_inventory', __('Ps inventory'));
        $grid->column('ps_title', __('Ps title'));
        $grid->column('ps_content', __('Ps content'));
        $grid->column('ps_display_flg', __('Ps display flg'));
        $grid->column('ps_image', __('Ps image'));
        $grid->column('ps_href', __('Ps href'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

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
        $show = new Show(ProductSingle::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('ps_type', __('Ps type'));
        $show->field('ps_price', __('Ps price'));
        $show->field('ps_inventory', __('Ps inventory'));
        $show->field('ps_title', __('Ps title'));
        $show->field('ps_content', __('Ps content'));
        $show->field('ps_display_flg', __('Ps display flg'));
        $show->field('ps_image', __('Ps image'));
        $show->field('ps_href', __('Ps href'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductSingle);

        $form->number('product_id', __('Product id'));
        $form->text('ps_type', __('Ps type'));
        $form->number('ps_price', __('Ps price'));
        $form->number('ps_inventory', __('Ps inventory'));
        $form->text('ps_title', __('Ps title'));
        $form->textarea('ps_content', __('Ps content'));
        $form->number('ps_display_flg', __('Ps display flg'));
        $form->text('ps_image', __('Ps image'));
        $form->text('ps_href', __('Ps href'));

        return $form;
    }
}
