<?php

namespace App\Repositories;

use Doctrine\Common\Collections\Collection;
use App\ProductCategory;
use Encore\Admin\Facades\Admin;

class ProductCategoryRepository
{
    public $language;

    public static function getOption() : array
    {
        $language = get_language(Admin::user());
        return ProductCategory::pluck(\Config::get('const.product_category_title.' . $language), 'id')->toArray();
    }
}
