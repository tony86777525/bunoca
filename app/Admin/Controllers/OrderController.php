<?php

namespace App\Admin\Controllers;

use App\Order;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class OrderController extends BaseController
{
    protected $title = 'App\Order';
    protected $page_name = 'order';
    protected $user_page_name = 'user';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $lang['title'];
            $this->column_name = $lang['column'];
            $this->arrival_flg_text = $lang['arrival_flg_text'];
            $this->pay_flg_text = $lang['pay_flg_text'];
            $this->deliver_flg_text = $lang['deliver_flg_text'];
            $user_lang = \Config::get('const.language.' . $this->language . '.' . $this->user_page_name);
            $this->user_column_name = $user_lang['column'];
            $this->sex_text = $user_lang['sex_text'];

            return $next($request);
        });
    }

    protected function grid()
    {
        $user_column_name = $this->user_column_name;
        $arrival_flg_text = $this->arrival_flg_text;
        $pay_flg_text = $this->pay_flg_text;
        $deliver_flg_text = $this->deliver_flg_text;
        $sex_text = $this->sex_text;
        $grid = new Grid(new Order);

        $grid->column('id', __($this->column_name['id']));
        $grid->column(__($this->column_name['user_id']))->expand(function () use($user_column_name, $sex_text) {
            $header = [$user_column_name['name'], $user_column_name['sex'], $user_column_name['address'], $user_column_name['phone'], $user_column_name['email'], $user_column_name['times'], $user_column_name['updated_at']];
            $column = [[
                'name' => $this->user->name,
                'sex' => '<span class="option' . count($sex_text) . '_text_' . $this->user->sex . '">' . $sex_text[$this->user->sex],
                'address' => $this->user->address,
                'phone' => $this->user->phone,
                'email' => $this->user->email,
                'times' => $this->user->times,
                'updated_at' => $this->user->updated_at
            ]];

            return new Table($header, $column);
        });

        $grid->column('user_name', __($this->column_name['user_name']));
        $grid->column('user_address', __($this->column_name['user_address']));
        $grid->column('o_no', __($this->column_name['o_no']));
        $grid->column('o_money', __($this->column_name['o_money']));
        $grid->column('o_discount', __($this->column_name['o_discount']));
        $grid->column('o_free_discount', __($this->column_name['o_free_discount']));
        $grid->column('o_fee', __($this->column_name['o_fee']));
        $grid->column('o_num', __($this->column_name['o_num']));
        $grid->column('o_pay_money', __($this->column_name['o_pay_money']));
        $grid->column('o_arrival_flg', __($this->column_name['o_arrival_flg']))->display(function() use ($arrival_flg_text) {
            return '<span class="option' . count($arrival_flg_text) . '_text_' . $this->o_arrival_flg . '">' . $arrival_flg_text[$this->o_arrival_flg] . '</span>';
        });
        $grid->column('o_pay_flg', __($this->column_name['o_pay_flg']))->display(function() use ($pay_flg_text) {
            return '<span class="option' . count($pay_flg_text) . '_text_' . $this->o_pay_flg . '">' . $pay_flg_text[$this->o_pay_flg] . '</span>';
        });
        $grid->column('o_deliver_flg', __($this->column_name['o_deliver_flg']))->display(function() use ($deliver_flg_text) {
            return '<span class="option' . count($deliver_flg_text) . '_text_' . $this->o_deliver_flg . '">' . $deliver_flg_text[$this->o_deliver_flg] . '</span>';
        });
        $grid->column('created_at', __($this->column_name['created_at']));
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
        $users = $this->getAllUser();
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __($this->column_name['id']));
        $show->field('user_id', __($this->column_name['user_id']))->as(function () use ($users) {
            return  $users[$this->user_id];
        });;
        $show->field('user_name', __($this->column_name['user_name']));
        $show->field('user_address', __($this->column_name['user_address']));
        $show->field('o_no', __($this->column_name['o_no']));
        $show->field('o_money', __($this->column_name['o_money']));
        $show->field('o_discount', __($this->column_name['o_discount']));
        $show->field('o_free_discount', __($this->column_name['o_free_discount']));
        $show->field('o_fee', __($this->column_name['o_fee']));
        $show->field('o_num', __($this->column_name['o_num']));
        $show->field('o_pay_money', __($this->column_name['o_pay_money']));
        $show->field('o_arrival_flg', __($this->column_name['o_arrival_flg']));
        $show->field('o_pay_flg', __($this->column_name['o_pay_flg']));
        $show->field('o_deliver_flg', __($this->column_name['o_deliver_flg']));
        $show->field('created_at', __($this->column_name['created_at']));
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
        $users = $this->getAllUser();
        $form = new Form(new Order);

        $form->select('user_id', __($this->column_name['user_id']))->options($users);
        $form->text('user_name', __($this->column_name['user_name']));
        $form->text('user_address', __($this->column_name['user_address']));
        $form->text('o_no', __($this->column_name['o_no']));
        $form->number('o_money', __($this->column_name['o_money']));
        $form->number('o_discount', __($this->column_name['o_discount']));
        $form->number('o_free_discount', __($this->column_name['o_free_discount']));
        $form->number('o_fee', __($this->column_name['o_fee']));
        $form->number('o_num', __($this->column_name['o_num']));
        $form->number('o_pay_money', __($this->column_name['o_pay_money']));
        $form->switch('o_arrival_flg', __($this->column_name['o_arrival_flg']));
        $form->switch('o_pay_flg', __($this->column_name['o_pay_flg']));
        $form->switch('o_deliver_flg', __($this->column_name['o_deliver_flg']));

        return $form;
    }

    protected function getAllUser()
    {
        $users = [];
        $user = User::get();
        foreach($user as $v){
            $users[$v->id] = $v->name . ' - ' . $v->email;
        }

        return $users;
    }
}
