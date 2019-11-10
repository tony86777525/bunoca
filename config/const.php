<?php

return [
    'order_list_time' => 7*24*60,
    'lang' => [
        0 => 'vietnamese',
        1 => 'chinese',
    ],
    'product_category_title' => [
        'vietnamese' => 'pc_type',
        'chinese' => 'pc_title',
    ],
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
                    'product_category_id' => '商品分類',
                    'p_name' => '商品',
                    'p_title' => '商品(越)',
                    'p_price' => '售價',
                    'p_display_flg' => '狀態',
                    'p_image' => '圖片',
                    'p_sort' => '排序',
                    'updated_at' => '最後更新',
                    'product' => '商品',
                    'product_detail' => '商品明細',
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
            'product_category' => [
                'title' => '商品分類',
                'column' => [
                    'id' => '#',
                    'pc_sort' => '分類排序',
                    'pc_parent_id' => '父分類',
                    'pc_title' => '分類名稱',
                    'pc_type' => '分類名稱(越)',
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
                    'ps_sort' => '排序',
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
                    'order' => '訂單',
                    'order_detail' => '訂單明細',
                    'order_detail_insert' => '商品入單',
                    'sure_to_arrival' => '確定要配貨嗎?',
                    'add_order_and_continue_add_order_detail' => '新增訂單並繼續新增訂單商品',
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
            'api' => [
                'fail' => '失敗',
                'success' => '成功',
                'no_true_data' => '資料不正確',
                'no_product' => '商品不存在',
                'no_order' => '訂單不存在',
            ]
        ],
        'vietnamese' => [
            'user' => [
                'title' => 'Thành viên',
                'column' => [
                    'id' => '#',
                    'name' => 'Tên',
                    'sex' => 'Giới tính',
                    'address' => 'Địa chỉ',
                    'phone' => 'Điện thoại',
                    'email' => 'Địa chỉ email',
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
                'title' => 'SẢN PHẨM',
                'column' => [
                    'id' => '#',
                    'product_category_id' => '商品分類',
                    'p_name' => 'SẢN PHẨM',
                    'p_title' => 'SẢN PHẨM',
                    'p_price' => 'Giá Cả',
                    'p_display_flg' => 'Trạng thái',
                    'p_image' => '圖片',
                    'p_sort' => '排序',
                    'updated_at' => '最後更新',
                    'product' => 'SẢN PHẨM',
                    'product_detail' => '商品明細',
                ],
                'display_flg_option' => [
                    'on'  => ['value' => 1, 'text' => 'Trong bán', 'color' => 'primary'],
                    'off'  => ['value' => 0, 'text' => '停售中', 'color' => 'danger'],
                ],
                'display_flg_text' => [
                    0 => '停售中',
                    1 => 'Trong bán'
                ],
            ],
            'product_single' => [
                'title' => 'Hạng  Mục',
                'column' => [
                    'id' => '#',
                    'product_id' => 'SẢN PHẨM',
                    'ps_type' => 'Hạng  Mục',
                    'ps_price' => 'Giá Cả',
                    'ps_inventory' => 'Hàng tồn kho',
                    'ps_title' => '標題',
                    'ps_content' => '內容',
                    'ps_display_flg' => 'Trạng thái',
                    'ps_image' => '圖片',
                    'ps_href' => 'Liên kết',
                    'ps_sort' => '排序',
                    'updated_at' => '最後更新',
                    'actions' => 'Hoạt động',
                    'update_ps_inventory' => 'Hàng Nhập kho'
                ],
                'display_flg_option' => [
                    'on'  => ['value' => 1, 'text' => 'Trong bán', 'color' => 'primary'],
                    'off'  => ['value' => 0, 'text' => '停售中', 'color' => 'danger'],
                ],
                'display_flg_text' => [
                    0 => '停售中',
                    1 => 'Trong bán'
                ],
            ],
            'product_inventory_record' => [
                'title' => 'Hàng tồn kho',
                'column' => [
                    'id' => '#',
                    'p_name' => 'SẢN PHẨM',
                    'ps_type' => 'Hạng  Mục',
                    'admin_user_id' => 'Điều hành',
                    'admin_user_name' => 'Điều hành',
                    'pir_num' => 'Hàng Nhập kho',
                    'pir_before_num' => 'Trước',
                    'pir_after_num' => 'Sau',
                    'pir_message' => 'Ghi chú',
                    'ps_href' => 'Liên kết',
                    'created_at' => 'Thời gian',
                ],
            ],
            'order' => [
                'title' => 'Đặt hàng',
                'column' => [
                    'id' => '#',
                    'user_id' => 'Thành viên',
                    'user_name' => 'Tên',
                    'user_address' => 'Địa chỉ',
                    'o_no' => 'Số thứ tự',
                    'o_money' => 'Tổng số tiền',
                    'o_discount' => '訂單折扣',
                    'o_free_discount' => '自訂折扣',
                    'o_fee' => 'Phí Vận chuyển',
                    'o_num' => 'Hạng  Mục',
                    'o_pay_money' => 'Tổng số tiền phải trả',
                    'o_arrival_flg' => 'Trạng thái đặt hàng',
                    'o_pay_flg' => 'trạng thái thanh toán',
                    'o_deliver_flg' => 'Tình trạng vận chuyển',
                    'created_at' => 'Thời gian đặt hàng',
                    'order' => 'Số thứ tự',
                    'order_detail' => 'Chi tiết đặt hàng',
                    'order_detail_insert' => '商品入單',
                    'sure_to_arrival' => 'chắc chắn muốn đặt hàng?',
                    'add_order_and_continue_add_order_detail' => '新增訂單並繼續新增訂單商品',
                ],
                'sex' => [
                    0 => '女',
                    1 => '男'
                ],
                'arrival_flg_text' => [
                    0 => 'Chưa đặt hàng ',
                    1 => 'Đã'
                ],
                'pay_flg_text' => [
                    0 => 'Chưa thanh toán',
                    1 => 'Đang chờ xác nhận',
                    2 => 'Đã thanh toán'
                ],
                'deliver_flg_text' => [
                    0 => 'Chưa',
                    1 => 'Đã đặt hàng '
                ],
            ],
            'order_detail' => [
                'title' => 'Chi tiết đặt hàng',
                'column' => [
                    'id' => '#',
                    'order_id' => 'Đặt hàng',
                    'product_single_id' => 'Hạng  Mục',
                    'od_num' => 'Số lượng',
                    'od_money' => 'Tổng số tiền',
                    'od_ps_price' => 'Giá Cả',
                    'od_arrival_flg' => 'Trạng thái đặt hàng',
                    'actions' => 'Hoạt động',
                    'arrival' => 'thanh toán',
                ],
                'arrival_flg_text' => [
                    0 => 'Chưa đặt hàng',
                    1 => 'Đã đặt hàng'
                ],
            ],
            'config' => [
                'title' => '設定',
                'column' => [
                    'id' => '#',
                    'account' => '帳戶',
                ],
            ],
            'api' => [
                'fail' => 'FAIL',
                'success' => 'SUCCESS',
                'no_true_data' => 'NOT TRUE DATA',
                'no_product' => 'NO PRODUCT',
                'no_order' => 'NO ORDER',
            ]
        ],

        'frontend' => [
            'chinese' => [
                'login' => '登入',
                'logout' => '登出',
                'register' => '註冊',
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
                'orderDeliverType' => '出貨狀態',
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

                'js' => [
                    'hasAddedShoppingCart' => '已加入購物車',
                    'isToPay' => '是否前往結帳',
                    'toPay' => '前往結帳',
                    'continueToShop' => '繼續選購',
                    'waitForTry' => '請稍後再試',
                    'isDelete' => '是否刪除',
                ],
            ],
            'vietnamese' => [
                'login' => 'Đăng nhập',
                'logout' => '登出',
                'register' => 'Đăng ký',
                'message' => '訊息',
                'goIndex' => '回首頁',
                'userMailCheck' => '會員驗證',
                'userMailUncheck' => '尚未通過會員驗證',
                'userMailChecked' => '已通過會員驗證',
                'finish' => '完成',

                'active' => 'Hoạt động',
                'toOrderDetail' => 'Chi tiết đặt hàng',
                'toOrderPay' => 'thanh toán',

                'user' => 'Thành viên',
                'userName' => 'Tên',
                'userPhone' => 'Điện thoại',
                'userEmail' => 'Địa chỉ email',
                'userAddress' => 'Địa chỉ',
                'userSexType' => 'Giới tính',
                'userSex' => [
                    0 => '女',
                    1 => '男'
                ],

                'userLoginTimes' => '次登入',
                'userToChange' => 'Chỉnh sửa',
                'userToRevert' => 'Reset',
                'userToSave' => 'Xác định',

                'shoppingCart' => 'giỏ hàng',
                'shoppingCartToPay' => 'Đi đến thanh toán',
                'shoppingCartNoCount' => '購物車內尚無商品',
                'shoppingCartUnPay' => '項商品未結帳',

                'orderNo' => 'Số thứ tự',
                'orderPay' => 'thanh toán',
                'orderCount' => '項訂單',
                'orderLittleTotal' => 'Tổng số tiền',
                'orderMoney' => 'Tổng số tiền phải trả',
                'orderNoCount' => '尚無訂單',
                'orderPayTo' => '請匯款至',
                'orderPayAndUpload' => '上傳匯款紀錄的照片',
                'orderPayType' => 'trạng thái thanh toán',
                'orderPayFlg' => [
                    0 => 'Chưa thanh toán',
                    1 => '待確認',
                    2 => 'Đã thanh toán'
                ],
                'orderDeliverType' => 'Tình trạng vận chuyển',
                'orderDeliverFlg' => [
                    0 => 'Chưa',
                    1 => 'Đã'
                ],

                'OrderDetail' => 'Chi tiết đặt hàng',
                'orderDetailCount' => '項商品',
                'orderDetailType' => 'SẢN PHẨM',
                'orderDetailNum' => 'Số lượng',
                'orderDetailMoney' => 'Tổng số tiền',

                'orderRecord' => 'Đặt hàng',

                'js' => [
                    'hasAddedShoppingCart' => 'Thêm vào xe giỏ hàng',
                    'isToPay' => 'Có phải đi đến thành toán ',
                    'toPay' => 'Đi đến thanh toán',
                    'continueToShop' => 'Tiếp tục mua hàng',
                    'waitForTry' => 'Try it later',
                    'isDelete' => 'Xóa?',
                ],
            ],
        ]
    ],
];
