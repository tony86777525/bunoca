<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProductCategory extends Authenticatable
{
    use Notifiable;

    protected $table = 'product_categories';

    protected $fillable = [
        'parent_id', 'title'
    ];
}
