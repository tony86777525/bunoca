<?php

namespace App\Admin\Controllers\User;

use App\Product;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

use Encore\Admin\Widgets\Table;

use App\Admin\Extensions\Tools\UpdateInventory;

class ProductController extends BaseController
{
    use HasResourceActions;

    protected $title = 'App\ProductInventoryRecord';
    protected $page_name = 'product';
    protected $ps_page_name = 'product_single';

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());
            $p_lang = \Config::get('const.language.' . $this->language . '.' . $this->page_name);
            $this->title = $p_lang['title'];
            $this->p_column_name = $p_lang['column'];
            $this->p_display_flg_option = $p_lang['display_flg_option'];
            $this->p_display_flg_text = $p_lang['display_flg_text'];
            $ps_lang = \Config::get('const.language.' . $this->language . '.' . $this->ps_page_name);
            $this->ps_column_name = $ps_lang['column'];
            $this->ps_display_flg_option = $ps_lang['display_flg_option'];
            $this->ps_display_flg_text = $ps_lang['display_flg_text'];

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

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Detail')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Edit')
            ->body($this->edit_form($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('Create')
            ->body($this->create_form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $ps_column_name = $this->ps_column_name;
        $p_column_name = $this->p_column_name;
        $p_display_flg_text = $this->p_display_flg_text;
        $ps_display_flg_text = $this->ps_display_flg_text;
        $grid = new Grid(new Product);

        $grid->model()->orderBy('id', 'DESC');
        $grid->id('#');
        $grid->p_name($this->p_column_name['p_name']);
        $grid->p_price($this->p_column_name['p_price']);
        $grid->p_display_flg($this->p_column_name['p_display_flg'])->display(function() use ($p_display_flg_text) {
            return '<span class="option' . count($p_display_flg_text) . '_text_' . $this->p_display_flg .'">' . $p_display_flg_text[$this->p_display_flg] . '</span>';
        });

        $grid->column($this->ps_column_name['ps_inventory'])->expand(function () use($ps_column_name, $ps_display_flg_text) {
            $header = [$ps_column_name['ps_type'], $ps_column_name['ps_price'], $ps_column_name['ps_inventory'], $ps_column_name['ps_display_flg'], $ps_column_name['actions']];
            $product_single = [];
            foreach($this->product_single as $ps){
                $column = [
                    'ps_type' => $ps->ps_type,
                    'ps_price' => $ps->ps_price,
                    'ps_inventory' => $ps->ps_inventory,
                    'ps_display_flg' => '<span class="option' . count($ps_display_flg_text) . '_text_' . $ps->ps_display_flg .'">' . $ps_display_flg_text[$ps->ps_display_flg] . '</span>',
                ];
                if(Admin::user()->name === 'Administrator'){
                    $column['tool'] = '<form id="ps-' . $ps->id . '" action="#" method="POST" onsubmit="return false">'
                        . '<input type="hidden" name="id" value="' . $ps->id . '">'
                        . '<input type="text" name="inventory" style="padding-bottom: 5px;margin-right: 0.9em;">'
                        . '<button class="btn btn-danger update_ps_inventory" data-id="' . $ps->id . '">' . $ps_column_name['update_ps_inventory'] . '</button>'
                        . '</form>';
                }
                $product_single[] = $column;
            }

            return new Table($header, $product_single);
        }, $ps_column_name['ps_inventory']);
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');
        // $grid->deleted_at('Deleted at');
        $grid->actions(function ($actions) {
            // $actions->disableView();
            if(Admin::user()->name !== 'Administrator'){
                $actions->disableEdit();
                $actions->disableDelete();
            }
        });

        $grid->disableExport();
        if(Admin::user()->name !== 'Administrator') {
            $grid->disableCreateButton();
        }

        $grid->tools(function ($tools) {
            $tools->append(new UpdateInventory());
        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->filter(function ($filter) use ($p_column_name, $ps_column_name) {
            $filter->disableIdFilter();
            $filter->like('p_name', $p_column_name['p_name']);
            $filter->where(function ($query) {
                $query->whereHas('product_single', function ($query) {
                    $query->where('ps_type', 'like', "%{$this->input}%");
                });
            }, $ps_column_name['ps_type']);
            $filter->where(function ($query) {
                $query->whereHas('product_single', function ($query) {
                    $query->where('ps_inventory', '<=', "{$this->input}");
                });
            }, $ps_column_name['ps_inventory'] . ' ＜');
        });
        return $grid;
    }

    protected function create_form()
    {
        return view('admin.user.product.create');
    }

    protected function edit_form($id = NULL)
    {
        if(!is_null($id)){
            $product = Product::find($id);
            $p_column_name = $this->p_column_name;
            $ps_column_name = $this->ps_column_name;
            $p_display_flg_text = $this->p_display_flg_text;
            $ps_display_flg_text = $this->ps_display_flg_text;

            return view('admin.user.product.edit',compact(
                [
                    'product',
                    'p_column_name',
                    'ps_column_name',
                    'p_display_flg_text',
                    'ps_display_flg_text',
                ]
            ));
        }
    }

    protected function detail($id = NULL)
    {
        if(!is_null($id)){
            $product = Product::find($id);
            $ps_column_name = $this->ps_column_name;
            $p_column_name = $this->p_column_name;
            $p_display_flg_text = $this->p_display_flg_text;
            $ps_display_flg_text = $this->ps_display_flg_text;

            return view('admin.user.product.detail',compact(
                [
                    'product',
                    'p_column_name',
                    'ps_column_name',
                    'p_display_flg_text',
                    'ps_display_flg_text'
                ]
            ));
        }
    }
}
