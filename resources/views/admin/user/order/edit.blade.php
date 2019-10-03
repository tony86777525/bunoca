<link rel="stylesheet" href="/css/admin/order/detail.css">
<div class="container">
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-3"><h3><label>{{$o_column_name['o_pay_money']}}： {{$order->o_pay_money}}</label></h3></div>
        <div class="col-md-3"><h3><label>{{$o_column_name['o_arrival_flg']}}： <span class="<?= 'option' . count($o_arrival_flg_text) . '_text_' . $order->o_arrival_flg ?>">{{$o_arrival_flg_text[$order->o_arrival_flg]}}</span></label></h3></div>
        <div class="col-md-3"><h3><label>{{$o_column_name['o_pay_flg']}}： <span class="<?= 'option' . count($o_pay_flg_text) . '_text_' . $order->o_pay_flg ?>">{{$o_pay_flg_text[$order->o_pay_flg]}}</span></label></h3></div>
        <div class="col-md-3"><h3><label>{{$o_column_name['o_deliver_flg']}}： <span class="<?= 'option' . count($o_deliver_flg_text) . '_text_' . $order->o_deliver_flg ?>">{{$o_deliver_flg_text[$order->o_deliver_flg]}}</span></label></h3></div>
    </div>
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
                            <label for="o_no">{{$o_column_name['o_no']}}： {{$order->o_no}}</label>
                        </div>
                        <div class="form-group">
                            <label for="o_money">{{$o_column_name['o_money']}}： {{$order->o_money}}</label>
                        </div>
                        <div class="form-group">
                            <label for="o_discount">{{$o_column_name['o_discount']}}</label>
                            <input type="number" name="o_discount" class="form-control" id="o_discount" value="{{$order->o_discount}}">
                        </div>
                        <div class="form-group">
                            <label for="o_free_discount">{{$o_column_name['o_free_discount']}}</label>
                            <input type="number" name="o_free_discount" class="form-control" id="o_free_discount" value="{{$order->o_free_discount}}">
                        </div>
                        <div class="form-group">
                            <label for="o_fee">{{$o_column_name['o_fee']}}</label>
                            <input type="number" name="o_fee" class="form-control" id="o_fee" value="{{$order->o_fee}}">
                        </div>
                        <div class="form-group">
                            <label for="o_pay_money">{{$o_column_name['o_pay_money']}}： {{$order->o_pay_money}}</label>
                        </div>
                        <div class="form-group">
                            <label for="o_arrival_flg">{{$o_column_name['o_arrival_flg']}}：
                                <select name="o_arrival_flg" id="o_arrival_flg">
                                    @foreach($o_arrival_flg_text as $val => $text)
                                        <option value="{{$val}}" @if($order->o_pay_flg == $val) selected @endif>{{$text}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="o_arrival_flg">{{$o_column_name['o_pay_flg']}}：
                                <select name="o_pay_flg" id="o_pay_flg">
                                    @foreach($o_pay_flg_text as $val => $text)
                                        <option value="{{$val}}" @if($order->o_pay_flg == $val) selected @endif>{{$text}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="o_deliver_flg">{{$o_column_name['o_deliver_flg']}}：
                                <select name="o_deliver_flg" id="o_deliver_flg">
                                    @foreach($o_deliver_flg_text as $val => $text)
                                        <option value="{{$val}}" @if($order->o_deliver_flg == $val) selected @endif>{{$text}}</option>
                                    @endforeach
                                </select>
                            </label>
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
                                    <td><span class="js-od-money">{{$v->od_money}}</span><input type="hidden" name="od_money" value="{{$v->od_num}}"></td>
                                    <td><input type="number" name="od_num" value="{{$v->od_num}}"></td>
                                    <td>
                                        <select name="od_arrival_flg" id="od_arrival_flg">
                                            @foreach($od_arrival_flg_text as $val => $text)
                                                <option value="{{$val}}" @if($v->od_arrival_flg == $val) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                    </td>
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
<script>
    $(function () {
        $('input[name=o_fee]').change(function() {
            if($(this).val() <= 0){
                $(this).val(1);
            }
            console.log($(this).val());
        });
    });
</script>
