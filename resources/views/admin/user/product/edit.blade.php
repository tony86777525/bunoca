<link rel="stylesheet" href="/css/admin/product/edit.css">
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
						<input type="hidden" name="id" value="{{$product['id']}}">
						<div class="new-product">
							<!-- 訂購者 -->
							<div class="form-group">
								<label for="p_name">{{$p_column_name['p_name']}}</label>
                                <input type="text" name="p_name" class="form-control" id="p_name" value="{{$product->p_name}}" placeholder="Enter Product Name">
							</div>
                            <div class="form-group">
                                <label for="p_price">{{$p_column_name['p_price']}}</label>
                                <input type="number" name="p_price" class="form-control" id="p_price" value="{{$product->p_price}}" placeholder="Enter Product Price">
                            </div>
							<div class="form-group">
								<label for="p_display_flg">{{$p_column_name['p_display_flg']}}</label>
								<select name="p_display_flg" class="form-control" id="p_display_flg">
									<option value="1"<?= $product->p_display_flg == 1 ? ' selected="selected"' : ''?>>販售中</option>
									<option value="0"<?= $product->p_display_flg == 0 ? ' selected="selected"' : ''?>>停售中</option>
								</select>
							</div>
                            <div class="form-group">
                                @if(!empty($product->p_image))
                                    <label for="p_image"><span class="p_image_text">{{$p_column_name['p_image']}}</span><img class="p_image" src="{{env('APP_URL').'/uploads/'.$product->p_image}}"></label>
                                @else
                                    <label for="p_image"><span class="p_image_text">{{$p_column_name['p_image']}}</span></label>
                                @endif
                                <div>
                                    <input type="file" id="p_image" class="js-image" name="p_image hide">
                                </div>
                            </div>
							<center>
								<button type="button" class="btn btn-success button-spacing update-product">修改</button>
							</center>
						</div>
					</form>
				</div>
				<div id="ps_form" class="tab-pane fade in active form">
					<form id="product_single-update-form" action="#" method="POST" onsubmit="return false">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{$product->id}}">
						<div class="new-single">
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">{{$ps_column_name['ps_type']}}</th>
										<th scope="col">{{$ps_column_name['ps_price']}}</th>
										<th scope="col">{{$ps_column_name['ps_inventory']}}</th>
										<th scope="col">增減</th>
										<th scope="col">{{$ps_column_name['ps_display_flg']}}</th>
										<th scope="col">{{$ps_column_name['actions']}}</th>
									</tr>
								</thead>
								<tbody class="js-add-new-single">
									@foreach($product->product_single as $k => $v)
									<tr class="js-product-single-column">
										<th scope="row">
											{{$k+1}}
											<input type="hidden" name="ps[{{$k}}][id]" value="{{$v->id}}">
										</th>
										<td>
											<div class="form-group">
												<input type="text" name="ps[{{$k}}][type]" class="" value="{{$v->ps_type}}" required="required">
											</div>
										</td>
										<td>
											<div class="form-group">
												<input type="number" name="ps[{{$k}}][price]" class="" value="{{$v->ps_price}}">
											</div>
										</td>
										<td>
											{{$v->ps_inventory}}
											<input type="hidden" name="ps[{{$k}}][inventory]" value="{{$v->ps_inventory}}">
										</td>
										<td>
											<div class="form-group">
												<input type="number" name="ps[{{$k}}][add_inventory]" class="" value="0" placeholder="Enter Product Inventory">
											</div>
										</td>
										<td>
											<div class="form-group">
												<select name="ps[{{$k}}][display_flg]" class="">
													<option value="1"<?= $v->ps_display_flg == 1 ? ' selected="selected"' : ''?>>販售中</option>
													<option value="0"<?= $v->ps_display_flg == 0 ? ' selected="selected"' : ''?>>停售中</option>
												</select>
											</div>
										</td>
										<td>
											<button type="button" class="btn btn-danger delete-productSingle" data-id="{{$v->id}}">刪除</button>
										</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="3">
											<table>
												<tr>
													<td>標題</td>
													<td><input class="ps_title" name="ps[{{$k}}][title]" value="{{$v->ps_title}}"></td>
											  	</tr>
											  	<tr>
													<td>內容</td>
													<td><textarea class="ps_content" id="ps_content_{{$k}}" name="ps[{{$k}}][content]">{{$v->ps_content}}</textarea></td>
												</tr>
											</table>
										</td>
										<td colspan="4">
											@if(!empty($v->ps_image))
                                                <label for="ps_image_{{$k}}"><span class="ps_image_{{$k}}_text">選擇圖片</span><img class="ps_image_{{$k}}" src="{{env('APP_URL').'/uploads/'.$v->ps_image}}"></label>
                                            @else
                                                <label for="ps_image_{{$k}}">選擇圖片</label>
											@endif
                                            <div>
                                                <input type="file" id="ps_image_{{$k}}" class="js-image hide" name="ps[{{$k}}][image]">
                                                <label for="ps_href_{{$k}}" class="ps_href_label">圖片連結<input type="text" id="ps_href_{{$k}}" name="ps[{{$k}}][href]" value="{{$v->ps_href}}" class="ps_href_input"></label>
                                            </div>
									  	</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<table>
								<tr>
									<td><button type="button" class="btn btn-success add-product-single-table" data-stepClass="step-list-1">+</button></td>
								</tr>
							</table>
							<center class="spacing">
								<button type="button" class="btn btn-success button-spacing update-productSingle">儲存</button>
							</center>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="/vendor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/vendor/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	var num = $(".new-single tbody").find('.js-product-single-column').length;
	$(".add-product-single-table").click(function(){
		var trNo = 'tr' + (num + 1);
		$(".new-single").find('.js-add-new-single')
		.append($('<tr class="js-product-single-column ' + trNo + '">')
			.append($('<th scope="row">' + (num + 1) + '</th>'))
			.append($('<td>')
				.append($('<div class="form-group">')
					.append('<input type="text" name="nps[' + num + '][type]" class="" placeholder="品名" required="required">'
					)
				)
			)
			.append($('<td>')
				.append($('<div class="form-group">')
					.append('<input type="number" name="nps[' + num + '][price]" class="" placeholder="單價" placeholder="Enter Product Single Price">'
					)
				)
			)
			.append($('<td>')
				.append($('<div class="form-group">')
					.append('<input type="number" name="nps[' + num + '][inventory]" class="" placeholder="庫存" placeholder="Enter Product Inventory">'
					)
				)
			)
			.append($('<td>')
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
            .append($('<td colspan="2">')
                .append($('<div>')
                    .append($('<label for="nps_image_' + num + '">')
                        .append($('<span class="nps_image_' + num + '_text"></span>').html('選擇圖片'))
                        .append($('<input class="js-image hide" type="file" id="nps_image_' + num + '" class="js-image" name="nps[' + num + '][image]"><label for="nps_href_' + num + '" class="ps_href_label">圖片連結<input class="ps_href_input" type="text" id="nps_href_' + num + '" name="nps[' + num + '][href]"></label>'))
                    )
                )
            )
		);

        make_ckeditor($('#new_ps_content_' + num));
		num += 1;
	});

	$(".update-product").click(function(){
        var data = new FormData($('#product-update-form')[0]);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			url: "update_product",
			data: data,
            dataType: "json",
            cache : false,
            processData : false,
            contentType : false,
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
        var data = new FormData($('#product_single-update-form')[0]);
        $(".ps_content").each(function(){
            data.append($(this).attr('name'), CKEDITOR.instances[$(this).attr('id')].getData());
        });
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			url: "update_product_single",
			data: data,
			dataType: "json",
            cache : false,
            processData : false,
            contentType : false,
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

    $(".ps_content").each(function(){
        make_ckeditor($(this));
    });

    function make_ckeditor (a) {
        CKEDITOR.replace(a.attr('id'), {
            customConfig: '/vendor/ckeditor/config.js'
        });
    }
</script>
