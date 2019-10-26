<?php

namespace App\Http\Controllers;

use App\ProductSingle;
use App\Order;
use App\OrderDetail;
use App\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

// Repository
use App\Services\MailService;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    protected $message;

    public function __construct()
    {
        $this->message = [
            'status' => false,
            'check' => false,
            'message' => '失敗',
        ];
    }

    public function send_create_check()
    {
        try{
            $user = User::find(Auth::user()->id);
            $sex_option = \Config::get('const.language.chinese.user.sex_text');
            $user->sex = $sex_option[$user->sex];
            $this->message['check'] = true;
            $this->message['message'] = MailService::send_create_token($user);
        } catch (Exception $e) {
            $this->message['message'] = '資料不正確';
        }

        return response()->json($this->message);
    }

    public function set_buy_record($id, Request $request)
    {
        $data = $request->all();
        if(!empty($id) && !empty($data['ps_id'])){
            if(!empty($data['ps_quantity'])){
                $data['ps_quantity'] = (int)$data['ps_quantity'];
                $ps = ProductSingle::where('id', $data['ps_id'])->where('product_id', $id)->exists();
                if(!empty($ps)){
                    $new_order_list = $this->set_order_list_cookie($data);
                    $this->message['check'] = true;

                    $minutes = \Config::get('const.order_list_time');
                    return response()->json($this->message)->cookie('bunoca_order_list', $new_order_list, $minutes);
                }else{
                    $this->message['message'] = '商品不存在';
                }
            }else{
                $this->message['message'] = '商品數量至少為1';
            }
        }else{
            $this->message['message'] = '資料錯誤';
        }

        return response()->json($this->message);
    }

    public function get_order_detail_price(Request $request)
    {
        $data = $request->all();
        if(!empty($data['ps_id'])){
            try {
                $ps = ProductSingle::find($data['ps_id']);
                $new_price = recalculate_order_detail_price($ps->ps_price, $data['ps_quantity']);

                $new_order_list = $this->set_order_list_cookie($data, false);
                $this->message['data'] = $new_price;
                $this->message['check'] = true;
                $this->message['message'] = '成功';

                $minutes = \Config::get('const.order_list_time');
                return response()->json($this->message)->cookie('bunoca_order_list', $new_order_list, $minutes);
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }else{
            $this->message['message'] = '商品不存在';
        }

        return response()->json($this->message);
    }

    public function delete_order_detail(Request $request)
    {
        $data = $request->all();
        if(!empty($data['ps_id'])){
            try {
                $ps = ProductSingle::find($data['ps_id']);

                $new_order_list = $this->set_order_list_cookie($data, false, true);
                $this->message['data'] = 0;
                $this->message['check'] = true;
                $this->message['message'] = '成功';

                $minutes = \Config::get('const.order_list_time');
                return response()->json($this->message)->cookie('bunoca_order_list', $new_order_list, $minutes);
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
        $old_order_list = Cookie::get('bunoca_order_list');

        if(!empty($old_order_list) && !empty($data)) {
            try {
                $order_list = json_decode($old_order_list, true);
                $ps_ids = collect($order_list)->map(function ($item) {
                    return $item['ps_id'];
                });

                $ps = ProductSingle::with('product')->whereIn('id', $ps_ids)->get()->keyBy('id')->toArray();

                $o_no = get_order_no();
                $o = new Order;
                $o->user_id = Auth::user()->id;
                $o->user_name = $data['user_name'];
                $o->user_address = $data['user_address'];
                $o->o_no = $o_no;
                $o->o_money = 0;
                $o->o_discount = 0;
                $o->o_free_discount =0;
                $o->o_fee = 0;
                $o->o_num = 0;
                $o->o_pay_money = recalculate_order_pay_money($o);
                $o->o_arrival_flg = Order::O_ARRIVAL_FLG_OFF;
                $o->o_pay_flg = Order::O_PAY_FLG_OFF;
                $o->o_deliver_flg = Order::O_DELIVER_FLG_OFF;
                $o->save();

                $iod = [];
                foreach($order_list as $ol){
                    $iod[] = [
                        'product_single_id' => $ps[$ol['ps_id']]['id'],
                        'order_id' => $o->id,
                        'od_num' => $ol['ps_quantity'],
                        'od_arrival_flg' => OrderDetail::OD_ARRIVAL_FLG_OFF,
                        'od_money' => $ps[$ol['ps_id']]['ps_price'] * $ol['ps_quantity'],
                    ];
                }
                OrderDetail::insert($iod);

                $new_o = Order::find($o->id);
                $new_o->o_money = recalculate_order_money($new_o);
                $new_o->o_pay_money = recalculate_order_pay_money($new_o);
                $new_o->save();

                $this->message['data'] = $o_no;
                $this->message['check'] = true;
                $this->message['message'] = '成功';
                return response()->json($this->message)->cookie('bunoca_order_list', '', -1);
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確或商品不存在';
            }
        }

        return response()->json($this->message);
    }

    public function shopping_pay_result(Request $request)
    {
        $data = $request->all();
        if(!empty($data['o_pay_image']) && !empty($data['o_no'])){
            $file_path = upload_image($data['o_pay_image'], 'order');
            $order_update = [];
            $order_update['o_pay_image'] = $file_path;
            $order_update['o_pay_flg'] = Order::O_PAY_FLG_ON;
            try {
                Order::where('o_no', $data['o_no'])->update($order_update);
                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確';
            }
        }

        return response()->json($this->message);
    }

    public function update_user(Request $request)
    {
        $data = $request->all();
        if(!empty(Auth::user()->id) && !empty($data)){

            $user_update = [];
            foreach($data as $name => $value){
                $user_update[$name] = $value;
            }
            try {
                User::where('id', Auth::user()->id)->update($user_update);
                $this->message['check'] = true;
                $this->message['message'] = '成功';
            } catch (Exception $e) {
                $this->message['message'] = '資料不正確';
            }
        }

        return response()->json($this->message);
    }

    private function set_order_list_cookie($data, $accumulate = true, $unset = false)
    {
        $old_order_list = Cookie::get('bunoca_order_list');
        $order_list = [];
        if(!empty($old_order_list)) {
            $order_list = json_decode($old_order_list, true);
            if(array_key_exists($data['ps_id'], $order_list)){
                if($accumulate && !$unset){
                    $order_list[$data['ps_id']]['ps_quantity'] += $data['ps_quantity'];
                }elseif(!$unset){
                    $order_list[$data['ps_id']]['ps_quantity'] = $data['ps_quantity'];
                }elseif($unset){
                    unset($order_list[$data['ps_id']]);
                }
            }else{
                $order_list[$data['ps_id']] = $data;
            }
        } elseif(!$unset) {
            $order_list[$data['ps_id']] = $data;
        }
        $new_order_list = json_encode($order_list);

        return $new_order_list;
    }

    private function upload_image($image_data)
    {
        $file = $image_data;
        $extension = $file->getClientOriginalExtension();
        $file_name = strval(time()) . str_random(5) . '.' . $extension;
        $destination_path = public_path() . '/uploads/images/';
        $file->move($destination_path, $file_name);
        $file_path = 'images/' . $file_name;

        return $file_path;
    }
}
