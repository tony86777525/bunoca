<?php

namespace App\Admin\Controllers;

use App\Product;
use App\ProductSingle;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductSingleController extends BaseController
{
    protected $title = 'App\ProductSingle';
    protected $page_name = 'product_single';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $this->lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $this->lang['title'];
            $this->column_name = $this->lang['column'];
            $this->display_flg_option = $this->lang['display_flg_option'];
            $this->display_flg_text = $this->lang['display_flg_text'];
            return $next($request);
        });
    }

    protected function grid()
    {
        $grid = new Grid(new ProductSingle);

        $grid->column('id', __($this->column_name['id']));
        $grid->column('product.p_name', __($this->column_name['product_id']));
        $grid->column('ps_type', __($this->column_name['ps_type']));
        $grid->column('ps_price', __($this->column_name['ps_price']));
        $grid->column('ps_inventory', __($this->column_name['ps_inventory']));
        $grid->column('ps_title', __($this->column_name['ps_title']));
//        $grid->column('ps_content', __('Ps content'));
        $grid->column('ps_display_flg', __($this->column_name['ps_display_flg']))->switch($this->display_flg_option);
        $grid->column('ps_href', __($this->column_name['ps_href']))->display(function(){
            return $this->ps_href ? '<a href="' . $this->ps_href . '" target="_blank">GO</a>' : 'NONE';
        });
//        $grid->column('ps_image', __('Ps image'));
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
        $products = Product::pluck('p_name', 'id');
        $show = new Show(ProductSingle::findOrFail($id));

        $show->field('id', __($this->column_name['id']));
        $show->field('product_id', __($this->column_name['product_id']))->as(function () use ($products) {
            return  $products[$this->product_id];
        });
        $show->field('ps_type', __($this->column_name['ps_type']));
        $show->field('ps_price', __($this->column_name['ps_price']));
        $show->field('ps_inventory', __($this->column_name['ps_inventory']));
        $show->field('ps_title', __($this->column_name['ps_title']));
        $show->field('ps_content', __($this->column_name['ps_content']));
        $show->field('ps_display_flg', __($this->column_name['ps_display_flg']))->as(function () use ($display_flg_text) {
            return $display_flg_text[$this->ps_display_flg];
        });
        $show->field('ps_image', __($this->column_name['ps_image']))->image();
        $show->field('ps_href', __($this->column_name['ps_href']));
//        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __($this->column_name['updated_at']));
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
        $products = Product::pluck('p_name', 'id');
        $form = new Form(new ProductSingle);

        $form->select('product_id', __($this->column_name['product_id']))->options($products);
        $form->text('ps_type', __($this->column_name['ps_type']));
        $form->number('ps_price', __($this->column_name['ps_price']));
        $form->number('ps_inventory', __($this->column_name['ps_inventory']));
        $form->text('ps_title', __($this->column_name['ps_title']));
        // $form->textarea('ps_content', __($this->column_name['ps_content']));
        $form->ckeditor('ps_content');
        $form->switch('ps_display_flg', __($this->column_name['ps_display_flg']))->options($this->display_flg_option);
        $form->image('ps_image', $this->column_name['ps_image'])->uniqueName();
        $form->text('ps_href', __($this->column_name['ps_href']));

        return $form;
    }
}
