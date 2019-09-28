$(function () {
    $('.js-send_check_mail').click(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "send_check",
            dataType: "json",
            success: function (res) {
                console.log(res);
                if(res.check){
                    swal(
                        res.message,
                        '',
                        'success'
                    );
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
});
