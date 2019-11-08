<?php

namespace App;

use Encore\Admin\Facades\Admin;
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
        'ps_sort'
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
            ProductInventoryRecord::insert([
                'product_id' => $model->product_id,
                'product_single_id' => $model->id,
                'p_name' => $model->product->p_name,
                'ps_type' => $model->ps_type,
                'admin_user_id' => Admin::user()->id,
                'admin_user_name' => Admin::user()->username,
                'pir_num' => 0,
                'pir_before_num' => 0,
                'pir_after_num' => 0,
                'pir_message' => '單品刪除',
            ]);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
