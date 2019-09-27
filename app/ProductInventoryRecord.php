<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProductInventoryRecord extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'product_id',
        'product_single_id',
        'p_name',
        'ps_type',
        'admin_user_id',
        'admin_user_name',
        'pir_num',
        'pir_before_num',
        'pir_after_num',
        'pir_message'
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}
