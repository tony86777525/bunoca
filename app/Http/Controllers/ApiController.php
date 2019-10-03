<?php

namespace App\Http\Controllers;

use App\Product;

use App\User;
use Encore\Admin\Facades\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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

    public function send_create_check() {
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

    public function create_product(Request $request)
    {
        $data = $request->all();

        try {
            $product_insert = [
                'p_name' => $data['p_name'],
                'p_price' => $data['p_price'],
                'p_display_flg' => $data['p_display_flg'],
            ];

            if(!empty($data['p_image'])){
                $file_path = $this->upload_image($data['p_image']);
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
                            $file_path = $this->upload_image($product_single['image']);
                            $pir->set_ps_image($file_path);
                        }

                        $pir->ps_insert();
                    }
                }

                $this->message['check'] = true;
                $this->message['message'] = '成功';
            }
            $this->message['message'] = '資料不正確';
        } catch (Exception $e) {
            $this->message['message'] = '資料不正確';
        }

        return response()->json($this->message);
    }

    private function upload_image($image_data) {
        $file = $image_data;
        $extension = $file->getClientOriginalExtension();
        $file_name = strval(time()) . str_random(5) . '.' . $extension;
        $destination_path = public_path() . '/uploads/images/';
        $file->move($destination_path, $file_name);
        $file_path = 'images/' . $file_name;

        return $file_path;
    }
}
