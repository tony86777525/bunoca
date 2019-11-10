<link rel="stylesheet" href="/css/admin/product/create.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h3 class="text-center">
                <span class="step-spacing step-list step-list-1 step-list-on">{{ $p_column_name['product'] }}</span>
                <span class="step-spacing step-list step-list-2">{{ $p_column_name['product_detail'] }}</span>
            </h3>

            <form id="product-create-form" action="#" method="POST" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="new-product">
                    <div class="form-group">
                        <label for="product_category_id">{{ $p_column_name['product_category_id'] }}</label>
                        <select name="product_category_id" class="form-control" id="product_category_id">
                            @foreach($pcArray as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="p_name">{{ $p_column_name['p_name'] }}</label>
                        <input type="text" name="p_name" class="form-control" id="p_name" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                        <label for="p_title">{{ $p_column_name['p_title'] }}</label>
                        <input type="text" name="p_title" class="form-control" id="p_title" placeholder="Enter Product Title">
                    </div>
                    <div class="form-group">
                        <label for="p_price">{{ $p_column_name['p_price'] }}</label>
                        <input type="number" name="p_price" class="form-control" id="p_price" placeholder="Enter Product Price">
                    </div>
                    <div class="form-group">
                        <label for="p_display_flg">{{ $p_column_name['p_display_flg'] }}</label>
                        <select name="p_display_flg" class="form-control" id="p_display_flg">
                            @foreach($p_display_flg_text as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="p_image"><span class="p_image_text">{{ $p_column_name['p_image'] }}</span></label>
                        <input type="file" id="p_image" class="js-image hide" name="p_image">
                        <img class="p_image" style="display: none;">
                    </div>
                    <center>
                        <button type="button" class="btn btn-primary next-new-single" data-stepClass="step-list-2">繼續</button>
                    </center>
                </div>

                <div class="new-single step-hide">
                    <!-- 訂購商品 -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ $ps_column_name['ps_type'] }}</th>
                                <th scope="col">{{ $ps_column_name['ps_price'] }}</th>
                                <th scope="col">{{ $ps_column_name['ps_inventory'] }}</th>
                                <th scope="col">{{ $ps_column_name['ps_display_flg'] }}</th>
                                <th scope="col">{{ $ps_column_name['actions'] }}</th>
                            </tr>
                        </thead>
                        <tbody class="js-add-new-single"></tbody>
                    </table>
                    <table>
                        <tr>
                            <td><button type="button" class="btn btn-success add-product-single-table" data-stepClass="step-list-1">+</button></td>
                        </tr>
                    </table>
                    <center class="spacing">
                        <button type="button" class="btn btn-primary next-new-product button-spacing" data-stepClass="step-list-1">←</button>
                        <button type="button" class="btn btn-primary create-product" data-stepClass="step-list-3">Save</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/vendor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/vendor/ckeditor/adapters/jquery.js"></script>
<script src="/js/common/jquery.blockUI.js"></script>
<script type="text/javascript">
    $(".next-new-single").click(function(){
        $(".new-product").hide();
        $(".new-single").show();
        step_work($(this).attr("data-stepClass"));
    });
    $(".next-new-product").click(function(){
        $(".new-product").show();
        $(".new-single").hide();
        step_work($(this).attr("data-stepClass"));
    });
    var num = $(".new-single tbody").find('.js-product-single-column').length;
    $(".add-product-single-table").click(function(){
        var trNo = 'tr' + (num + 1);
        $(".new-single").find('.js-add-new-single')
        .append($('<tr class="js-product-single-column ' + trNo + '">')
            .append($('<th scope="row">' + (num + 1) + '</th>'))
            .append($('<td>')
                .append($('<div class="form-group">')
                    .append('<input type="text" name="nps[' + num + '][type]" class="">'
                    )
                )
            )
            .append($('<td>')
                .append($('<div class="form-group">')
                    .append('<input type="number" name="nps[' + num + '][price]" class="" value="0" placeholder="Enter Product Single Price">'
                    )
                )
            )
            .append($('<td>')
                .append($('<div class="form-group">')
                    .append('<input type="number" name="nps[' + num + '][inventory]" class="" value="0" placeholder="Enter Product Inventory">'
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
                .append('<button type="button" class="btn btn-danger cancel-productSingle" data-no="' + trNo + '">取消</button>'
                )
            )
        ).append($('<tr class="' + trNo + '" colspan="2">')
            .append($('<td></td>'))
            .append($('<td colspan="2">')
                .append($('<table>')
                    .append($('<tr>')
                        .append($('<td>')
                            .append($('<input class="ps_title" name="nps[' + num + '][title]" placeholder="<?= $ps_column_name['ps_type'] ?>">'))
                        )
                    )
                    .append($('<tr>')
                        .append($('<td></td>')
                            .append($('<textarea class="ps_content" id="new_ps_content_' + num + '" name="nps[' + num + '][content]" placeholder="<?= $ps_column_name['ps_content'] ?>"></textarea>'))
                        )
                    )
                )
            )
            .append($('<td colspan="3">')
                .append($('<div>')
                    .append($('<label for="nps_image_' + num + '">')
                        .append($('<span class="nps_image_' + num + '_text"></span>').html('<?= $ps_column_name['ps_image'] ?>'))
                        .append($('<img class="nps_image_' + num + '" style="display: none;">'))
                        .append($('<input class="js-image hide" type="file" id="nps_image_' + num + '" name="nps[' + num + '][image]"><label class="ps_href_label" for="nps_href_' + num + '"><?= $ps_column_name['ps_href'] ?><input class="ps_href_input" type="text" id="nps_href_' + num + '" name="nps[' + num + '][href]" style="width: calc(100% - 60px);"></label>'))
                    )
                )
            )
        );

        make_ckeditor($('#new_ps_content_' + num));
        num += 1;
    });
    $(".create-product").click(function(){
        data = new FormData($('#product-create-form')[0]);
        $(".ps_content").each(function(){
            data.append($(this).attr('name'), CKEDITOR.instances[$(this).attr('id')].getData());
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "create_product",
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
                    toastr.success(res.message);
                    window.location.href = '/admin/user/product';
                }
            },
            error : function() {

            }
        });
    });
    function step_work(stepClass){
        $(".step-list-on").removeClass("step-list-on");
        $("." + stepClass).addClass("step-list-on");
    }

    $(document).on('click', '.cancel-productSingle', function(){
        $('.' + $(this).attr("data-no")).remove();
    });

    $('body').on('change', '.js-image', function(){
        $('.' + $(this).attr('id')).attr('src', '');
        if($(this).val()){
            $('.' + $(this).attr('id') + '_text').text('CHECKED');
            $('.' + $(this).attr('id') + '_text').css('color', 'green');
        }else{
            $('.' + $(this).attr('id') + '_text').text('UNCHECK');
            $('.' + $(this).attr('id') + '_text').css('color', 'red');
        }

        readURL(this, $('.' + $(this).attr('id')))
    });

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

    function make_ckeditor (a) {
        CKEDITOR.replace(a.attr('id'), {
            customConfig: '/vendor/ckeditor/config.js'
        });
    }
</script>
