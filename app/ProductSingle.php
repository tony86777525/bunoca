<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProductSingle extends Authenticatable
{
    use Notifiable;

    const PS_DISPLAY_FLG_ON = 1;
    const PS_DISPLAY_FLG_OFF = 0;

    protected $fillable = [
        'product_id',
        'ps_type',
        'ps_price',
        'ps_inventory',
        'ps_title',
        'ps_content',
        'ps_display_flg',
        'ps_image',
        'ps_href',

    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
