<?php

namespace App\Http\Controllers;

use App\Presenters\MainPresenter;

use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{
    protected $site = 'frontend';
    protected $language = 'vietnamese';

    public function __construct()
    {
        $this->middleware('auth');
        $this->mainPresenter()->setSite($this->site);
        $this->mainPresenter()->setLanguage($this->language);
    }

    public function mainPresenter() : MainPresenter
    {
        return resolve(MainPresenter::class);
    }
}
