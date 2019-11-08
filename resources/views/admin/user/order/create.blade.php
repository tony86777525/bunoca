<div class="container">
    <div class="row">
        <form id="create-order-form" action="#" method="POST" onsubmit="return false">
            <!-- 訂購者 -->
            <div class="form-group">
                <label for="user_id">{{$o_column_name['user_id']}}</label>
                <select name="user_id" class="form-control" id="user_id">
                    <option value="0">-</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-address="{{$user->address}}">{{$user->name}} - {{$user->email}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_name">{{$o_column_name['user_name']}}</label>
                <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="user_address">{{$o_column_name['user_address']}}</label>
                <input type="text" name="user_address" class="form-control" id="user_address" placeholder="Enter Address">
            </div>
            <div class="form-group">
                <label for="o_fee">{{$o_column_name['o_discount']}}</label>
                <input type="number" name="o_fee" class="form-control" id="o_fee" placeholder="Enter Order Fee" value="0">
            </div>
            <div class="form-group">
                <label for="o_free_discount">{{$o_column_name['o_free_discount']}}</label>
                <input type="number" name="o_free_discount" class="form-control" id="o_free_discount" placeholder="Enter Order Free Discount" value="0">
            </div>
            <button type="button" class="btn btn-primary js-create-order">{{$o_column_name['add_order_and_continue_add_order_detail']}}</button>
        </form>
    </div>
</div>

<script>
    $(function () {
        $("#user_id").change(function () {
            $("#email").val($(this).find(':selected').attr('data-email'));
            $("#user_address").val($(this).find(':selected').attr('data-address'));
            $("#user_name").val($(this).find(':selected').attr('data-name'));
        });

        $(".js-create-order").click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "create/create_order",
                data: $('#create-order-form').serialize(),
                dataType: "json",
                success: function (res) {
                    if(res.check){
                        toastr.success(res.message);
                        window.location.href = '/admin/user/order/' + res.data +  '/edit'
                    }
                },
                error : function() {

                }
            });
        });

    });
</script>
