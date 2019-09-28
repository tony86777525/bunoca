<style>
	.fade.in {
	    background-color: white;
	}
	.spacing {
		margin-top: 4em;
	}
	.form {
		padding: 30px;
	}
	form {
	    overflow-x: auto;
	}
</style>
<div class="container">
	<div class="row">
		<div>
			<ul class="nav nav-tabs">
				<li><a data-toggle="tab" class="tab-p" href="#p_form">商品資訊</a></li>
				<li class="active"><a data-toggle="tab" class="tab-ps" href="#ps_form">商品明細</a></li>
			</ul>
			<div class="tab-content">
				<div id="p_form" class="tab-pane fade form">
					<form id="product-update-form" action="#" method="POST" onsubmit="return false">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{$product->id}}">
						<div class="new-product">
							<!-- 訂購者 -->
							<div class="form-group">
								<label for="class_product_id">商品分類</label>
								<select name="class_product_id" class="form-control" id="class_product_id" required="required">
									<option value="0">請選擇</option>
									@foreach($class_products as $class_product)
									<option value="{{$class_product->id}}"<?= $product->class_product_id == $class_product->id ? ' selected="selected"' : ''?>>{{$class_product->title}}</option>
									@endforeach
								</select>
							</div>

							<!-- <div class="form-group">
								<label for="o_discount">訂單折扣</label>
								<input type="number" name="o_discount" class="form-control" id="o_discount" aria-describedby="emailHelp" placeholder="Enter email">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div> -->
							<div class="form-group">
								<label for="p_name">商品名稱</label>
								<input type="text" name="p_name" class="form-control" id="p_name" value="{{$product->p_name}}" required="required" placeholder="Enter Product Name">
							</div>
							<div class="form-group">
								<label for="p_price">預設價格</label>
								<input type="number" name="p_price" class="form-control" id="p_price" value="{{$product->p_price}}" required="required" placeholder="Enter Product Price">
							</div>
							<div class="form-group">
								<label for="p_cost">預設成本</label>
								<input type="number" name="p_cost" class="form-control" id="p_cost" value="{{$product->p_cost}}" required="required" placeholder="Enter Product Cost">
							</div>
							<div class="form-group">
								<label for="p_display_flg">顯示狀態</label>
								<select name="p_display_flg" class="form-control" id="p_display_flg">
									<option value="1"<?= $product->p_display_flg == 1 ? ' selected="selected"' : ''?>>顯示</option>
									<option value="0"<?= $product->p_display_flg == 0 ? ' selected="selected"' : ''?>>隱藏</option>
								</select>
							</div>
							<center>
								<button type="button" class="btn btn-success button-spacing update-product">儲存</button>
							</center>
						</div>
					</form>
				</div>
				<div id="ps_form" class="tab-pane fade in active form">
					<form id="product_single-update-form" action="#" method="POST" onsubmit="return false">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{$product->id}}">
						<div class="new-single">
							<!-- 訂購商品 -->
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">編號</th>
										<!--<th scope="col">規格</th>-->
										<th scope="col">單價</th>
										<!--<th scope="col">成本</th>-->
										<!--<th scope="col">庫存</th>-->
										<!--<th scope="col">增減</th>-->
										<th scope="col">狀態</th>
										<th scope="col">操作</th>
									</tr>
								</thead>
								<tbody class="js-add-new-single">
									@foreach($product->product_single as $k => $v)
									<tr>
										<th scope="row">
											{{$k+1}}
											<input type="hidden" name="ps[{{$k}}][id]" value="{{$v->id}}">
										</th>
										<!--<td>
											<div class="form-group">
												<input type="text" name="ps[{{$k}}][no]" class="" value="{{$v->ps_no}}" placeholder="" required="required">
											</div>
										</td>-->
										<td>
											<div class="form-group">
												<input type="text" name="ps[{{$k}}][type]" class="" value="{{$v->ps_type}}" placeholder="大,紅色,蜘蛛人" required="required">
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="number" name="ps[{{$k}}][price]" class="" value="{{$v->ps_price}}" placeholder="Enter Product Single Price">
											</div>
										</td>
										<!--<td>
											<div class="form-group">
												<input type="number" name="ps[{{$k}}][cost]" class="" value="{{$v->ps_cost}}" placeholder="Enter Product Single Cost">
											</div>
										</td>-->
										<!--<td>
											{{$v->ps_inventory}}
											<input type="hidden" name="ps[{{$k}}][inventory]" value="{{$v->ps_inventory}}">
										</td>-->
										<!--<td>
											<div class="form-group">
												<input type="number" name="ps[{{$k}}][add_inventory]" class="" value="0" placeholder="Enter Product Inventory">
											</div>
										</td>-->
										<td>
											<div class="form-group">
												<select name="ps[{{$k}}][display_flg]" class="">
													<option value="1"<?= $v->ps_display_flg == 1 ? ' selected="selected"' : ''?>>顯示</option>
													<option value="0"<?= $v->ps_display_flg == 0 ? ' selected="selected"' : ''?>>隱藏</option>
												</select>
											</div>
										</td>
										<td>
											<button type="button" class="btn btn-danger delete-productSingle" data-id="{{$v->id}}">刪除</button>
										</td>
									</tr>
									<tr>
                                      	<td></td>
                                      	<td colspan="2">
                                          	<table>
                                              	<tr>
                                                  	<td>標題: </td>
                                                  	<td style="padding-bottom: 5px;"><input name="ps[{{$k}}][title]" style="width: 323px;" value="{{$v->ps_title}}"></td>
                                              	</tr>
                                              	<tr>
                                                  	<td>內容: </td>
                                                  	<td><textarea name="ps[{{$k}}][content]" rows="4" cols="50">{{$v->ps_content}}</textarea></td>
                                              	</tr>
                                          	</table>
                                      	</td>
                                      	<td colspan="2">
                                          	<?php if(!empty($v->ps_image)): ?>
                                          		<img src="{{env('APP_URL').'/uploads/'.$v->ps_image}}">
                                          	<?php endif; ?>
                                      	</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<center>
								<button type="button" class="btn btn-success add-product-single-table" data-stepClass="step-list-1">新增</button>
							</center>
							<!--<center class="spacing">-->
							<!--	<button type="button" class="btn btn-success button-spacing update-productSingle">儲存</button>-->
							<!--</center>-->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var num = $(".new-single tbody").find('tr').length;
	$(".add-product-single-table").click(function(){
		var trNo = 'tr' + (num + 1);
		$(".new-single").find('.js-add-new-single')
		.append($('<tr class="' + trNo + '">')
			.append($('<th scope="row">' + (num + 1) + '</th>'))
			// .append($('<td>')
			// 	.append($('<div class="form-group">')
			// 		.append('<input type="text" name="nps[' + num + '][no]" class="" required="required" placeholder="">'
			// 		)
			// 	)
			// )
			.append($('<td>')
				.append($('<div class="form-group">')
					.append('<input type="text" name="nps[' + num + '][type]" class="" required="required" placeholder="大,紅色,蜘蛛人">'
					)
				)
			)
			.append($('<td>')
				.append($('<div class="form-group">')
					.append('<input type="number" name="nps[' + num + '][price]" class="" value="0" placeholder="Enter Product Single Price">'
					)
				)
			)
			// .append($('<td>')
			// 	.append($('<div class="form-group">')
			// 		.append('<input type="number" name="nps[' + num + '][cost]" class="" value="0" placeholder="Enter Product Single Cost">'
			// 		)
			// 	)
			// )
			// .append($('<td>')
			// 	.append($('<div class="form-group">')
			// 		.append('<input type="number" name="nps[' + num + '][inventory]" class="" value="0" placeholder="Enter Product Inventory">'
			// 		)
			// 	)
			// )
			// .append($('<td>')
			// )
			.append($('<td>')
				.append($('<div class="form-group">')
					.append($('<select name="nps[' + num + '][display_flg]" class="">')
						.append('<option value="1">顯示</option>')
						.append('<option value="0">隱藏</option>')
					)
				)
			)
			.append($('<td>')
				.append('<button type="button" class="btn btn-danger cancel-productSingle" data-no="' + trNo + '">取消</button>'
				)
			)
		);
		num += 1;
	});

	$(".update-product").click(function(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			url: "update_product",
			data: $('#product-update-form').serialize(),
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
	$(".update-productSingle").click(function(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			url: "update_product_single",
			data: $('#product_single-update-form').serialize(),
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
	})

</script>