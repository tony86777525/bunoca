<?php

namespace App\Repositories;

use Doctrine\Common\Collections\Collection;
use App\Product;
use App\ProductSingle;

class ProductRepository
{
    protected $product_ids;

    public function set_product_ids($data) {
        $this->product_ids = explode(',', $data);
        return $this;
    }

    public function p_delete() {

        ProductSingle::whereIn('product_id', $this->product_ids)->delete();
        Product::whereIn('id', $this->product_ids)->delete();

        return true;
    }
}
