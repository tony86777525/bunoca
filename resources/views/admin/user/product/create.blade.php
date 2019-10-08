<link rel="stylesheet" href="/css/admin/product/create.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h3 class="text-center">
                <span class="step-spacing step-list step-list-1 step-list-on">商品資訊</span>
                <span class="step-spacing step-list step-list-2">商品明細</span>
            </h3>

            <form id="product-create-form" action="#" method="POST" onsubmit="return false">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="new-product">
                    <div class="form-group">
                        <label for="p_name">商品名稱</label>
                        <input type="text" name="p_name" class="form-control" id="p_name" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                        <label for="p_price">預設價格</label>
                        <input type="number" name="p_price" class="form-control" id="p_price" placeholder="Enter Product Price">
                    </div>
                    <div class="form-group">
                        <label for="p_display_flg">顯示狀態</label>
                        <select name="p_display_flg" class="form-control" id="p_display_flg">
                            <option value="1">販售中</option>
                            <option value="0">停售中</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="p_image"><span class="p_image_text">選擇圖片</span></label>
                        <input type="file" id="p_image" class="js-image hide" name="p_image">
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
                                <th scope="col">品名</th>
                                <th scope="col">單價</th>
                                <th scope="col">庫存</th>
                                <th scope="col">狀態</th>
                                <th scope="col">操作</th>
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
                        <button type="button" class="btn btn-primary next-new-product button-spacing" data-stepClass="step-list-1">上一步</button>
                        <button type="button" class="btn btn-primary create-product" data-stepClass="step-list-3">新增商品</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/vendor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/vendor/ckeditor/adapters/jquery.js"></script>
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
                        .append('<option value="1">販售中</option>')
                        .append('<option value="0">停售中</option>')
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
                            .append($('<input class="ps_title" name="nps[' + num + '][title]" placeholder="標題">'))
                        )
                    )
                    .append($('<tr>')
                        .append($('<td></td>')
                            .append($('<textarea class="ps_content" id="new_ps_content_' + num + '" name="nps[' + num + '][content]" placeholder="內容"></textarea>'))
                        )
                    )
                )
            )
            .append($('<td colspan="3">')
                .append($('<div>')
                    .append($('<label for="nps_image_' + num + '">')
                        .append($('<span class="nps_image_' + num + '_text"></span>').html('選擇圖片'))
                        .append($('<input class="hide" type="file" id="nps_image_' + num + '" class="js-image" name="nps[' + num + '][image]"><label class="ps_href_label" for="nps_href_' + num + '">圖片連結<input class="ps_href_input" type="text" id="nps_href_' + num + '" name="nps[' + num + '][href]" style="width: calc(100% - 60px);"></label>'))
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
            success: function (res) {
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
            $('.' + $(this).attr('id') + '_text').text('已選取圖片');
            $('.' + $(this).attr('id') + '_text').css('color', 'green');
        }else{
            $('.' + $(this).attr('id') + '_text').text('無選取圖片');
            $('.' + $(this).attr('id') + '_text').css('color', 'red');
        }
    });

    function make_ckeditor (a) {
        CKEDITOR.replace(a.attr('id'), {
            customConfig: '/vendor/ckeditor/config.js'
        });
    }
</script>
