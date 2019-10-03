<?php

namespace App\Repositories;

use Doctrine\Common\Collections\Collection;
use App\ProductSingle;
use App\ProductInventoryRecord;

class ProductInventoryRepository
{
    protected $product_id;
    protected $product_single_id;
    protected $p_name;
    protected $ps_type;
  	protected $ps_title;
  	protected $ps_content;
    protected $admin_user_id;
    protected $admin_user_name;
    protected $pir_num;
    protected $pir_before_num;
    protected $pir_after_num;
    protected $pir_message;

    protected $ps_price;
    protected $ps_inventory;
    protected $ps_display_flg;
    protected $ps_image;

    protected $ps_add_inventory;

    public function set_product_id($data) {
        $this->product_id = $data;
        return $this;
    }

    public function set_product_single_id($data) {
        $this->product_single_id = $data;
        return $this;
    }

    public function set_p_name($data) {
        $this->p_name = $data;
        return $this;
    }

    public function set_ps_type($data) {
        $this->ps_type = $data;
        return $this;
    }

    public function set_ps_title($data) {
        $this->ps_title = $data;
        return $this;
    }

    public function set_ps_content($data) {
        $this->ps_content = $data;
        return $this;
    }

    public function set_admin_user_id($data) {
        $this->admin_user_id = $data;
        return $this;
    }

    public function set_admin_user_name($data) {
        $this->admin_user_name = $data;
        return $this;
    }

    public function set_pir_num($data) {
        $this->pir_num = $data;
        return $this;
    }

    public function set_pir_before_num($data) {
        $this->pir_before_num = $data;
        return $this;
    }

    public function set_pir_after_num($data) {
        $this->pir_after_num = $data;
        return $this;
    }

    public function set_pir_message($data) {
        $this->pir_message = $data;
        return $this;
    }

    public function set_ps_price($data) {
        $this->ps_price = $data;
        return $this;
    }

    public function set_ps_inventory($data) {
        $this->ps_inventory = $data;
        return $this;
    }

    public function set_ps_add_inventory($data) {
        $this->ps_add_inventory = $data;
        return $this;
    }

    public function set_ps_display_flg($data) {
        $this->ps_display_flg = $data;
        return $this;
    }

    public function set_ps_href($data) {
        $this->ps_href = $data;
        return $this;
    }

    public function set_ps_image($data) {
        $this->ps_image = $data;
        return $this;
    }

    public function ps_insert() {
        $ps_id = ProductSingle::insertGetId([
            'product_id' => $this->product_id,
            'ps_price' => $this->ps_price,
            'ps_inventory' => $this->ps_inventory,
            'ps_type' => $this->ps_type,
            'ps_title' => $this->ps_title,
            'ps_content' => $this->ps_content,
            'ps_display_flg' => $this->ps_display_flg,
            'ps_href' => $this->ps_href,
            'ps_image' => $this->ps_image
        ]);

        $ps = ProductSingle::find($ps_id);
        $this->product_single_id = $ps->id;
        $this->p_name = $ps->product->p_name;
        $this->ps_inventory = $ps->ps_inventory;
        $this->pir_num = $this->ps_inventory;
        $this->pir_before_num = 0;
        $this->pir_after_num = $this->ps_inventory;

        if($this->pir_num != 0){
            ProductInventoryRecord::insert([
                'product_id' => $this->product_id,
                'product_single_id' => $this->product_single_id,
                'p_name' => $this->p_name,
                'ps_type' => $this->ps_type,
                'admin_user_id' => $this->admin_user_id,
                'admin_user_name' => $this->admin_user_name,
                'pir_num' => $this->pir_num,
                'pir_before_num' => $this->pir_before_num,
                'pir_after_num' => $this->pir_after_num,
                'pir_message' => $this->pir_message,
            ]);
        }

        return true;
    }

    public function ps_update() {
        $ps = ProductSingle::find($this->product_single_id);
        $this->p_name = $ps->product->p_name;
        // $this->ps_no = $ps->ps_no;
        $this->ps_inventory = $ps->ps_inventory + $this->ps_add_inventory;
        $this->pir_num = $this->ps_add_inventory;
        $this->pir_before_num = $ps->ps_inventory;
        $this->pir_after_num = $ps->ps_inventory + $this->ps_add_inventory;

        $update_array = [
            'ps_price' => $this->ps_price,
            'ps_inventory' => $this->ps_inventory,
            'ps_type' => $this->ps_type,
            'ps_display_flg' => $this->ps_display_flg,
            'ps_title' => $this->ps_title,
            'ps_content' => $this->ps_content,
            'ps_href' => $this->ps_href,
        ];
        if(isset($this->ps_image)) $update_array['ps_image'] = $this->ps_image;

        ProductSingle::where('id', $this->product_single_id)->update($update_array);

        if($this->pir_num != 0){
            ProductInventoryRecord::insert([
                'product_id' => $this->product_id,
                'product_single_id' => $this->product_single_id,
                'p_name' => $this->p_name,
                'ps_type' => $this->ps_type,
                'admin_user_id' => $this->admin_user_id,
                'admin_user_name' => $this->admin_user_name,
                'pir_num' => $this->pir_num,
                'pir_before_num' => $this->pir_before_num,
                'pir_after_num' => $this->pir_after_num,
                'pir_message' => $this->pir_message,
            ]);
        }

        return true;
    }

    public function ps_inventory_update() {
        $ps = ProductSingle::find($this->product_single_id);
        $this->product_id = $ps->product->id;
        $this->p_name = $ps->product->p_name;
        $this->ps_type = $ps->ps_type;
        $this->ps_inventory = $ps->ps_inventory + $this->ps_add_inventory;
        $this->pir_num = $this->ps_add_inventory;
        $this->pir_before_num = $ps->ps_inventory;
        $this->pir_after_num = $ps->ps_inventory + $this->ps_add_inventory;

        ProductSingle::where('id', $this->product_single_id)->increment('ps_inventory', $this->ps_add_inventory);

        if($this->pir_num != 0){
            ProductInventoryRecord::insert([
                'product_id' => $this->product_id,
                'product_single_id' => $this->product_single_id,
                'p_name' => $this->p_name,
                'ps_type' => $this->ps_type,
                'admin_user_id' => $this->admin_user_id,
                'admin_user_name' => $this->admin_user_name,
                'pir_num' => $this->pir_num,
                'pir_before_num' => $this->pir_before_num,
                'pir_after_num' => $this->pir_after_num,
                'pir_message' => $this->pir_message,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return true;
    }
}
