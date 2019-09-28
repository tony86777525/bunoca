<?php

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
