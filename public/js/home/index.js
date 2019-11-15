$(function () {
    $(document).on('click', '.js-send_check_mail', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/home/send_check",
            dataType: "json",
            beforeSend : function(){
                $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
            },
            success: function (res) {
                $.unblockUI();
                if(res.check){
                    toastr.success(res.message);
                }else{
                    swal(
                        res.message,
                        '',
                        'danger'
                    );
                }
            },
            error : function() {

            }
        });
    });

    $(document).on('click', '.js-create-order', function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "create_order",
            data: $('#create-order-form').serialize(),
            dataType: "json",
            beforeSend : function(){
                $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
            },
            success: function (res) {
                $.unblockUI();
                if(res.check){
                    window.location.href = 'shoppingPay/' + (res.data);
                }
            },
            error : function() {

            }
        });
    });

    $(document).on('click', '.js-delete-order-detail', function() {
        var ps_id = $(this).attr('data-id');
        swal({
            text: window.text.isDelete,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'gray',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YES',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "delete_order_detail",
                    data: {
                        ps_id: ps_id,
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
                        }else{
                            swal({
                                type: 'error',
                                title: window.text.waitForTry,
                                text: res.message,
                            })
                        }
                    },
                    error : function() {}
                });
            }
        }).catch(swal.noop);
    });

    $(document).on('click', '.js-button-add', function() {
        var id = $(this).attr('data-id');
        var ps_id = $('#' + id).attr('data-id');
        var ori_value = $('#' + id).val();
        var value = $(this).attr('data-value');
        var total_value = Math.abs(parseInt(ori_value)+parseInt(value));

        if(total_value < 1) {
            $(this).attr('disabled', true);
            total_value = 1;
            $('#' + id).val(total_value);
        }else {
            if(total_value == 1){
                $(this).attr('disabled', true);
            }else{
                $('.js-button-add').attr('disabled', false);
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "get_order_detail_price",
                data: {
                    ps_id: ps_id,
                    ps_quantity: total_value,
                },
                dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
                success: function (res) {
                    $.unblockUI();
                    if(res.check){
                        window.location.reload();
                    }
                },
                error : function() {}
            });
        }
    });

    $(document).on('change', 'input[name="o_pay_image"]', function() {
        if($(this).val){
            $('.o_pay_image_text').addClass('btn-secondary');
            $('.o_pay_image_text').removeClass('btn-outline-danger');
            $('.js-shoppingPay-success').attr('disabled', false);
        }else{
            $('.o_pay_image_text').addClass('btn-danger');
            $('.o_pay_image_text').removeClass('btn-outline-secondary');
            $('.js-shoppingPay-success').attr('disabled', true);
        }
        readURL(this, $("#o_pay_image_show"));
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

    $(document).on('click', ".js-shoppingPay-success", function(){
        let data = new FormData($('#shopping-pay-success-form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/home/shoppingPay/result",
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
});

// user
$(function () {
    $(document).on('click', '.js-user-modify', function() {
        $('label.' + $(this).attr('data-class')).hide();
        $('.' + $(this).attr('data-input')).show();
        $('a.' + $(this).attr('data-class')).show();
        $('.js-user-update').show();
        $(this).hide();
    });

    $(document).on('click', '.js-user-reset', function() {
        $('.' + $(this).attr('data-input')).val($(this).attr('data-value')).removeClass('has-change');
    });

    $(document).on('change', '.js-user', function() {
        if(!$(this).hasClass('has-change')){
            $(this).addClass('has-change');
        }
    });

    $(document).on('click', '.js-user-update', function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/home/update_user",
            data: $('#update-order-form').serialize(),
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
});

$(document).on('pjax:start', function() { NProgress.start(); });
$(document).on('pjax:end',   function() { NProgress.done();  });
