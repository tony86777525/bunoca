<?php

namespace App\Admin\Controllers\User;

use App\Admin\Extensions\Tools\UpdateArrival;
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
    protected $od_page_name = 'order_detail';
    protected $ps_page_name = 'product_single';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $lang['title'];
            $this->column_name = $lang['column'];
            $this->o_arrival_flg_text = $lang['arrival_flg_text'];
            $this->o_pay_flg_text = $lang['pay_flg_text'];
            $this->o_deliver_flg_text = $lang['deliver_flg_text'];
            $user_lang = \Config::get('const.language.' . $this->language . '.' . $this->user_page_name);
            $this->user_column_name = $user_lang['column'];
            $this->sex_text = $user_lang['sex_text'];
            $od_lang = \Config::get('const.language.' . $this->language . '.' . $this->od_page_name);
            $this->od_column_name = $od_lang['column'];
            $this->od_arrival_flg_text = $od_lang['arrival_flg_text'];
            $ps_lang = \Config::get('const.language.' . $this->language . '.' . $this->ps_page_name);
            $this->ps_column_name = $ps_lang['column'];

            return $next($request);
        });
    }

    public function index(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('List')
            ->body($this->grid());
    }

    public function show($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Detail')
            ->body($this->detail($id));
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Edit')
            ->body($this->edit_form($id));
    }

    public function create(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Create')
            ->body($this->create_form());
    }

    protected function grid()
    {
        $user_column_name = $this->user_column_name;
        $arrival_flg_text = $this->o_arrival_flg_text;
        $pay_flg_text = $this->o_pay_flg_text;
        $deliver_flg_text = $this->o_deliver_flg_text ;
        $sex_text = $this->sex_text;
        $od_column_name = $this->od_column_name;
        $od_arrival_flg_text = $this->od_arrival_flg_text;
        $ps_column_name = $this->ps_column_name;
        $grid = new Grid(new Order);

        $grid->model()->orderBy('id', 'DESC');
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
        $grid->column($this->od_column_name['od_arrival_flg'])->expand(function () use($od_column_name, $ps_column_name, $od_arrival_flg_text) {
            $header = [$od_column_name['product_single_id'], $od_column_name['od_arrival_flg'], $od_column_name['od_money'], $od_column_name['od_num'], $ps_column_name['ps_inventory'], $od_column_name['actions']];
            $order_detail = [];

            foreach($this->order_detail as $od){
                $column = [
                    'product_single_id' => $od->product_single->product->p_name . ' - ' . $od->product_single->ps_type,
                    'od_arrival_flg' => '<span class="option' . count($od_arrival_flg_text) . '_text_' . $od->od_arrival_flg .'">' . $od_arrival_flg_text[$od->od_arrival_flg] . '</span>',
                    'od_money' => $od->od_money,
                    'od_num' => $od->od_num,
                    'ps_inventory' => $od->product_single->ps_inventory,
                ];
                if(Admin::user()->name === 'Administrator'){
                    $column['tool'] = '<form id="od-' . $od->id . '" action="#" method="POST" onsubmit="return false">'
                        . '<input type="hidden" name="id" value="' . $od->id . '">'
                        . '<button class="btn btn-danger update_od_arrival" data-id="' . $od->id . '">' . $od_column_name['arrival'] . '</button>'
                        . '</form>';
                }
                $order_detail[] = $column;
            }

            return new Table($header, $order_detail);
        }, $od_column_name['od_arrival_flg']);
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

        $grid->disableExport();
        $grid->tools(function ($tools) {
            $tools->append(new UpdateArrival());
        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
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
        if(!is_null($id)){
            $order = Order::find($id);
            $o_column_name = $this->column_name;
            $o_arrival_flg_text = $this->o_arrival_flg_text;
            $o_pay_flg_text = $this->o_pay_flg_text;
            $o_deliver_flg_text = $this->o_deliver_flg_text;
            $od_column_name = $this->od_column_name;
            $od_arrival_flg_text = $this->od_arrival_flg_text;
            $title = $this->title;
            return view('admin.user.order.detail',compact(
                [
                    'order',
                    'o_column_name',
                    'o_arrival_flg_text',
                    'o_pay_flg_text',
                    'o_deliver_flg_text',
                    'od_column_name',
                    'od_arrival_flg_text',
                ]
            ));
        }
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
        return view('admin.user.order.index',compact(
            'new_order_no',
            'order',
            'users'
        ));
    }

    protected function edit_form($id = NULL)
    {
        if(!is_null($id)){
            $order = Order::find($id);
            $users = User::get();
            $o_column_name = $this->column_name;
            $o_arrival_flg_text = $this->o_arrival_flg_text;
            $o_pay_flg_text = $this->o_pay_flg_text;
            $o_deliver_flg_text = $this->o_deliver_flg_text;
            $od_column_name = $this->od_column_name;
            $od_arrival_flg_text = $this->od_arrival_flg_text;
            $title = $this->title;
            return view('admin.user.order.edit',compact(
                [
                    'order',
                    'o_column_name',
                    'o_arrival_flg_text',
                    'o_pay_flg_text',
                    'o_deliver_flg_text',
                    'od_column_name',
                    'od_arrival_flg_text',
                    'users',
                ]
            ));
        }
    }
}
