<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'p_name',
        'p_price',
        'p_display_flg',
        'p_image'
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function product_single()
    {
        return $this->hasMany(ProductSingle::class, 'product_id');
    }
}
