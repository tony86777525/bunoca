$(function(){
    $(".js-add-item").submit(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "set_buy_record",
            data: $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if(res.check){
                    swal({
                        title: '已加入購物車',
                        text: "是否前往結帳",
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '前往結帳',
                        cancelButtonText: '繼續選購'
                    }).then((result) => {
                        if (result) {
                            window.location.href = '/home/shoppingCart';
                        }
                    }).catch(swal.noop);
                }else{
                    swal({
                        type: 'error',
                        title: '請稍後再試',
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
