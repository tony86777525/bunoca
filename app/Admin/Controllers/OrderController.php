<?php

namespace App\Admin\Controllers;

use App\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('user_name', __('User name'));
        $grid->column('user_address', __('User address'));
        $grid->column('o_no', __('O no'));
        $grid->column('o_money', __('O money'));
        $grid->column('o_discount', __('O discount'));
        $grid->column('o_free_discount', __('O free discount'));
        $grid->column('o_fee', __('O fee'));
        $grid->column('o_num', __('O num'));
        $grid->column('o_pay_money', __('O pay money'));
        $grid->column('o_arrival_flg', __('O arrival flg'));
        $grid->column('o_pay_flg', __('O pay flg'));
        $grid->column('o_deliver_flg', __('O deliver flg'));
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('user_name', __('User name'));
        $show->field('user_address', __('User address'));
        $show->field('o_no', __('O no'));
        $show->field('o_money', __('O money'));
        $show->field('o_discount', __('O discount'));
        $show->field('o_free_discount', __('O free discount'));
        $show->field('o_fee', __('O fee'));
        $show->field('o_num', __('O num'));
        $show->field('o_pay_money', __('O pay money'));
        $show->field('o_arrival_flg', __('O arrival flg'));
        $show->field('o_pay_flg', __('O pay flg'));
        $show->field('o_deliver_flg', __('O deliver flg'));
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
        $form = new Form(new Order);

        $form->number('user_id', __('User id'));
        $form->text('user_name', __('User name'));
        $form->text('user_address', __('User address'));
        $form->text('o_no', __('O no'));
        $form->number('o_money', __('O money'));
        $form->number('o_discount', __('O discount'));
        $form->number('o_free_discount', __('O free discount'));
        $form->number('o_fee', __('O fee'));
        $form->number('o_num', __('O num'));
        $form->number('o_pay_money', __('O pay money'));
        $form->switch('o_arrival_flg', __('O arrival flg'));
        $form->switch('o_pay_flg', __('O pay flg'));
        $form->switch('o_deliver_flg', __('O deliver flg'));

        return $form;
    }
}
