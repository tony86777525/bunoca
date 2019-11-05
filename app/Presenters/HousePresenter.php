<?php

namespace App\Presenters;

class HousePresenter
{
    public $navbarName;
    public $navbarRouteName;

    public function setNavbarName($navbarName)
    {
        $this->navbarName = $navbarName;
    }

    public function setNavbarRouteName($navbarRouteName)
    {
        $this->navbarRouteName = $navbarRouteName;
    }

    public function getNavbarName()
    {
        return $this->navbarName;
    }

    public function getNavbarRouteName()
    {
        return $this->navbarRouteName;
    }

    public function isCurrentRouteName($routeName) : bool
    {
        return is_array($routeName) ? in_array(\Route::currentRouteName(), $routeName) : \Route::currentRouteName() == $routeName;
    }
}