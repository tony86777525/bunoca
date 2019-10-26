<?php

use App\Order;
const APP_URL = 'http://bunoca.tet/';
/*
 * var $admin_user is Admin::user() by Encore\Admin\Facades\Admin
 * return string
 */
function get_language($admin_user)
{
    $language = 'chinese';

    if($admin_user->isRole('vietnamese')) $language = 'vietnamese';
    if($admin_user->isRole('chinese')) $language = 'chinese';

    return $language;
}

function recalculate_order_money(Order $o)
{
    $o_money = 0;
    if(!empty($o)){
        try {
            foreach($o->order_detail as $od){
                $o_money += $od->product_single->ps_price * $od->od_num;
            }
        } catch (Exception $e) {}
    }

    return $o_money;
}

function recalculate_order_pay_money(Order $o)
{
    $o_pay_money = 0;
    if(!empty($o)){
        try {
            $less = $o->o_discount + $o->o_free_discount;
            $add = $o->o_fee;
            $o_pay_money = $o->o_money - $less + $add;
        } catch (Exception $e) {}
    }

    return $o_pay_money;
}

function recalculate_order_detail_price($ps_price = 0, $num = 0)
{
    $od_num = !empty($num) ? $num : 0 ;
    $new_price = $ps_price * $od_num;

    return $new_price;
}

function get_order_no()
{
    return date('YmdHis') . rand(100, 999);
}

function upload_image($image_data, $dir = '')
{
    $dir = $dir ? $dir . '/' : $dir;
    $file = $image_data;
    $extension = $file->getClientOriginalExtension();
    $file_name = strval(time()) . \Str::random(5) . '.' . $extension;
    $destination_path = public_path() . '/uploads/images/' . $dir;
    $file->move($destination_path, $file_name);
    $file_path = 'images/' . $dir . $file_name;

    return $file_path;
}
