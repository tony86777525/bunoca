<?php

namespace App\Repositories;

use App\Order;
use App\OrderDetail;
use App\ProductSingle;
use Doctrine\Common\Collections\Collection;
use App\ProductInventoryRecord;

class OrderDetailRepository
{
    protected $product_id;
    protected $product_single_id;
    protected $p_name;
    protected $ps_type;
  	protected $ps_title;
  	protected $ps_content;
    protected $order_id;
    protected $od_money;
    protected $od_num;
    protected $od_arrival;
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

    protected $od_arrival_flg;
    protected $order_detail_id;

    protected $o_no;
    protected $user_name;
    protected $user_address;
    protected $o_discount;
    protected $o_free_discount;
    protected $o_fee;
    protected $o_arrival_flg;
    protected $o_pay_flg;
    protected $o_deliver_flg;

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

    public function set_order_id($data) {
        $this->order_id = $data;
        return $this;
    }

    public function set_od_money($data) {
        $this->od_money = $data;
        return $this;
    }
    public function set_od_num($data) {
        $this->od_num = $data;
        return $this;
    }
    public function set_od_arrival($data) {
        $this->od_arrival = $data;
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

    public function set_od_arrival_flg($data) {
        $this->od_arrival_flg = $data;
        return $this;
    }

    public function set_order_detail_id($data) {
        $this->order_detail_id = $data;
        return $this;
    }

    public function od_insert() {
        $od = new OrderDetail;
        $od->product_single_id = $this->product_single_id;
        $od->order_id = $this->order_id;
        $od->od_num = $this->od_num;
        $od->od_arrival_flg = $this->od_arrival_flg;
        $od->od_money = $this->od_money;
        $od->save();
        $this->o_no = $od->order->o_no;

        if($this->od_arrival_flg == OrderDetail::OD_ARRIVAL_FLG_ON){
            $add_inventory = $this->inventory_add_or_subtract() * $this->od_num;
            $ps = ProductSingle::find($this->product_single_id);
            $old_ps_inventory = $ps->ps_inventory;
            $new_ps_inventory = $ps->ps_inventory + $add_inventory;
            $ps->ps_inventory = $new_ps_inventory;
            $ps->save();

            $this->product_single_id = $ps->id;
            $this->p_name = $ps->product->p_name;
            $this->ps_type = $ps->ps_type;
            $this->pir_num = + $add_inventory;
            $this->pir_before_num = $old_ps_inventory;
            $this->pir_after_num = $new_ps_inventory;
            $this->inventory_insert();
        }

        return true;
    }

    public function od_update() {
        $od = OrderDetail::find($this->order_detail_id);
        $old_od_arrival_flg = $od->od_arrival_flg;
        $od->od_money = $this->od_money;
        $od->od_num = $this->od_num;
        $od->od_arrival_flg = $this->od_arrival_flg;
        $od->save();
        $this->o_no = $od->order->o_no;

        if($old_od_arrival_flg != $this->od_arrival_flg){
            $add_inventory = $this->inventory_add_or_subtract() * $this->od_num;
            $ps = ProductSingle::find($this->product_single_id);

            $old_ps_inventory = $ps->ps_inventory;
            $new_ps_inventory = $ps->ps_inventory + $add_inventory;
            $ps->ps_inventory = $new_ps_inventory;
            $ps->save();

            $this->product_single_id = $ps->id;
            $this->p_name = $ps->product->p_name;
            $this->ps_type = $ps->ps_type;
            $this->pir_num = + $add_inventory;
            $this->pir_before_num = $old_ps_inventory;
            $this->pir_after_num = $new_ps_inventory;
            $this->inventory_insert();
        }

        return true;
    }

    private function inventory_insert() {
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

    private function inventory_add_or_subtract() {
        if($this->od_arrival_flg == OrderDetail::OD_ARRIVAL_FLG_ON){
            $this->pir_message = $this->o_no . ' 配貨';
            return -1 ;
        }
        if($this->od_arrival_flg == OrderDetail::OD_ARRIVAL_FLG_OFF){
            $this->pir_message = $this->o_no . ' 取消配貨';
            return 1 ;
        }
        return 0;
    }
}
