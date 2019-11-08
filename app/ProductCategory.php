<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use ModelTree, AdminBuilder;

    protected $table = 'product_categories';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('pc_parent_id');
        $this->setOrderColumn('pc_sort');
        $this->setTitleColumn('pc_title');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
