<?php

namespace App\Admin\Controllers\User;

use App\Order;
use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class OrderController extends BaseController
{
    use HasResourceActions;

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
            $user_lang = \Config::get('const.language.' . $this->language . '.' . $this->user_page_name);
            $this->user_column_name = $user_lang['column'];
            $this->sex_text = $user_lang['sex_text'];

            return $next($request);
        });
    }

    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->edit_form($id));
    }

    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->create_form());
    }

    protected function grid()
    {
        $user_column_name = $this->user_column_name;
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
        $grid->column('o_arrival_flg', __($this->column_name['o_arrival_flg']));
        $grid->column('o_pay_flg', __($this->column_name['o_pay_flg']));
        $grid->column('o_deliver_flg', __($this->column_name['o_deliver_flg']));
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('#'));
//        $show->field('user_id', __('User id'));
        $show->field('user_name', __('會員'));
        $show->field('user_address', __('地址'));
        $show->field('o_no', __('編號'));
        $show->field('o_money', __('總額'));
        $show->field('o_discount', __('折扣'));
        $show->field('o_free_discount', __('自訂折扣'));
        $show->field('o_fee', __('運費'));
        $show->field('o_num', __('品項數'));
        $show->field('o_pay_monney', __('應付總額'));
        $show->field('arrival_flg', __('配貨狀態'));
        $show->field('pay_flg', __('付款狀態'));
        $show->field('deliver_flg', __('出貨狀態'));
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

        $form->select('user_id', __('User id'))->options(User::pluck('name', 'id'));
        $form->number('user_name', __('會員'));
        $form->number('user_address', __('地址'));
        $form->number('o_no', __('編號'));
        $form->number('o_money', __('總額'));
        $form->number('o_discount', __('折扣'));
        $form->number('o_free_discount', __('自訂折扣'));
        $form->number('o_fee', __('運費'));
        $form->number('o_num', __('品項數'));
        $form->number('o_pay_monney', __('應付總額'));
        $form->switch('arrival_flg', __('配貨狀態'));
        $form->switch('pay_flg', __('付款狀態'));
        $form->switch('deliver_flg', __('出貨狀態'));

        return $form;
    }

    protected function create_form()
    {

        $new_order_no = \Config::get('const.create_order_no');

        $users = User::get();
        return view('admin.user.order.create',compact(
            'new_order_no',
            'order',
            'users'
        ));
    }

    protected function edit_form($id = NULL)
    {

        $order = Order::find($id);
        $users = User::get();
        return view('admin.user.order.edit',compact(
            'order',
            'users'
        ));
    }
}
