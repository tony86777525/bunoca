$(function(){
    $(".js-add-item").submit(function () {
        let p_id = $('input[name="p_id"]').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/shop/" + p_id + "/set_buy_record",
            data: $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if(res.check){
                    swal({
                        title: window.text.hasAddedShoppingCart,
                        text: window.text.isToPay,
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: window.text.toPay,
                        cancelButtonText: window.text.continueToShop
                    }).then((result) => {
                        if (result) {
                            window.location.href = '/home/shoppingCart';
                        }
                    }).catch(swal.noop);
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
    });

    $('.js-button-add').click(function() {
        var id = $(this).attr('data-id');
        var ori_value = $('#' + id).val();
        var value = $(this).attr('data-value');
        var total_value = Math.abs(parseInt(ori_value)+parseInt(value));

        if(total_value <= 1) {
            $(this).attr('disabled', true);
            total_value = 1;
        }else {
            $('.js-button-add').attr('disabled', false);
        }
        $('#' + id).val(total_value);
    });
});
