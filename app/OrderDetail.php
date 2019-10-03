<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrderDetail extends Authenticatable
{
    use Notifiable;

    const OD_ARRIVAL_FLG_ON = 1;
    const OD_ARRIVAL_FLG_OFF = 0;

    protected $fillable = [
        'order_id',
        'product_single_id',
        'od_money',
        'od_num',
        'od_arrival_flg',
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product_single()
    {
        return $this->belongsTo(ProductSingle::class, 'product_single_id');
    }
}
