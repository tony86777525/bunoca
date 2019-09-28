<div class="row">
	<form action="/" method="POST">
		<div class="col-md-4">
		
			<!-- 訂購者 -->
			<div class="form-group">
				<label for="user_id">會員姓名</label>
				<select name="user_id" class="form-control" id="user_id">
					<option value="0">請選擇</option>
					@foreach($users as $user)
					<option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="email">EMAIL</label>
				<input type="text" name="email" class="form-control" id="email" disabled="disabled">
			</div>

			<div class="form-group">
				<label for="user_address">寄送住址</label>
				<input type="text" name="user_address" class="form-control" id="user_address" placeholder="Enter Address">
			</div>

			<!-- 訂單 -->
			<div class="form-group">
				<label for="o_no">訂單編號</label>
				<input type="text" name="o_no" class="form-control" id="o_no" value="{{$new_order_no}}" disabled="disabled">
			</div>

			<!-- <div class="form-group">
				<label for="o_discount">訂單折扣</label>
				<input type="number" name="o_discount" class="form-control" id="o_discount" aria-describedby="emailHelp" placeholder="Enter email">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div> -->
			<div class="form-group">
				<label for="o_free_discount">自訂折扣</label>
				<input type="number" name="o_free_discount" class="form-control" id="o_free_discount" placeholder="Enter Order Free Discount">
			</div>
			<div class="form-group">
				<label for="o_fee">訂單運費</label>
				<input type="number" name="o_fee" class="form-control" id="o_fee" placeholder="Enter Order Fee">
			</div>

			<!-- 核對項目 -->
			<!-- <div class="form-group">
				<label for="pay_flg">付款狀態</label>
				<select name="pay_flg" class="form-control" id="pay_flg">
					<option value="0">未付款</option>
					<option value="1">已付款</option>
				</select>
			</div>
			<div class="form-group">
				<label for="arrival_flg">配貨狀態</label>
				<select name="arrival_flg" class="form-control" id="arrival_flg">
					<option value="0">未配貨</option>
					<option value="1">已配貨</option>
				</select>
			</div>
			<div class="form-group">
				<label for="deliver_flg">出貨狀態</label>
				<select name="deliver_flg" class="form-control" id="deliver_flg">
					<option value="0">未出貨</option>
					<option value="1">已出貨</option>
				</select>
			</div> -->
		</div>
		<div class="col-md-8">
			<button type="submit" class="btn btn-primary">新增商品</button>
			<label for=""></label>
			
			<!-- 訂購商品 -->
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#{{!empty($order) ? $order->o_num : 0}}</th>
						<th scope="col">商品名稱</th>
						<th scope="col">商品規格</th>
						<th scope="col">商品單價</th>
						<th scope="col">商品數量</th>
						<th scope="col">配貨狀態</th>
						<!-- 查看用 -->
						<th scope="col">商品庫存</th>
						<th scope="col">商品總價</th>
					</tr>
				</thead>
				<tbody>
					<?php $total = 0; ?>
					@if(!empty($order))
					@foreach($order->order_detail as $k => $v)
					<tr>
						@if(!empty($v->product_single))
						<th scope="row">{{$k+1}}</th>
						<td>{{$v->product_single->product->p_name}}</td>
						<td>{{$v->product_single->ps_type}}</td>
						<td>{{$v->product_single->ps_price > 0 ? $v->product_single->ps_price : $v->product_single->product->p_price}}</td>
						<td>{{$v->od_num}}</td>
						<td>{{$v->arrival_flg}}</td>
						<td>{{$v->product_single->ps_inventory}}</td>
						<td>{{$v->od_money}}</td>
						@elseif(!empty($v->product_sell))
						<th scope="row">{{$k+1}}</th>
						<td>{{$v->product_sell->ps_name}}</td>
						<td></td>
						<td>{{$v->product_sell->ps_price}}</td>
						<td>{{$v->od_num}}</td>
						<td>{{$v->arrival_flg}}</td>
						<td>-</td>
						<td>{{$v->od_money}}</td>
						@endif
						<?php $total += $v->od_money?>
					</tr>
					@endforeach
					@endif
					<tr>
						<th scope="row"></th>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>加總</td>
						<td>{{$total}}</td>
					</tr>
					<tr>
						<th scope="row"></th>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>折扣</td>
						<td>{{!empty($order) ? $order->o_discount : 0}}</td>
					</tr>
					<tr>
						<th scope="row"></th>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>自訂折扣</td>
						<td>{{!empty($order) ? $order->o_free_discount : 0}}</td>
					</tr>
					<tr>
						<th scope="row"></th>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>運費</td>
						<td>{{!empty($order) ? $order->o_fee : 0}}</td>
					</tr>
					<tr>
						<th scope="row"></th>
						<td></td>
						<td></td>
						<td></td>
						<td>原本</td>
						<td>{{!empty($order) ? $order->o_money : 0}}</td>
						<td>小記</td>
						<td>{{!empty($order) ? $total - $order->o_discount - $order->o_free_discount + $order->o_fee : 0}}</td>
					</tr>
				</tbody>
			</table>
			<button type="submit" class="btn btn-primary">新增訂單</button>
			<button type="submit" class="btn btn-primary">新增訂單並繼續新增商品</button>
		</div>
	</form>
</div>
