<?php

namespace App\Admin\Controllers\User;

use App\Product;
use App\ProductSingle;

use Encore\Admin\Facades\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// Repository
use App\Repositories\ProductRepository;
use App\Repositories\ProductAndInventoryRepository;

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

    public function update_product(Request $request)
    {
        $data = $request->all();
        if(!empty($data['id'])){
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
                                $file_path = $this->upload_image($product_single['image']);
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
                                $file_path = $this->upload_image($product_single['image']);
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

    public function delete_product($id, Request $request)
    {
        if(!empty($id)){
            try {
                $p = new ProductRepository();
                $p->set_product_ids($id)->p_delete();

                $this->message['check'] = true;
                $this->message['status'] = true;
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
                ProductSingle::where('id', $data['id'])->delete();

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
