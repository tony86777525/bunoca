<link rel="stylesheet" href="/css/admin/order/detail.css">
<div class="container">
    <div class="row">
        <div>
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" class="tab-o" href="#o_form">訂單資訊</a></li>
                <li class="active"><a data-toggle="tab" class="tab-od" href="#od_form">訂單明細</a></li>
            </ul>
            <div class="tab-content">
                <div id="o_form" class="tab-pane fade form">
                    <div class="new-product">
                        <div class="form-group">
                            <label for="p_name">{{$o_column_name['o_no']}}： {{$order->o_no}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_price">{{$o_column_name['o_money']}}： {{$order->o_money}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['o_discount']}}： {{$order->o_discount}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['o_free_discount']}}： {{$order->o_free_discount}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['o_fee']}}： {{$order->o_fee}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['o_pay_money']}}： {{$order->o_pay_money}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['o_arrival_flg']}}： <span class="<?= 'option' . count($o_arrival_flg_text) . '_text_' . $order->o_arrival_flg ?>">{{$o_arrival_flg_text[$order->o_arrival_flg]}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['o_pay_flg']}}： <span class="<?= 'option' . count($o_pay_flg_text) . '_text_' . $order->o_pay_flg ?>">{{$o_pay_flg_text[$order->o_pay_flg]}}</span></label>
                            <button type="button" class="btn btn-primary js-create-order-detail-table" data-toggle="modal" data-target="#o_pay_image">check</button>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['o_deliver_flg']}}： <span class="<?= 'option' . count($o_deliver_flg_text) . '_text_' . $order->o_deliver_flg ?>">{{$o_deliver_flg_text[$order->o_deliver_flg]}}</span></label>
                        </div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$o_column_name['created_at']}}： {{$order->created_at}}</label>
                        </div>
                    </div>
                </div>
                <div id="od_form" class="tab-pane fade in active form">
                    <div class="new-single">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{$od_column_name['product_single_id']}}</th>
                                    <th scope="col">{{$od_column_name['od_money']}}</th>
                                    <th scope="col">{{$od_column_name['od_num']}}</th>
                                    <th scope="col">{{$od_column_name['od_arrival_flg']}}</th>
                                </tr>
                            </thead>
                            <tbody class="js-add-new-single">
                                @foreach($order->order_detail as $k => $v)
                                <tr>
                                    <th scope="row">
                                        {{$k+1}}
                                    </th>
                                    <td><a href="/admin/user/product/{{$v->product_single->product->id}}/edit" target="_blank">{{$v->product_single->ps_title}}</a></td>
                                    <td>{{$v->od_money}}</td>
                                    <td>{{$v->od_num}}</td>
                                    <td><span class="<?= 'option' . count($od_arrival_flg_text) . '_text_' . $v->od_arrival_flg ?>">{{$od_arrival_flg_text[$v->od_arrival_flg]}}</span></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td colspan="4"><a href="/admin/user/product/{{$v->product_single->product->id}}/edit" target="_blank">{{$v->product_single->product->p_name}} - {{$v->product_single->ps_type}}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="o_pay_image" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img style="width: 100%" src="{{ env('APP_URL').'/uploads/'.$order->o_pay_image }}">
            </div>
        </div>
    </div>
</div>
