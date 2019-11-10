<?php

namespace App\Presenters;

use App\Product;
use App\ProductCategory;

class MainPresenter  {

    protected $language;
    protected $site;

    public function setSite($site)
    {
        $this->site = $site;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function showText($text)
    {
        return \Config::get('const.language.' . $this->site . '.' . $this->language . '.' . $text);
    }

    public function showTextJS()
    {
        return \Config::get('const.language.' . $this->site . '.' . $this->language . '.js');
    }

    public function productList()
    {
        return Product::Where('p_display_flg', Product::P_DISPLAY_FLG_ON)->get();
    }

    public function productCategoryList()
    {
        return ProductCategory::with(
            [
                'product' => function ($query) {
                    $query->where('p_display_flg', Product::P_DISPLAY_FLG_ON);
                },
                'children' => function ($query) {
                    $query;
                },
            ]
        )->where('pc_parent_id', '0')->orderBy('pc_sort')->get()->sortBy(function ($pc, $key) {
            return $pc->pc_sort == 0 ? 9999 : $pc->pc_sort;
        });
    }

    public function getPrice($price)
    {
        return $price . 'đ';
    }
}
