<?php

namespace App\Presenters;

use App\Product;

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

    public function showFlg($text)
    {
        return \Config::get('const.language.' . $this->site . '.' . $this->language . '.' . $text);
    }

    public function productList()
    {
        return Product::Where('p_display_flg', Product::P_DISPLAY_FLG_ON)->get();
    }

    public function getPrice($price)
    {
        return $price . 'đ';
    }
}
