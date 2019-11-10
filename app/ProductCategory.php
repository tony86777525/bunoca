<?php

namespace App;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use ModelTree, AdminBuilder;

    protected $table = 'product_categories';

    public function __construct(array $attributes = [], $product_category_text = 'vietnamese')
    {
        parent::__construct($attributes);

        $this->setParentColumn('pc_parent_id');
        $this->setOrderColumn('pc_sort');
        $lang = get_language(Admin::user());
        if($lang)
            $product_category_text = \Config::get('const.product_category_title.' . $lang);
        $this->setTitleColumn($product_category_text);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }


    public function children()
    {
        return $this->hasMany(get_class($this), 'pc_parent_id', $this->getKeyName());
    }
}
