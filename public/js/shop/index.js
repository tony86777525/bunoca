$(function(){
    $('.js-add-item').submit(function() {
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
