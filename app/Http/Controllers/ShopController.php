<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductSingle;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ShopController extends BaseController
{
    use AuthenticatesUsers;

    const P_DISPLAY_FLG_ON = 1;

    public function index($id)
    {
        if(!empty($id)){
            $product = Product::with(['product_single' => function ($query) {
                $query->orderBy('ps_sort', 'DESC')->orderBy('id', 'DESC');
            }])->where('id', $id)->Where('p_display_flg', Product::P_DISPLAY_FLG_ON)->whereHas('product_single', function ($query) {
                $query->where('ps_display_flg', ProductSingle::PS_DISPLAY_FLG_ON);
            })->first();

            if(!empty($product)){
                return view('user.shop.index', [
                    'product' => $product
                ]);
            }
        }

        return redirect()->route('index');
    }
}
