<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Tree;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductCategoryController extends Controller
{

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('商品分類排序');
            $content->description('description');

            $content->body(Tree::tree(function ($tree) {
                // $tree->branch(function ($branch) {
                //     $src = config('admin.upload.host') . '/image/Xefo7q71.png';
                //     $logo = "<img src='$src' style='max-width:30px;max-height:30px' class='img'/>";

                //     return "{$branch['sort']} ：{$branch['title']} $logo";
                // });
            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Tree::class, function (Grid $grid) {
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Tree::class, function (Form $form) {

            //$form->display('id', 'ID');
            $form->select('parent_id')->options(Tree::selectOptions());
            $form->text('title')->rules('required');
            //$form->display('created_at', 'Created At');
            //$form->display('updated_at', 'Updated At');
        });
    }
}
