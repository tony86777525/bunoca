<?php

namespace App\Admin\Controllers;

use App\ProductInventoryRecord;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductInventoryRecordController extends BaseController
{
    protected $title = 'App\ProductInventoryRecord';
    protected $page_name = 'product_inventory_record';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $this->lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $this->lang['title'];
            $this->column_name = $this->lang['column'];
            return $next($request);
        });
    }

    protected function grid()
    {
        $grid = new Grid(new ProductInventoryRecord);

        $grid->column('id', __('Id'));
//        $grid->column('product_id', __('Product id'));
//        $grid->column('product_single_id', __('Product single id'));
        $grid->column('p_name', __($this->column_name['p_name']));
        $grid->column('ps_type', __($this->column_name['ps_type']));
        $grid->column('admin_user_id', __($this->column_name['admin_user_id']));
        $grid->column('admin_user_name', __($this->column_name['admin_user_name']));
        $grid->column('pir_num', __($this->column_name['pir_num']));
        $grid->column('pir_before_num', __($this->column_name['pir_before_num']));
        $grid->column('pir_after_num', __($this->column_name['pir_after_num']));
        $grid->column('pir_message', __($this->column_name['pir_message']));
        $grid->column('created_at', __($this->column_name['created_at']));
//        $grid->column('updated_at', __('Updated at'));
//        $grid->column('deleted_at', __('Deleted at'));

        $grid->disableCreateButton();

        $grid->filter(function ($filter){
            $filter->disableIdFilter();
            $filter->like('p_name', '商品名稱');
            $filter->like('ps_type', '單品名稱');
        });

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
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
        $show = new Show(ProductInventoryRecord::findOrFail($id));

        $show->field('id', __($this->column_name['id']));
//        $show->field('product_id', __('Product id'));
//        $show->field('product_single_id', __('Product single id'));
        $show->field('p_name', __($this->column_name['p_name']));
        $show->field('ps_type', __($this->column_name['ps_type']));
        $show->field('admin_user_id', __($this->column_name['admin_user_id']));
        $show->field('admin_user_name', __($this->column_name['admin_user_name']));
        $show->field('pir_num', __($this->column_name['pir_num']));
        $show->field('pir_before_num', __($this->column_name['pir_before_num']));
        $show->field('pir_after_num', __($this->column_name['pir_after_num']));
        $show->field('pir_message', __($this->column_name['pir_message']));
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
        $form = new Form(new ProductInventoryRecord);

//        $form->number('product_id', __('Product id'));
//        $form->number('product_single_id', __('Product single id'));
        $form->text('p_name', __($this->column_name['p_name']));
        $form->text('ps_type', __($this->column_name['ps_type']));
        $form->number('admin_user_id', __($this->column_name['admin_user_id']));
        $form->text('admin_user_name', __($this->column_name['admin_user_name']));
        $form->number('pir_num', __($this->column_name['pir_num']));
        $form->number('pir_before_num', __($this->column_name['pir_before_num']));
        $form->number('pir_after_num', __($this->column_name['pir_after_num']));
        $form->text('pir_message', __($this->column_name['pir_message']));

        return $form;
    }
}
