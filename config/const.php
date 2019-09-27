<?php

return [
    'language' => [
        'chinese' => [
            'product' => [
                'title' => '商品',
                'column' => [
                    'id' => '#',
                    'p_name' => '商品',
                    'p_price' => '售價',
                    'p_display_flg' => '狀態',
                    'p_image' => '圖片',
                    'updated_at' => '最後更新',
                ],
                'display_flg_option' => [
                    'on'  => ['value' => 1, 'text' => '販售中', 'color' => 'primary'],
                    'off'  => ['value' => 0, 'text' => '停售中', 'color' => 'danger'],
                ],
                'display_flg_text' => [
                    0 => '停售中',
                    1 => '販售中'
                ],
            ],
            'product_single' => [
                'title' => '單品',
                'column' => [
                    'id' => '#',
                    'product.p_name' => '商品',
                    'ps_type' => '規格',
                    'ps_price' => '售價',
                    'ps_inventory' => '庫存',
                    'ps_title' => '標題',
                    'ps_content' => '內容',
                    'ps_display_flg' => '狀態',
                    'ps_image' => '圖片',
                    'ps_href' => '連結',
                    'updated_at' => '最後更新',
                    'actions' => '操作',
                    'update_ps_inventory' => '入庫'
                ],
                'display_flg_option' => [
                    'on'  => ['value' => 1, 'text' => '販售中', 'color' => 'primary'],
                    'off'  => ['value' => 0, 'text' => '停售中', 'color' => 'danger'],
                ],
                'display_flg_text' => [
                    0 => '停售中',
                    1 => '販售中'
                ],
            ],
            'user' => [
                'title' => '會員',
                'sex_text' => [
                    0 => '女',
                    1 => '男'
                ]
            ],
            'order' => [
                'title' => '商品',
                'sex' => [
                    0 => '女',
                    1 => '男'
                ],
                'arrival_flg_text' => [
                    0 => '未配貨',
                    1 => '已配貨'
                ],
                'pay_flg_text' => [
                    0 => '未付款',
                    1 => '待確認',
                    2 => '已付款'
                ],
                'deliver_flg_text' => [
                    0 => '未出貨',
                    1 => '已出貨'
                ],
            ],
        ],
        'vietnamese' => [
            'product' => [
                'id' => '#',
                'title' => '-',
                'column' => [
                    'id' => '#',
                    'p_name' => '-',
                    'p_price' => '-',
                    'p_display_flg' => '-',
                    'p_image' => '-',
                    'updated_at' => '-',
                ],
                'display_flg_option' => [
                    'on'  => ['value' => 1, 'text' => 'ON<BR>SALE', 'color' => 'primary'],
                    'off'  => ['value' => 0, 'text' => 'OFF<BR>SALE', 'color' => 'danger'],
                ],
                'display_flg_text' => [
                    0 => 'OFF',
                    1 => 'ON'
                ],
            ],
            'product_single' => [
                'column' => [
                    'id' => '#',
                    'product.p_name' => '-',
                    'ps_type' => '-',
                    'ps_price' => '-',
                    'ps_inventory' => '-',
                    'ps_title' => '-',
                    'ps_content' => '-',
                    'ps_display_flg' => '-',
                    'ps_image' => '-',
                    'ps_href' => '-',
                    'updated_at' => '-',
                    'actions' => '-',
                    'update_ps_inventory' => '-'
                ],
                'display_flg_option' => [
                    'on'  => ['value' => 1, 'text' => 'ON<BR>SALE', 'color' => 'primary'],
                    'off'  => ['value' => 0, 'text' => 'OFF<BR>SALE', 'color' => 'danger'],
                ],
                'display_flg_text' => [
                    0 => 'OFF',
                    1 => 'ON'
                ],
            ],
            'user' => [
                'sex' => [
                    0 => '-',
                    1 => '-'
                ]
            ]
        ],
    ],
];
