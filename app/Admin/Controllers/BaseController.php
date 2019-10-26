<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;

class BaseController extends AdminController
{
    protected $language = 'chinese';
    protected $column_name = [];
    protected $display_flg_option = [];
    protected $display_flg_text = [];

    protected $sex_text = [];
    protected $sex_option = [];
    protected $arrival_flg_text = [];
    protected $pay_flg_text = [];
    protected $deliver_flg_text = [];
    protected $order_column_name = [];
    protected $user_column_name = [];
    protected $ps_column_name = [];
    protected $od_column_name = [];
    protected $od_arrival_flg_text = [];
}
