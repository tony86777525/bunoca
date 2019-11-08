<?php

namespace App\Http\Controllers;

use App\Presenters\HousePresenter;

class HouseController extends BaseController
{
    private $housePresenter;

    public function __construct(HousePresenter $housePresenter)
    {
        $this->housePresenter = $housePresenter;
    }

    public function index()
    {
        return view('user.house.index');
    }

    public function smartCity()
    {
        $this->housePresenter->setNavbarName('Smart City');
        $this->housePresenter->setNavbarRouteName('smartCity');
        return view('user.house.smartCity');
    }

    public function westPoint()
    {
        $this->housePresenter->setNavbarName('West Point');
        $this->housePresenter->setNavbarRouteName('westPoint');
        return view('user.house.westPoint');
    }

    public function oceanPark()
    {
        $this->housePresenter->setNavbarName('Ocean Park');
        $this->housePresenter->setNavbarRouteName('oceanPark');
        return view('user.house.oceanPark');
    }
}
