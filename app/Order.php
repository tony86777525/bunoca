<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Order extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_address',
        'o_no',
        'o_money',
        'o_discount',
        'o_free_discount',
        'o_fee',
        'o_num',
        'o_pay_money',
        'o_arrival_flg',
        'o_pay_flg',
        'o_deliver_flg',
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
