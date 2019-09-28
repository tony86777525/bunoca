<?php

namespace App\Admin\Controllers;

use App\OrderDetail;
use App\Order;
use App\ProductSingle;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class OrderDetailController extends BaseController
{
    protected $title = 'App\OrderDetail';
    protected $page_name = 'order_detail';
    protected $order_page_name = 'order';
    protected $ps_page_name = 'product_single';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $lang['title'];
            $this->column_name = $lang['column'];
            $this->arrival_flg_text = $lang['arrival_flg_text'];
            $order_lang = \Config::get('const.language.' . $this->language . '.' . $this->order_page_name);
            $this->order_column_name = $order_lang['column'];
            $ps_lang = \Config::get('const.language.' . $this->language . '.' . $this->ps_page_name);
            $this->ps_column_name = $ps_lang['column'];

            return $next($request);
        });
    }

    protected function grid()
    {
        $ps_column_name = $this->ps_column_name;
        $arrival_flg_text = $this->arrival_flg_text;
        $grid = new Grid(new OrderDetail);

        $grid->column('id', __($this->column_name['id']));
        $grid->column('order.o_no', __($this->column_name['order_id']));
        $grid->column('product_single_id', __($this->column_name['product_single_id']))->expand(function () use($ps_column_name) {
            $header = [$ps_column_name['product_id'], $ps_column_name['ps_type'], $ps_column_name['ps_price'], $ps_column_name['ps_inventory'], $ps_column_name['ps_href']];
            $column = [[
                'product_id' => $this->product_single->product->p_name,
                'ps_type' => $this->product_single->ps_type,
                'ps_price' => $this->product_single->ps_price,
                'ps_inventory' => $this->product_single->ps_inventory,
                'ps_href' => '<a href="' . $this->product_single->ps_href . '" target="_blank">前往</a>',
            ]];

            return new Table($header, $column);
        }, __($this->column_name['product_single_id']));
        $grid->column('od_money', __($this->column_name['od_money']));
        $grid->column('od_num', __($this->column_name['od_num']));
        $grid->column('od_arrival_flg', __($this->column_name['od_arrival_flg']))->display(function() use ($arrival_flg_text) {
            return '<span class="option' . count($arrival_flg_text) . '_text_' . $this->od_arrival_flg . '">' . $arrival_flg_text[$this->od_arrival_flg] . '</span>';
        });
//        $grid->column('created_at', __('Updated at'));
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
        $show = new Show(OrderDetail::findOrFail($id));

        $show->field('id', __($this->column_name['id']));
        $show->field('order_id', __($this->column_name['order_id']));
        $show->field('product_single_id', __($this->column_name['product_single_id']));
        $show->field('od_money', __($this->column_name['od_money']));
        $show->field('od_num', __($this->column_name['od_num']));
        $show->field('od_arrival_flg', __($this->column_name['od_arrival_flg']));
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
        $orders = Order::pluck('o_no', 'id');
        $product_singles = $this->getAllProductSingle();
        $form = new Form(new OrderDetail);

        $form->select('order_id', __($this->column_name['order_id']))->options($orders);
        $form->select('product_single_id', __($this->column_name['product_single_id']))->options($product_singles);
        $form->number('od_money', __($this->column_name['od_money']));
        $form->number('od_num', __($this->column_name['od_num']));
        $form->switch('od_arrival_flg', __($this->column_name['od_arrival_flg']));

        return $form;
    }

    protected function getAllProductSingle()
    {
        $data = ProductSingle::get();
        $product_singles = [];
        foreach($data as $v){
            $product_singles[$v->id] = $v->product->p_name . ' - ' . $v->ps_type;
        }

        return $product_singles;
    }
}
