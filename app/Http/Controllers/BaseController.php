<?php

namespace App\Http\Controllers;

use App\Presenters\MainPresenter;

use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{
    protected $mainPresenter;
    protected $site = 'frontend';
    protected $language = 'chinese';

    public function __construct(MainPresenter $mainPresenter)
    {
        $this->middleware('auth');

        $this->mainPresenter = $mainPresenter;

        $this->mainPresenter->setSite($this->site);
        $this->mainPresenter->setLanguage($this->language);
    }
}
