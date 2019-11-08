<?php

namespace App\Admin\Controllers;

use App\ProductCategory;
use Encore\Admin\Form;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;
use Illuminate\Routing\Controller;
use Encore\Admin\Facades\Admin;

class ProductCategoryController extends Controller
{
    use \Encore\Admin\Controllers\HasResourceActions;

    protected $page_name = 'product_category';
    protected $lang = [];
    protected $language;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $this->lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);


            return $next($request);
        });
    }
    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        $lang = $this->lang;
        return $content
            ->title($this->lang['title'])
            ->description('List')
            ->row(function (Row $row) use ($lang) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) use ($lang) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('product-categories/create'));

                    $menuModel = ProductCategory::class;

                    $form->select('pc_parent_id', $lang['column']['pc_parent_id'])->options($menuModel::selectOptions());
                    $form->text('pc_title', $lang['column']['pc_title'])->rules('required');
                    $form->text('pc_type', $lang['column']['pc_type'])->rules('required');

                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
    }

    /**
     * Redirect to edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->route('admin.auth.menu.edit', ['id' => $id]);
    }

    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        $menuModel = ProductCategory::class;
        $language = $this->language;
        return $menuModel::tree(function (Tree $tree) use ($language) {
            $tree->disableCreate();

            $tree->branch(function ($branch) use ($language) {
                $payload = $language == 'chinese' ? "<strong>{$branch['pc_title']}</strong>" : "<strong>{$branch['pc_type']}</strong>";

                return $payload;
            });
        });
    }

    /**
     * Edit interface.
     *
     * @param string  $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title($this->lang['title'])
            ->description('Edit')
            ->row($this->form()->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $menuModel = ProductCategory::class;
        $form = new Form(new $menuModel());

//        $form->display('id', 'ID');

        $form->select('pc_parent_id', $this->lang['column']['pc_parent_id'])->options($menuModel::selectOptions());
        $form->text('pc_title', $this->lang['column']['pc_title'])->rules('required');
        $form->text('pc_type', $this->lang['column']['pc_type'])->rules('required');
//        $form->display('created_at', trans('admin.created_at'));
//        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
    }

    /**
     * Help message for icon field.
     *
     * @return string
     */
    protected function iconHelp()
    {
        return 'For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>';
    }
}
