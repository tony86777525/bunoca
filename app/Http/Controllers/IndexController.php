<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductSingle;
//use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::Where('p_display_flg', Product::P_DISPLAY_FLG_ON)->get();

        return view('index', [
            'page' => 'index',
            'products' => $products,
        ]);
    }
}
