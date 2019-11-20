<link rel="stylesheet" href="/css/admin/order/edit.css">
<div class="container">
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-3"><h3><label>{{$o_column_name['o_pay_money']}}： {{$order->o_pay_money}}</label></h3></div>
        <div class="col-md-3"><h3><label>{{$o_column_name['o_arrival_flg']}}： <span class="{{ 'option' . count($o_arrival_flg_text) . '_text_' . $order->o_arrival_flg }}">{{$o_arrival_flg_text[$order->o_arrival_flg]}}</span></label></h3></div>
        <div class="col-md-3">
            <h3>
                @if($order->o_pay_flg == App\Order::O_PAY_FLG_ON)
                    <label data-toggle="modal" data-target="#o_pay_image">{{ $o_column_name['o_pay_flg']}}： <span class="{{ 'option' . count($o_pay_flg_text) . '_text_' . $order->o_pay_flg }}"><button type="button" class="btn btn-danger">CHECK</button></span></label>
                @else
                    <label>{{$o_column_name['o_pay_flg']}}： <span class="{{ 'option' . count($o_pay_flg_text) . '_text_' . $order->o_pay_flg }}">{{$o_pay_flg_text[$order->o_pay_flg]}}</span></label>
                @endif
            </h3>
        </div>
        <div class="col-md-3"><h3><label>{{$o_column_name['o_deliver_flg']}}： <span class="{{ 'option' . count($o_deliver_flg_text) . '_text_' . $order->o_deliver_flg }}">{{$o_deliver_flg_text[$order->o_deliver_flg]}}</span></label></h3></div>
    </div>
    <div class="row">
        <div>
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" class="tab-o" href="#o_form">{{ $o_column_name['order'] }}</a></li>
                <li class="active"><a data-toggle="tab" class="tab-od" href="#od_form">{{ $o_column_name['order_detail'] }}</a></li>
            </ul>
            <form id="order-update-form" action="#" method="POST" onsubmit="return false">
                <div class="tab-content">
                    <div id="o_form" class="tab-pane fade form">
                        <div class="new-order">
                            <div class="form-group">
                                <label for="o_no">{{$o_column_name['o_no']}}： {{$order->o_no}}</label>
                            </div>
                            <div class="form-group">
                                <label for="user_name">{{$o_column_name['user_name']}}</label>
                                <input type="text" name="user_name" class="form-control" id="user_name" value="{{$order->user_name}}">
                            </div>
                            <div class="form-group">
                                <label for="user_address">{{$o_column_name['user_address']}}</label>
                                <input type="text" name="user_address" class="form-control" id="user_address" value="{{$order->user_address}}">
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
                                <label for="o_arrival_flg">{{$o_column_name['o_arrival_flg']}}： <span class="<?= 'option' . count($o_arrival_flg_text) . '_text_' . $order->o_arrival_flg ?>">{{$o_arrival_flg_text[$order->o_arrival_flg]}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="o_arrival_flg">{{$o_column_name['o_pay_flg']}}：
                                    @if(Admin::user()->isRole('admin'))
                                        <select name="o_pay_flg" id="o_pay_flg">
                                            @foreach($o_pay_flg_text as $val => $text)
                                                <option value="{{$val}}" @if($order->o_pay_flg == $val) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="o_pay_flg" value="{{ $order->o_pay_flg }}">
                                        <span class="<?= 'option' . count($o_pay_flg_text) . '_text_' . $order->o_pay_flg ?>">{{$o_pay_flg_text[$order->o_pay_flg]}}</span>
                                    @endif
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="o_deliver_flg">{{$o_column_name['o_deliver_flg']}}：
                                    @if(Admin::user()->isRole('admin'))
                                        <select name="o_deliver_flg" id="o_deliver_flg">
                                            @foreach($o_deliver_flg_text as $val => $text)
                                                <option value="{{$val}}" @if($order->o_deliver_flg == $val) selected @endif>{{$text}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="o_deliver_flg" value="{{ $order->o_deliver_flg }}">
                                        <span class="<?= 'option' . count($o_deliver_flg_text) . '_text_' . $order->o_deliver_flg ?>">{{$o_deliver_flg_text[$order->o_deliver_flg]}}</span>
                                    @endif
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="p_display_flg">{{$o_column_name['created_at']}}： {{$order->created_at}}</label>
                            </div>
                        </div>
                    </div>
                    <div id="od_form" class="tab-pane fade in active form">
                        <div class="new-detail">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{$od_column_name['product_single_id']}}</th>
                                        <th scope="col">{{$od_column_name['od_money']}}</th>
                                        <th scope="col">{{$od_column_name['od_num']}}</th>
                                        <th scope="col">{{$od_column_name['od_arrival_flg']}}</th>
                                        <th scope="col">{{$od_column_name['actions']}}</th>
                                    </tr>
                                </thead>
                                <tbody class="js-add-new-detail">
                                    @foreach($order->order_detail as $k => $v)
                                    <tr class="js-order-detail-column">
                                        <th scope="row">
                                            {{$k+1}}
                                            <input type="hidden" name="od[{{$v->id}}][id]" value="{{$v->id}}">
                                        </th>
                                        <td><a href="/admin/user/product/{{$v->product_single->product->id}}/edit" target="_blank">{{$v->product_single->ps_title}}</a></td>
                                        <td><span class="js-od-money-{{$v->id}}">{{$v->od_money}}</span></td>
                                        <td>
                                            @if($v->od_arrival_flg == \App\OrderDetail::OD_ARRIVAL_FLG_ON)
                                                {{$v->od_num}}
                                                <input type="hidden" name="od[{{$v->id}}][od_num]" class="js-od-num" data-id="{{$v->product_single_id}}" data-odid="{{$v->id}}" value="{{$v->od_num}}">
                                            @else
                                                <input type="number" name="od[{{$v->id}}][od_num]" class="js-od-num" data-id="{{$v->product_single_id}}" data-odid="{{$v->id}}" value="{{$v->od_num}}">
                                            @endif
                                        </td>
                                        <td>
                                            @if(Admin::user()->isRole('admin'))
                                                <select name="od[{{$v->id}}][od_arrival_flg]" id="od_arrival_flg">
                                                    @foreach($od_arrival_flg_text as $val => $text)
                                                        <option value="{{$val}}" @if($v->od_arrival_flg == $val) selected @endif>{{$text}}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input type="hidden" name="od[{{$v->id}}][od_arrival_flg]" value="{{ $v->od_arrival_flg }}">
                                                <span class="<?= 'option' . count($od_arrival_flg_text) . '_text_' . $v->od_arrival_flg ?>">{{ $od_arrival_flg_text[$v->od_arrival_flg] }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-order-detail" data-odid="{{$v->id}}" @if($v->od_arrival_flg == \App\OrderDetail::OD_ARRIVAL_FLG_ON) disabled="disabled" @endif>X</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td colspan="5"><a href="/admin/user/product/{{$v->product_single->product->id}}/edit" target="_blank">{{$v->product_single->product->p_name}} - {{$v->product_single->ps_type}}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table>
                                <tr>
                                    <th scope="row">
                                        <button type="button" class="btn btn-primary js-create-order-detail-table" data-toggle="modal" data-target="#create-detail">+</button>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <center class="spacing">
                        <button type="button" class="btn btn-success button-spacing update-order">Save</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="create-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $o_column_name['order_detail_insert'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-order-detail-form" action="#" method="POST" onsubmit="return false">
                    <div class="form-group">
                        <label for="n_product_single_id" class="col-form-label">{{$od_column_name['product_single_id']}}:</label>
                        <select type="text" name="nod[product_single_id]" class="form-control js-select2" id="n_product_single_id">
                            <option>-</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product->p_title }} - {{ $product->ps_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nod_num" class="col-form-label">{{$od_column_name['od_num']}}:</label>
                        <input type="number" name="nod[od_num]" class="form-control js-nod-num" data-id="0" id="nod_num" value="1">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">{{$od_column_name['od_money']}}: <span class="js-nod-money">0</span></label>
                    </div>
                    @if(Admin::user()->isRole('admin'))
                        <div class="form-group">
                            <label for="nod_arrival_flg" class="col-form-label">{{$od_column_name['od_arrival_flg']}}:</label>
                            <select type="text" name="nod[od_arrival_flg]" class="form-control" id="nod_arrival_flg">
                                @foreach($od_arrival_flg_text as $val => $text)
                                    <option value="{{$val}}">{{$text}}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="nod[od_arrival_flg]" value="0">
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary js-create-order-detail">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($order->o_pay_image)
    <div class="modal fade" id="o_pay_image" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img style="width: 100%" src="{{ '/uploads/'.$order->o_pay_image }}">
                </div>
            </div>
        </div>
    </div>
@endif

<script src="/js/common/jquery.blockUI.js"></script>
<script>
    $(function () {
        $(".js-index-order-detail").click(function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "create_order_detail",
                data: $('#index-order-detail-form').serialize(),
                dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
                success: function (res) {
                    $.unblockUI();
                    if(res.check){
                        $('#index-detail').modal('hide');
                        $.pjax.reload('#pjax-container');
                        toastr.success(res.message);
                    }
                },
                error : function() {
                    $.unblockUI();
                }
            });
        });

        $(".js-index-order-detail-table").click(function () {
            $('select#n_product_single_id option').remove();
            $('select#n_product_single_id').append($("<option></option>").attr("value", "0").text("----"));
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "get_all_product",
                dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
                success: function (res) {
                    $.unblockUI();
                    if(res.check){
                        var p = res.data.p;

                        for(var i in p)
                            for(var j in p[i].product_single) {
                                if(res.data.language == 'vietnamese'){
                                    $('select#n_product_single_id').append($("<option></option>").attr("value", p[i].product_single[j].id).text(p[i].product_single[j].ps_title));
                                }else{
                                    $('select#n_product_single_id').append($("<option></option>").attr("value", p[i].product_single[j].id).text(p[i].p_name + '-' + p[i].product_single[j].ps_type));
                                }
                            }
                    }
                },
                error : function() {
                    $.unblockUI();
                }
            });
        });

        $(".add-order-detail-table").click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "update_order_and_detail",
                data: $('#order-update-form').serialize(),
                dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
                success: function (res) {
                    $.unblockUI();
                    if(res.check){
                        $.pjax.reload('#pjax-container');
                        toastr.success(res.message);
                    }
                },
                error : function() {
                    $.unblockUI();
                }
            });
        });

        function get_order_detail_price(ps_id, od_num){
            return $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "get_order_detail_price",
                data: {
                    'ps_id': ps_id,
                    'od_num': od_num,
                },
                dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
            });
        }

        $(".js-od-num").change(function() {
            if($(this).val() <= 0){
                $(this).val(1);
            }
            const od_num = $(this).val();
            const od_id = $(this).attr("data-odid");
            const ps_id = $(this).attr("data-id");
            let data = get_order_detail_price(ps_id, od_num);
            data.success(function(res) {
                $.unblockUI();
                if(res.check){
                    $('.js-od-money-' + od_id).html(res.data);
                }else{
                    $('.js-od-money-' + od_id).html("0");
                }
            })
        });

        $(".js-nod-num").change(function() {
            if($(this).val() <= 0){
                $(this).val(1);
            }
            const od_num = $(this).val();
            const ps_id = $(this).attr("data-id");
            let data = get_order_detail_price(ps_id, od_num);
            data.success(function(res) {
                $.unblockUI();
                if(res.check){
                    $('.js-nod-money').html(res.data);
                }else{
                    $('.js-nod-money').html("0");
                }
            })
        });

        $("#n_product_single_id").change(function () {
            $('#nod_num').attr("data-id", $(this).val());
            const od_num = $(".js-nod-num").val();
            const ps_id = $(this).val();
            let data = get_order_detail_price(ps_id, od_num);
            data.success(function(res) {
                $.unblockUI();
                if(res.check){
                    $('.js-nod-money').html(res.data);
                }else{
                    $('.js-nod-money').html("0");
                }
            })
        });

        $(".update-order").click(function(){
            // var data = new FormData($('#order-update-form')[0]);
            // $(".ps_content").each(function(){
            //     data.append($(this).attr('name'), CKEDITOR.instances[$(this).attr('id')].getData());
            // });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "update_order_and_detail",
                data: $('#order-update-form').serialize(),
                dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
                success: function (res) {
                    $.unblockUI();
                    if(res.check){
                        $.pjax.reload('#pjax-container');
                        toastr.success(res.message);
                    }
                },
                error : function() {
                    $.unblockUI();
                }
            });
        });

        $(".delete-order-detail").click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "delete_order_detail",
                data: {
                    'od_id': $(this).attr("data-odid"),
                },
                dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
                success: function (res) {
                    $.unblockUI();
                    if(res.check){
                        $.pjax.reload('#pjax-container');
                        toastr.success(res.message);
                    }
                },
                error : function() {

                }
            });
        });

        $(".js-create-order-detail").click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "create_order_detail",
                data: $('#create-order-detail-form').serialize(),
                dataType: "json",
                success: function (res) {
                    if(res.check){
                        $('.modal-backdrop').remove();
                        $.pjax.reload('#pjax-container');
                        toastr.success(res.message);
                    }
                }
            });
        });
    });
</script>
