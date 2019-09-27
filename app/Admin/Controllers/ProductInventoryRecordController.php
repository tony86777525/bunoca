<?php

namespace App\Admin\Controllers;

use App\ProductInventoryRecord;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductInventoryRecordController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\ProductInventoryRecord';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductInventoryRecord);

        $grid->column('id', __('Id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('product_single_id', __('Product single id'));
        $grid->column('p_name', __('P name'));
        $grid->column('ps_type', __('Ps type'));
        $grid->column('admin_user_id', __('Admin user id'));
        $grid->column('admin_user_name', __('Admin user name'));
        $grid->column('pir_num', __('Pir num'));
        $grid->column('pir_before_num', __('Pir before num'));
        $grid->column('pir_after_num', __('Pir after num'));
        $grid->column('pir_message', __('Pir message'));
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
        $show = new Show(ProductInventoryRecord::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('product_single_id', __('Product single id'));
        $show->field('p_name', __('P name'));
        $show->field('ps_type', __('Ps type'));
        $show->field('admin_user_id', __('Admin user id'));
        $show->field('admin_user_name', __('Admin user name'));
        $show->field('pir_num', __('Pir num'));
        $show->field('pir_before_num', __('Pir before num'));
        $show->field('pir_after_num', __('Pir after num'));
        $show->field('pir_message', __('Pir message'));
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
        $form = new Form(new ProductInventoryRecord);

        $form->number('product_id', __('Product id'));
        $form->number('product_single_id', __('Product single id'));
        $form->text('p_name', __('P name'));
        $form->text('ps_type', __('Ps type'));
        $form->number('admin_user_id', __('Admin user id'));
        $form->text('admin_user_name', __('Admin user name'));
        $form->number('pir_num', __('Pir num'));
        $form->number('pir_before_num', __('Pir before num'));
        $form->number('pir_after_num', __('Pir after num'));
        $form->text('pir_message', __('Pir message'));

        return $form;
    }
}
