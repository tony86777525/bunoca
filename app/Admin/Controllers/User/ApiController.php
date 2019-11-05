<?php

namespace App\Admin\Controllers\User;

use App\Order;
use App\OrderDetail;
use App\Product;
use App\ProductSingle;

use Encore\Admin\Facades\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// Repository
use App\Repositories\ProductRepository;
use App\Repositories\ProductAndInventoryRepository;
use App\Repositories\OrderDetailRepository;

class ApiController extends Controller
{
    protected $message;
    protected $language;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->language = get_language(Admin::user());

            return $next($request);
        });

        $this->message = [
            'status' => false,
            'check' => false,
            'language' => false,
            'message' => '失敗',
            'data' => NULL,
        ];
    }

    public function create_product(Request $request)
    {
        $data = $request->all();

        try {
            $product_insert = [
                'p_name' => $data['p_name'],
                'p_title' => $data['p_title'],
                'p_price' => $data['p_price'],
                'p_display_flg' => $data['p_display_flg'],
            ];

            if(!empty($data['p_image'])){
                $file_path = upload_image($data['p_image'], 'product');
                $product_insert['p_image'] = $file_path;
            }

            $id = Product::insertGetId($product_insert);

            if(!empty($id)){
                foreach($data['nps'] as $product_single){
                    if(!empty($product_single['type'])){
                        $pir = new ProductAndInventoryRepository();
                        $pir->set_product_id($id)
                            ->set_ps_type($product_single['type'])
                            ->set_ps_price($product_single['price'])
                            ->set_ps_inventory($product_single['inventory'])
                            ->set_ps_title($product_single['title'])
                            ->set_ps_content($product_single['content'])
                            ->set_ps_href($product_single['href'])
                            ->set_ps_display_flg($product_single['display_flg'])
                            ->set_admin_user_id(Admin::user()->id)
                            ->set_admin_user_name(Admin::user()->username)
                            ->set_pir_message('商品頁新增');

                        $file_path = null;
                        if(!empty($product_single['image'])){
                            $file_path = upload_image($product_single['image'], 'product');
                            $pir->set_ps_image($file_path);
                        }

                        $pir->ps_insert();
                    }
                }

                $this->message['check'] = true;
                $this->message['message'] = '成功';
                return response()->json($this->message);
            }
            $this->message['message'] = '資料不正確';
        } catch (Exception $e) {
            $this->message['message'] = '資料不正確';
        }

        return response()->json($this->message);
    }

    public function update_product(Request $request)
    {
        $data = $request->all();
        if(!empty($data['id'])){
            try {
                $product_insert = [
                    'p_name' => $data['p_name'],
                    'p_title' => $data['p_title'],
                    'p_price' => $data['p_price'],
                    'p_display_flg' => $data['p_display_flg'],
                ];

                if(!empty($data['p_image'])){
                    $file_path = upload_image($data['p_image'], 'product');
                    $product_insert['p_image'] = $file_path;
                }

                Product::where('id', $data['id'])->update($product_insert);

                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function update_product_single(Request $request)
    {

        $data = $request->all();

        if(!empty($data['id'])){
            try {
                // 新增規格
                if(!empty($data['nps'])){
                    foreach($data['nps'] as $product_single){
                        if(!empty($product_single['type'])){
                            $pir = new ProductAndInventoryRepository();
                            $pir->set_product_id($data['id'])
                                ->set_ps_price($product_single['price'])
                                ->set_ps_inventory($product_single['inventory'])
                                ->set_ps_type($product_single['type'])
                                ->set_ps_title($product_single['title'])
                                ->set_ps_content($product_single['content'])
                                ->set_ps_display_flg($product_single['display_flg'])
                                ->set_ps_href($product_single['href'])
                                ->set_admin_user_id(Admin::user()->id)
                                ->set_admin_user_name(Admin::user()->username)
                                ->set_pir_message('商品頁新增');

                            $file_path = null;
                            if(!empty($product_single['image'])){
                                $file_path = upload_image($product_single['image'], 'product_single');
                                $pir->set_ps_image($file_path);
                            }

                            $pir->ps_insert();
                        }
                    }
                }
                if(!empty($data['ps'])){
                    foreach($data['ps'] as $product_single){
                        if(!empty($product_single['type'])){
                            $pir = new ProductAndInventoryRepository();
                            $pir->set_product_single_id($product_single['id'])
                                ->set_ps_price($product_single['price'])
                                ->set_ps_add_inventory($product_single['add_inventory'])
                                ->set_ps_type($product_single['type'])
                                ->set_ps_title($product_single['title'])
                                ->set_ps_content($product_single['content'])
                                ->set_ps_href($product_single['href'])
                                ->set_ps_display_flg($product_single['display_flg'])
                                ->set_product_id($data['id'])
                                ->set_admin_user_id(Admin::user()->id)
                                ->set_admin_user_name(Admin::user()->username)
                                ->set_pir_message('商品頁修改');

                            $file_path = null;
                            if(!empty($product_single['image'])){
                                $file_path = upload_image($product_single['image'], 'product_single');
                                $pir->set_ps_image($file_path);
                            }

                            $pir->ps_update();
                        }
                    }
                }

                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function delete_product_single(Request $request)
    {
        $data = $request->all();
        if(!empty($data['id'])){
            try {
                ProductSingle::destroy($data['id']);

                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function update_ps_inventory(Request $request)
    {
        $data = $request->all();
        if(!empty($data['id'])){
            try {
                $pir = new ProductAndInventoryRepository();
                $pir->set_product_single_id($data['id'])
                    ->set_ps_add_inventory($data['inventory'])
                    ->set_admin_user_id(Admin::user()->id)
                    ->set_admin_user_name(Admin::user()->username)
                    ->set_pir_message('商品列表頁個別修改')
                    ->ps_inventory_update();

                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function update_od_arrival(Request $request)
    {
        $data = $request->all();
        if(!empty($data['id'])){
            try {
                $order_detail = OrderDetail::find($data['id']);
                if(!empty($order_detail) && !empty($order_detail->product_single)){
                    if($order_detail->od_arrival_flg == OrderDetail::OD_ARRIVAL_FLG_ON){
                        $inventory_number = 1;
                        $pir_message = $order_detail->order->o_no . ' 取消配貨';
                        $od_arrival_flg = OrderDetail::OD_ARRIVAL_FLG_OFF;
                    }else{
                        $inventory_number = -1;
                        $pir_message = $order_detail->order->o_no . ' 配貨';
                        $od_arrival_flg = OrderDetail::OD_ARRIVAL_FLG_ON;
                    }
                    $inventory_number = $inventory_number * $order_detail->od_num;
                    $pir = new ProductAndInventoryRepository();

                    $pir->set_product_single_id($order_detail->product_single->id)
                        ->set_ps_add_inventory($inventory_number)
                        ->set_admin_user_id(Admin::user()->id)
                        ->set_admin_user_name(Admin::user()->username)
                        ->set_pir_message($pir_message)
                        ->ps_inventory_update();

                    $order_detail->update(['od_arrival_flg' => $od_arrival_flg]);
                    $o = Order::find($order_detail->order_id);
                    $o->o_arrival_flg = $this->get_order_arrival_flg($o);
                    $o->save();

                    $this->message['check'] = true;
                    $this->message['message'] = '成功';
                }

            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '訂單不存在';
        }

        return response()->json($this->message);
    }

    public function get_order_detail_price(Request $request)
    {
        $data = $request->all();
        if(!empty($data['ps_id'])){
            try {
                $ps = ProductSingle::find($data['ps_id']);
                $new_price = recalculate_order_detail_price($ps->ps_price, $data['od_num']);
                $this->message['data'] = $new_price;
                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function create_order(Request $request)
    {
        $data = $request->all();

        try {
            $o = new Order;

            $o->user_id = $data['user_id'];
            $o->user_name = $data['user_name'];
            $o->user_address = $data['user_address'];
            $o->o_no = get_order_no();
            $o->o_money = 0;
            $o->o_discount = 0;
            $o->o_free_discount = $data['o_free_discount'];
            $o->o_fee = $data['o_fee'];
            $o->o_num = 0;
            $o->o_pay_money = recalculate_order_pay_money($o);
            $o->o_arrival_flg = Order::O_ARRIVAL_FLG_OFF;
            $o->o_pay_flg = Order::O_PAY_FLG_OFF;
            $o->o_deliver_flg = Order::O_DELIVER_FLG_OFF;
            $o->save();

            $this->message['data'] = $o->id;
            $this->message['check'] = true;
            $this->message['message'] = '成功';
        } catch (Exception $e) {
            $this->message['message'] = '資料不正確';
        }

        return response()->json($this->message);
    }

    public function create_order_detail($id, Request $request)
    {
        $data = $request->all();

        if(!empty($id)){
            try {
                $od_data = $data['nod'];
                $ps = ProductSingle::find($od_data['product_single_id']);
                $new_price = recalculate_order_detail_price($ps->ps_price, $od_data['od_num']);
                $nod = new OrderDetailRepository();
                $nod->set_product_id($ps->product_id)
                    ->set_product_single_id($od_data['product_single_id'])
                    ->set_ps_type($ps->ps_type)
                    ->set_order_id($id)
                    ->set_od_num($od_data['od_num'])
                    ->set_od_arrival_flg($od_data['od_arrival_flg'])
                    ->set_od_money($new_price)
                    ->set_admin_user_id(Admin::user()->id)
                    ->set_admin_user_name(Admin::user()->username)
                    ->od_insert();

                $o = Order::find($id);
                $o->o_money = recalculate_order_money($o);
                $o->o_pay_money = recalculate_order_pay_money($o);
                $o->o_arrival_flg = $this->get_order_arrival_flg($o);
                $o->save();

                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function update_order_and_detail($id, Request $request)
    {
        $data = $request->all();

        if(!empty($id)){
            try {
                $o = Order::find($id);
                if(!empty($data['od'])){
                    foreach($o->order_detail as $od){
                        if(!empty($data['od'][$od['id']])){
                            $od_data = $data['od'][$od['id']];
                            $new_price = recalculate_order_detail_price($od->product_single->ps_price, $od_data['od_num']);
                            $nod = new OrderDetailRepository();
                            $nod->set_product_id($od->product_single->product_id)
                                ->set_product_single_id($od->product_single_id)
                                ->set_order_detail_id($od_data['id'])
                                ->set_od_money($new_price)
                                ->set_od_num($od_data['od_num'])
                                ->set_od_arrival_flg($od_data['od_arrival_flg'])
                                ->set_admin_user_id(Admin::user()->id)
                                ->set_admin_user_name(Admin::user()->username)
                                ->od_update();
                        }
                    }
                }

                $o = Order::find($id);
                $o->user_name = $data['user_name'];
                $o->user_address = $data['user_address'];
                $o->o_discount = $data['o_discount'];
                $o->o_free_discount = $data['o_free_discount'];
                $o->o_fee = $data['o_fee'];
                $o->o_arrival_flg = $this->get_order_arrival_flg($o);
                $o->o_pay_flg = $data['o_pay_flg'];
                $o->o_deliver_flg = $data['o_deliver_flg'];
                $o->o_money = recalculate_order_money($o);
                $o->o_pay_money = recalculate_order_pay_money($o);
                $o->save();

                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function delete_order_detail($id, Request $request)
    {
        $data = $request->all();

        if(!empty($id)){
            try {
                if(!empty($data['od_id'])){
                    OrderDetail::where('id', $data['od_id'])->delete();


                    $o = Order::find($id);
                    $o->o_arrival_flg = $this->get_order_arrival_flg($o);
                    $o->o_money = recalculate_order_money($o);
                    $o->o_pay_money = recalculate_order_pay_money($o);
                    $o->save();

                    $this->message['check'] = true;
                    $this->message['message'] = '成功';
                }
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或訂單商品不存在';
            }
        }else{
            $this->message['message'] = '訂單不存在';
        }

        return response()->json($this->message);
    }

    public function get_all_product()
    {
        try {
            $p = Product::where('p_display_flg', Product::P_DISPLAY_FLG_ON)->whereHas('product_single', function ($query) {
                $query->where('ps_display_flg', ProductSingle::PS_DISPLAY_FLG_ON);
            })->with('product_single')->get();

            $this->message['data']['p'] = $p;
            $this->message['data']['language'] = $this->language;
            $this->message['check'] = true;
            $this->message['message'] = '成功';
        } catch (Exception $e) {
            $this->message['message'] = '資料不正確';
        }

        return response()->json($this->message);
    }

    private function get_order_arrival_flg(Order $o)
    {
        if(empty($o->order_detail)){
            return Order::O_ARRIVAL_FLG_OFF;
        }

        $o_arrival_flg = Order::O_ARRIVAL_FLG_ON;
        foreach($o->order_detail as $od){
            if($od->od_arrival_flg == OrderDetail::OD_ARRIVAL_FLG_OFF){
                $o_arrival_flg = Order::O_ARRIVAL_FLG_OFF;
            }
        }

        return $o_arrival_flg;
    }
}
