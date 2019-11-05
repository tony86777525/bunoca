<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Authenticatable
{
    use Notifiable;

    const P_DISPLAY_FLG_ON = 1;
    const P_DISPLAY_FLG_OFF = 0;

    protected $fillable = [
        'p_name',
        'p_title',
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

    protected static function boot()
    {
        parent::boot();

        self::deleting(function($model){
            $model->product_single()->delete();
            ProductInventoryRecord::insert([
                'product_id' => $model->id,
                'product_single_id' => 0,
                'p_name' => $model->p_name,
                'ps_type' => '',
                'admin_user_id' => Admin::user()->id,
                'admin_user_name' => Admin::user()->username,
                'pir_num' => 0,
                'pir_before_num' => 0,
                'pir_after_num' => 0,
                'pir_message' => '商品刪除',
            ]);
        });
    }

    public function product_single()
    {
        return $this->hasMany(ProductSingle::class, 'product_id');
    }
}
