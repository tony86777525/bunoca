<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Order;
use App\ProductSingle;
use App\User;
use App\Config;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class HomeController extends BaseController
{
    protected $message;
    protected $data;

    public function index()
    {
        $this->after();

        return view('user.home.index', $this->data);
    }

    public function mail_check(Request $request)
    {
        $message = '驗證失敗!';
        $check = false;

        try {
            if ($request->has('token') && $request->has('user')) {
                $user = $request->input('user');
                $token = $request->input('token');
                $user = User::where('email', $user)->first();
                if (!empty($user)) {
                    if (!is_null($user['create_token'])) {
                        if ($user['create_token'] == $token) {
                            $user->update(['create_token' => NULL]);
                            $check = true;
                            $message = '驗證成功!' . "<br>" . '來去購物吧~!';
                        } else {
                            $message .= "<br>" . '驗證碼已失效 請重新取得驗證!';
                        }
                    } else {
                        $message .= "<br>" . '會員已驗證! 來去購物吧~!';
                    }
                } else {
                    $message .= "<br>" . '無此會員!';
                }
            } else {
                $message .= "<br>" . '操作錯誤!';
            }
        }catch (Exception $e) {
            $message .= '操作錯誤!';
        }

        $this->message['message'] = $message;
        $this->message['check'] = $check;

        $this->data['message'] = $this->message;
        $this->after();
        return view('user.home.result', $this->data);
    }

    public function shopping_cart()
    {
        $order_list_data = Cookie::get('bunoca_order_list');
        $order_list = [];
        $product_single = [];

        if(!empty($order_list_data)) {
            $order_list = json_decode($order_list_data, true);

            $ps_ids = collect($order_list)->map(function ($item) {
                return $item['ps_id'];
            });

            $product_single = ProductSingle::with('product')->whereIn('id', $ps_ids)->get()->keyBy('id')->toArray();
        }

        $this->data['order_list'] = $order_list;
        $this->data['product_single'] = $product_single;
        $this->after();
        return view('user.home.shopping_cart', $this->data);
    }

    public function shopping_pay($o_no)
    {
        $order = [];
        $account = [];

        if(!empty($o_no)) {
            $order = Order::with('order_detail', 'user', 'order_detail.product_single')
                ->where('user_id', Auth::user()->id)
                ->where('o_no', $o_no)
                ->where('o_pay_flg', Order::O_PAY_FLG_OFF)
                ->first();
            $account = Config::first()->account;
        }

        if(empty($order)){
            return redirect('/home');
        }

        $this->data['order'] = $order;
        $this->data['account'] = $account;
        $this->after();
        return view('user.home.shopping_pay', $this->data);
    }

    public function order_record()
    {
        if(!empty(Auth::user()->cre)){
            return redirect('/home');
        }

        $orders = Order::with('order_detail', 'user', 'order_detail.product_single')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        $this->data['orders'] = $orders;
        $this->after();
        return view('user.home.order_record', $this->data);
    }

    public function order_detail($o_no)
    {
        $order = Order::with('order_detail', 'user', 'order_detail.product_single')->where('user_id', Auth::user()->id)->where('o_no', $o_no)->orderBy('id', 'DESC')->first();

        if(empty($order)){
            return redirect('/home');
        }

        $this->data['order'] = $order;
        $this->after();
        return view('user.home.order_detail', $this->data);
    }

    public function user()
    {
        $user = User::find(Auth::user()->id);

        $this->data['user'] = $user;
        $this->after();
        return view('user.home.user', $this->data);
    }

    private function after()
    {
        $this->data['order_list_count'] = $this->get_order_list_count();
        $this->data['unpay_order_count'] = $this->get_unpay_order_count();
    }

    private function get_order_list_count()
    {
        $count = 0;
        $bunoca_order_list = Cookie::get('bunoca_order_list');
        if($bunoca_order_list){
            $count = count(json_decode(Cookie::get('bunoca_order_list'), true));
        }

        return $count;
    }

    private function get_unpay_order_count()
    {
        $count = Order::where('user_id', Auth::user()->id)->where('o_pay_flg', Order::O_PAY_FLG_OFF)->count();

        return $count;
    }
}
