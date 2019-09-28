<?php

namespace App\Admin\Controllers\User;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $language = 'chinese';
    protected $column_name = [];

    protected $p_column_name = [];
    protected $p_display_flg_option = [];
    protected $p_display_flg_text = [];

    protected $ps_column_name = [];
    protected $ps_display_flg_option = [];
    protected $ps_display_flg_text = [];
}
