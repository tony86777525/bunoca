<?php

return [
    'order_list_time' => 7*24*60,
    'language' => [
        'chinese' => [
            'user' => [
                'title' => '會員',
                'column' => [
                    'id' => '#',
                    'name' => '姓名',
                    'sex' => '性別',
                    'address' => '地址',
                    'phone' => '電話',
                    'email' => '信箱',
                    'times' => '登入次數',
                    'updated_at' => '最後登入',
                ],
                'sex_text' => [
                    0 => '女',
                    1 => '男'
                ],
                'sex_option' => [
                    'on'  => ['value' => 1, 'text' => '男', 'color' => 'primary'],
                    'off'  => ['value' => 0, 'text' => '女', 'color' => 'danger'],
                ],
            ],
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
                    'product_id' => '商品',
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
            'product_inventory_record' => [
                'title' => '庫存紀錄',
                'column' => [
                    'id' => '#',
                    'p_name' => '商品',
                    'ps_type' => '規格',
                    'admin_user_id' => '操作者ID',
                    'admin_user_name' => '操作者',
                    'pir_num' => '入庫',
                    'pir_before_num' => '入庫前',
                    'pir_after_num' => '入庫後',
                    'pir_message' => '備註',
                    'ps_href' => '連結',
                    'created_at' => '時間',
                ],
            ],
            'order' => [
                'title' => '訂單',
                'column' => [
                    'id' => '#',
                    'user_id' => '會員',
                    'user_name' => '收件姓名',
                    'user_address' => '收件地址',
                    'o_no' => '訂單編號',
                    'o_money' => '訂單總額',
                    'o_discount' => '訂單折扣',
                    'o_free_discount' => '自訂折扣',
                    'o_fee' => '運費',
                    'o_num' => '品項',
                    'o_pay_money' => '應付總額',
                    'o_arrival_flg' => '配貨狀態',
                    'o_pay_flg' => '付款狀態',
                    'o_deliver_flg' => '出貨狀態',
                    'created_at' => '成單時間',
                ],
                'sex' => [
                    0 => '女',
                    1 => '男'
                ],
                'arrival_flg_text' => [
                    0 => '未配貨',
                    1 => '全配貨'
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
            'order_detail' => [
                'title' => '訂單明細',
                'column' => [
                    'id' => '#',
                    'order_id' => '訂單',
                    'product_single_id' => '單品',
                    'od_num' => '數量',
                    'od_money' => '總額',
                    'od_ps_price' => '單價',
                    'od_arrival_flg' => '配貨狀態',
                    'actions' => '操作',
                    'arrival' => '配貨',
                ],
                'arrival_flg_text' => [
                    0 => '未配貨',
                    1 => '已配貨'
                ],
            ],
            'config' => [
                'title' => '設定',
                'column' => [
                    'id' => '#',
                    'account' => '帳戶',
                ],
            ],
        ],
        'vietnamese' => [
            'user' => [
                'title' => '-',
                'column' => [
                    'id' => '#',
                    'name' => '-',
                    'sex' => '-',
                    'address' => '-',
                    'phone' => '-',
                    'email' => '-',
                    'times' => '-',
                    'updated_at' => '-',
                ],
                'sex_text' => [
                    0 => '-',
                    1 => '-'
                ]
            ],
            'product' => [
                'title' => '-',
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
                'title' => '-',
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
            'product_inventory_record' => [
                'title' => '-',
                'column' => [
                    'id' => '#',
                    'p_name' => '-',
                    'ps_type' => '-',
                    'admin_user_id' => '-',
                    'admin_user_name' => '-',
                    'pir_num' => '-',
                    'pir_before_num' => '-',
                    'pir_after_num' => '-',
                    'pir_message' => '-',
                    'ps_href' => '-',
                    'created_at' => '-',
                ],
            ],
            'order' => [
                'title' => '-',
                'column' => [
                    'id' => '#',
                    'user_id' => 'users',
                    'user_name' => '-',
                    'user_address' => '-',
                    'o_no' => '-',
                    'o_money' => '-',
                    'o_discount' => '-',
                    'o_free_discount' => '-',
                    'o_fee' => '-',
                    'o_num' => '-',
                    'o_pay_money' => '-',
                    'o_arrival_flg' => 'o_arrival_flg',
                    'o_pay_flg' => '-',
                    'o_deliver_flg' => '-',
                    'created_at' => '-'
                ],
                'sex' => [
                    0 => '-',
                    1 => '-'
                ],
                'arrival_flg_text' => [
                    0 => '-',
                    1 => '-'
                ],
                'pay_flg_text' => [
                    0 => '-',
                    1 => '-',
                    2 => '-'
                ],
                'deliver_flg_text' => [
                    0 => '-',
                    1 => '-'
                ],
            ],
            'order_detail' => [
                'title' => '-',
                'column' => [
                    'id' => '#',
                    'order_id' => '-',
                    'product_single_id' => '-',
                    'od_num' => '-',
                    'od_money' => '-',
                    'od_ps_price' => '-',
                    'od_arrival_flg' => 'arrival',
                    'actions' => '-',
                    'arrival' => '-',
                ],
                'arrival_flg_text' => [
                    0 => '-',
                    1 => '-'
                ],
            ],
            'config' => [
                'title' => '-',
                'column' => [
                    'id' => '#',
                    'account' => '-',
                ],
            ],
        ],

        'frontend' => [
            'chinese' => [
                'message' => '訊息',
                'goIndex' => '回首頁',
                'userMailCheck' => '會員驗證',
                'userMailUncheck' => '尚未通過會員驗證',
                'userMailChecked' => '已通過會員驗證',
                'finish' => '完成',

                'active' => '操作',
                'toOrderDetail' => '明細',
                'toOrderPay' => '付款',

                'user' => '會員中心',
                'userName' => '收件人',
                'userPhone' => '電話',
                'userEmail' => 'Email',
                'userAddress' => '收件地址',
                'userSexType' => '性別',
                'userSex' => [
                    0 => '女',
                    1 => '男'
                ],

                'userLoginTimes' => '次登入',
                'userToChange' => '修改',
                'userToRevert' => '還原',
                'userToSave' => '確定',

                'shoppingCart' => '購物車',
                'shoppingCartToPay' => '前往付款',
                'shoppingCartNoCount' => '購物車內尚無商品',
                'shoppingCartUnPay' => '項商品未結帳',

                'orderNo' => '訂單編號',
                'orderPay' => '付款',
                'orderCount' => '項訂單',
                'orderLittleTotal' => '小計',
                'orderMoney' => '訂單總額',
                'orderNoCount' => '尚無訂單',
                'orderPayTo' => '請匯款至',
                'orderPayAndUpload' => '上傳匯款紀錄的照片',
                'orderPayType' => '付款狀態',
                'orderPayFlg' => [
                    0 => '未付款',
                    1 => '待確認',
                    2 => '已付款'
                ],
                'orderDeliverType' => '付款狀態',
                'orderDeliverFlg' => [
                    0 => '待出貨',
                    1 => '已出貨'
                ],

                'OrderDetail' => '訂單明細',
                'orderDetailCount' => '項商品',
                'orderDetailType' => '商品',
                'orderDetailNum' => '數量',
                'orderDetailMoney' => '價錢',

                'orderRecord' => '訂單紀錄',
            ],
            'vietnamese' => [
                'message' => 'Tin nhắn',
                'goIndex' => 'Trở về nhà',
                'userMailCheck' => 'Xác minh thành viên',
                'userMailUncheck' => 'Không được xác minh bởi thành viên',
                'userMailChecked' => 'Xác nhận bởi thành viên',
                'finish' => 'Hoàn thành',

                'active' => 'Hoạt động',
                'toOrderDetail' => 'Chi tiết',
                'toOrderPay' => 'Thanh toán',

                'user' => 'Trung tâm thành viên',
                'userName' => 'Người nhận',
                'userPhone' => 'Điện thoại',
                'userEmail' => 'Email',
                'userAddress' => 'Nhận địa chỉ',
                'userSexType' => 'Giới tính',
                'userSex' => [
                    0 => 'Male',
                    1 => 'Female'
                ],

                'userLoginTimes' => 'Số lần Đăng nhập',
                'userToChange' => 'Sửa đổi',
                'userToRevert' => 'Khôi phục',
                'userToSave' => 'Xác định',

                'shoppingCart' => 'Giỏ hàng',
                'shoppingCartToPay' => 'Đi thanh toán',
                'shoppingCartNoCount' => 'Không có mặt hàng nào trong giỏ hàng',
                'shoppingCartUnPay' => 'Dự án Hàng hóa chưa giải quyết',

                'orderNo' => 'Số thứ tự',
                'orderPay' => 'Thanh toán',
                'orderCount' => 'Dự án Mục thứ tự',
                'orderLittleTotal' => 'Tổng phụ',
                'orderMoney' => 'Tổng số đơn hàng',
                'orderNoCount' => 'Chưa có đơn hàng nào',
                'orderPayTo' => 'Vui lòng gửi tiền đến',
                'orderPayAndUpload' => 'Tải lên một hình ảnh của hồ sơ chuyển tiền',
                'orderPayType' => 'Tình trạng thanh toán',
                'orderPayFlg' => [
                    0 => 'Chưa trả',
                    1 => 'Đang chờ xác nhận',
                    2 => 'Trả tiền'
                ],
                'orderDeliverType' => 'Tình trạng thanh toán',
                'orderDeliverFlg' => [
                    0 => 'Chờ giao hàng',
                    1 => 'Vận chuyển'
                ],

                'OrderDetail' => 'Chi tiết đặt hàng',
                'orderDetailCount' => 'Dự án Hàng hóa',
                'orderDetailType' => 'Hàng hóa',
                'orderDetailNum' => 'Số lượng',
                'orderDetailMoney' => 'Giá',

                'orderRecord' => 'Hồ sơ đặt hàng',
            ],
        ]
    ],
];
