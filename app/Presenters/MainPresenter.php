<?php

namespace App\Presenters;

class MainPresenter  {

    protected $language;
    protected $site;

    public function setSite($site)
    {
        $this->site = $site;
    }

    public function setLanguage($language)
    {
        $this->language = $language; \Config::get('const.frontend.' . $language);
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
}
