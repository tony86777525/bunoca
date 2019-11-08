<link rel="stylesheet" href="/css/admin/product/edit.css">
<div class="container-fluid">
    <div class="row">
        <div>
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" class="tab-p" href="#p_form">{{$p_column_name['product']}}</a></li>
                <li class="active"><a data-toggle="tab" class="tab-ps" href="#ps_form">{{$p_column_name['product_detail']}}</a></li>
            </ul>
            <div class="tab-content">
                <div id="p_form" class="tab-pane fade form">
                    <form id="product-update-form" action="#" method="POST" onsubmit="return false">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$product['id']}}">
                        <div class="new-product">
                            <!-- 訂購者 -->
                            <div class="form-group">
                                <label for="p_name">{{$p_column_name['p_name']}}</label>
                                <input type="text" name="p_name" class="form-control" id="p_name" value="{{$product->p_name}}" placeholder="Enter Product Name">
                            </div>
                            <div class="form-group">
                                <label for="p_title">{{$p_column_name['p_title']}}</label>
                                <input type="text" name="p_title" class="form-control" id="p_title" value="{{$product->p_title}}" placeholder="Enter Product Title">
                            </div>
                            <div class="form-group">
                                <label for="p_price">{{$p_column_name['p_price']}}</label>
                                <input type="number" name="p_price" class="form-control" id="p_price" value="{{$product->p_price}}" placeholder="Enter Product Price">
                            </div>
                            <div class="form-group">
                                <label for="p_display_flg">{{$p_column_name['p_display_flg']}}</label>
                                <select name="p_display_flg" class="form-control" id="p_display_flg">
                                    @foreach($p_display_flg_text as $k => $v)
                                        <option value="{{ $k }}" {{ $product->p_display_flg == $k ? ' selected="selected"' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="p_sort">{{$p_column_name['p_sort']}}</label>
                                <input type="number" name="p_sort" class="form-control" id="p_sort" value="{{$product->p_sort}}" placeholder="Enter Product Sort">
                            </div>
                            <div class="form-group">
                                @if(!empty($product->p_image))
                                    <label for="p_image"><span class="p_image_text">{{$p_column_name['p_image']}}</span><img class="p_image" src="{{env('APP_URL').'/uploads/'.$product->p_image}}"></label>
                                @else
                                    <label for="p_image"><span class="p_image_text">{{$p_column_name['p_image']}}</span><img class="p_image hide"></label>
                                @endif
                                <div>
                                    <input type="file" id="p_image" class="js-image hide" name="p_image">
                                </div>
                            </div>
                            <center>
                                <button type="button" class="btn btn-success button-spacing update-product">Save</button>
                            </center>
                        </div>
                    </form>
                </div>
                <div id="ps_form" class="tab-pane fade in active form">
                    <form id="product_single-update-form" action="#" method="POST" onsubmit="return false">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="new-single">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{$ps_column_name['ps_type']}}</th>
                                        <th scope="col">{{$ps_column_name['ps_price']}}</th>
                                        <th scope="col">{{$ps_column_name['ps_inventory']}}</th>
                                        <th scope="col">+-</th>
                                        <th scope="col">{{$ps_column_name['ps_display_flg']}}</th>
                                        <th scope="col">{{$ps_column_name['ps_sort']}}</th>
                                        <th scope="col">{{$ps_column_name['actions']}}</th>
                                    </tr>
                                </thead>
                                <tbody class="js-add-new-single">
                                    @foreach($product->product_single as $k => $v)
                                    <tr class="js-product-single-column">
                                        <th scope="row">
                                            {{$k+1}}
                                            <input type="hidden" name="ps[{{$k}}][id]" value="{{$v->id}}">
                                        </th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="ps[{{$k}}][type]" class="" value="{{$v->ps_type}}" required="required">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="ps[{{$k}}][price]" class="" value="{{$v->ps_price}}">
                                            </div>
                                        </td>
                                        <td>
                                            {{$v->ps_inventory}}
                                            <input type="hidden" name="ps[{{$k}}][inventory]" value="{{$v->ps_inventory}}">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" name="ps[{{$k}}][add_inventory]" class="" value="0" placeholder="Enter Product Inventory">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select name="ps[{{$k}}][display_flg]" class="">
                                                    @foreach($ps_display_flg_text as $key => $val)
                                                        <option value="{{ $key }}" {{ $v->ps_display_flg == $key ? ' selected="selected"' : '' }}>{{ $val }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="ps[{{$k}}][sort]" class="" value="{{$v->ps_sort}}">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-productSingle" data-id="{{$v->id}}">X</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <table>
                                                <tr>
                                                    <td>{{ $ps_column_name['ps_title'] }}</td>
                                                    <td><input class="ps_title" name="ps[{{$k}}][title]" value="{{$v->ps_title}}"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>{{ $ps_column_name['ps_content'] }}</td>
                                                    <td><textarea class="ps_content" id="ps_content_{{$k}}" name="ps[{{$k}}][content]">{{$v->ps_content}}</textarea></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td colspan="4">
                                            @if(!empty($v->ps_image))
                                                <label for="ps_image_{{$k}}"><span class="ps_image_{{$k}}_text">{{ $ps_column_name['ps_image'] }}</span><img class="ps_image_{{$k}}" src="{{env('APP_URL').'/uploads/'.$v->ps_image}}"></label>
                                            @else
                                                <label for="ps_image_{{$k}}"><span class="ps_image_{{$k}}_text">{{ $ps_column_name['ps_image'] }}</span><img class="ps_image_{{$k}}"></label>
                                            @endif
                                            <div>
                                                <input type="file" id="ps_image_{{$k}}" class="js-image hide" name="ps[{{$k}}][image]">
                                                <label for="ps_href_{{$k}}" class="ps_href_label">{{ $ps_column_name['ps_href'] }}<input type="text" id="ps_href_{{$k}}" name="ps[{{$k}}][href]" value="{{$v->ps_href}}" class="ps_href_input"></label>
                                            </div>
                                          </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table>
                                <tr>
                                    <td><button type="button" class="btn btn-success add-product-single-table" data-stepClass="step-list-1">+</button></td>
                                </tr>
                            </table>
                            <center class="spacing">
                                <button type="button" class="btn btn-success button-spacing update-productSingle">Save</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/vendor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/vendor/ckeditor/adapters/jquery.js"></script>
<script src="/js/common/jquery.blockUI.js"></script>
<script type="text/javascript">
    var num = $(".new-single tbody").find('.js-product-single-column').length;
    $(".add-product-single-table").click(function(){
        var trNo = 'tr' + (num + 1);
        $(".new-single").find('.js-add-new-single')
        .append($('<tr class="js-product-single-column ' + trNo + '">')
            .append($('<th scope="row">' + (num + 1) + '</th>'))
            .append($('<td>')
                .append($('<div class="form-group">')
                    .append('<input type="text" name="nps[' + num + '][type]" class="" placeholder="<?= $ps_column_name['ps_type'] ?>" required="required">'
                    )
                )
            )
            .append($('<td>')
                .append($('<div class="form-group">')
                    .append('<input type="number" name="nps[' + num + '][price]" class="" placeholder="<?= $ps_column_name['ps_price'] ?>" placeholder="Enter Product Single Price">'
                    )
                )
            )
            .append($('<td>')
            )
            .append($('<td>')
                .append($('<div class="form-group">')
                    .append('<input type="number" name="nps[' + num + '][inventory]" class="" placeholder="<?= $ps_column_name['ps_inventory'] ?>" placeholder="Enter Product Inventory">'
                    )
                )
            )
            .append($('<td>')
                .append($('<div class="form-group">')
                    .append($('<select name="nps[' + num + '][display_flg]" class="">')
                        .append('<option value="1"><?= $ps_display_flg_text[1] ?></option>')
                        .append('<option value="0"><?= $ps_display_flg_text[0] ?></option>')
                    )
                )
            )
            .append($('<td>')
            )
            .append($('<td>')
                .append('<button type="button" class="btn btn-danger cancel-productSingle" data-no="' + trNo + '">X</button>'
                )
            )
        ).append($('<tr class="' + trNo + '" colspan="2">')
            .append($('<td></td>'))
            .append($('<td colspan="2">')
                .append($('<table>')
                    .append($('<tr>')
                        .append($('<td>')
                            .append($('<input class="ps_title" name="nps[' + num + '][title]" placeholder="<?= $ps_column_name['ps_title'] ?>">'))
                        )
                    )
                    .append($('<tr>')
                        .append($('<td></td>')
                            .append($('<textarea class="ps_content" id="new_ps_content_' + num + '" name="nps[' + num + '][content]" placeholder="<?= $ps_column_name['ps_content'] ?>"></textarea>'))
                        )
                    )
                )
            )
            .append($('<td colspan="2">')
                .append($('<div>')
                    .append($('<label for="nps_image_' + num + '">')
                        .append($('<span class="nps_image_' + num + '_text"></span>').html('<?= $ps_column_name['ps_image'] ?>'))
                        .append($('<img class="nps_image_' + num + '" style="display: none;">'))
                        .append($('<input class="js-image hide" type="file" id="nps_image_' + num + '" name="nps[' + num + '][image]"><label for="nps_href_' + num + '" class="ps_href_label"><?= $ps_column_name['ps_href'] ?><input class="ps_href_input" type="text" id="nps_href_' + num + '" name="nps[' + num + '][href]"></label>'))
                    )
                )
            )
        );

        make_ckeditor($('#new_ps_content_' + num));
        num += 1;
    });

    $(".update-product").click(function(){
        var data = new FormData($('#product-update-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "update_product",
            data: data,
            dataType: "json",
            cache : false,
            processData : false,
            contentType : false,
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
    $(".update-productSingle").click(function(){
        var data = new FormData($('#product_single-update-form')[0]);
        $(".ps_content").each(function(){
            data.append($(this).attr('name'), CKEDITOR.instances[$(this).attr('id')].getData());
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "update_product_single",
            data: data,
            dataType: "json",
            cache : false,
            processData : false,
            contentType : false,
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

    $(".delete-productSingle").click(function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "delete_product_single",
            data: {
                'id': $(this).attr("data-id"),
                '_token': $('input[name=_token]').val(),
            },
            dataType: "json",
            success: function (res) {
                if(res.check){
                    $.pjax.reload('#pjax-container');
                    toastr.success(res.message);
                }
            },
            error : function() {

            }
        });
    });

    $(document).on('click', '.cancel-productSingle', function(){
        $('.' + $(this).attr("data-no")).remove();
    });

    $('body').on('change', '.js-image', function(){
        $('.' + $(this).attr('id')).attr('src', '');
        console.log($(this).val());
        if($(this).val()){
            $('.' + $(this).attr('id') + '_text').text('CHECKED');
            $('.' + $(this).attr('id') + '_text').css('color', 'green');
        }else{
            $('.' + $(this).attr('id') + '_text').text('UNCHECKED');
            $('.' + $(this).attr('id') + '_text').css('color', 'red');
        }

        readURL(this, $('.' + $(this).attr('id')))
    });

    $(".ps_content").each(function(){
        make_ckeditor($(this));
    });

    function make_ckeditor (a) {
        CKEDITOR.replace(a.attr('id'), {
            customConfig: '/vendor/ckeditor/config.js'
        });
    }

    function readURL(input, img){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            img.show();
        }else{
            img.hide();
        }
    }
</script>
