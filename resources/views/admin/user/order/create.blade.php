<div class="container">
	<div class="row">
		<form id="create-order-form" action="#" method="POST" onsubmit="return false">
			<!-- 訂購者 -->
			<div class="form-group">
				<label for="user_id">會員</label>
				<select name="user_id" class="form-control" id="user_id">
					<option value="0">請選擇</option>
					@foreach($users as $user)
					<option value="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-address="{{$user->address}}">{{$user->name}} - {{$user->email}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="user_name">收件人</label>
				<input type="text" name="user_name" class="form-control" id="user_name" placeholder="Enter Name">
			</div>
			<div class="form-group">
				<label for="email">EMAIL</label>
				<input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
			</div>
			<div class="form-group">
				<label for="user_address">寄送住址</label>
				<input type="text" name="user_address" class="form-control" id="user_address" placeholder="Enter Address">
			</div>
			<div class="form-group">
				<label for="o_free_discount">自訂折扣</label>
				<input type="number" name="o_free_discount" class="form-control" id="o_free_discount" placeholder="Enter Order Free Discount" value="0">
			</div>
			<div class="form-group">
				<label for="o_fee">訂單運費</label>
				<input type="number" name="o_fee" class="form-control" id="o_fee" placeholder="Enter Order Fee" value="0">
			</div>
			<button type="button" class="btn btn-primary add-order-detail-table">新增訂單並繼續新增訂單商品</button>
			<button type="button" class="btn btn-primary add-or">xx</button>
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

		$(".add-order-detail-table").click(function(){
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
						$.pjax.reload('#pjax-container');
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
