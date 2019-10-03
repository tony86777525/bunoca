<div class="row">
	<form>
		<div class="col-md-3">
			<!-- 訂單 -->
			<h2>訂單資訊</h2>
			<!-- <div class="form-group">
				<label for="o_no">訂單編號</label>
				<input type="text" name="o_no" class="form-control" id="o_no" value="{{$order->o_no}}" placeholder="Enter Order No" disabled="disabled">
			</div> -->
			<div class="form-group">
				<label for="o_no">訂單編號</label>
				<p>{{$order->o_no}}</p>
			</div>
			<div class="form-group">
				<label for="o_money">商品總額</label>
				<input type="number" name="o_money" class="form-control" id="o_money" value="{{$order->o_money}}" placeholder="Enter Order Money" disabled="disabled">
			</div>
			<div class="form-group">
				<label for="o_discount">訂單折扣</label>
				<input type="number" name="o_discount" class="form-control" id="o_discount" value="{{$order->o_discount}}" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="o_free_discount">自訂折扣</label>
				<input type="number" name="o_free_discount" class="form-control" id="o_free_discount" value="{{$order->o_free_discount}}" placeholder="Enter Order Free Discount">
			</div>
			<div class="form-group">
				<label for="o_fee">訂單運費</label>
				<input type="number" name="o_fee" class="form-control" id="o_fee" value="{{$order->o_fee}}" placeholder="Enter Order Fee">
			</div>
			<div class="form-group">
				<label for="o_pay_monney">付款總額</label>
				<input type="number" name="o_pay_monney" class="form-control" id="o_pay_monney" value="{{$order->o_pay_monney}}" placeholder="Enter Order Money" disabled="disabled">
			</div>
			<!-- 訂購者 -->
			<h2>訂購者</h2>
			<div class="form-group">
				<label for="user_name">會員姓名</label>
				<input type="text" name="user_name" class="form-control" id="user_name" value="{{$order->user_name}}">
			</div>
			<div class="form-group">
				<label for="email">EMAIL</label>
				<input type="text" name="email" class="form-control" id="user_name" value="{{$order->user->email}}">
			</div>

			<div class="form-group">
				<label for="user_address">寄送住址</label>
				<input type="text" name="user_address" class="form-control" id="user_address" value="{{$order->user_address}}" placeholder="Enter Address">
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-3">
					<h2>核對項目</h2>
					<!-- 核對項目 -->
					<div class="form-group">
						<label for="pay_flg">付款狀態</label>
						<select name="pay_flg" class="form-control" id="pay_flg">
							<option value="0"{{$order->pay_flg == 0 ? ' selected="selected"': ''}}>未付款</option>
							<option value="1"{{$order->pay_flg == 1 ? ' selected="selected"': ''}}>已付款</option>
						</select>
					</div>
					<div class="form-group">
						<label for="arrival_flg">配貨狀態</label>
						<select name="arrival_flg" class="form-control" id="arrival_flg">
							<option value="0"{{$order->arrival_flg == 0 ? ' selected="selected"': ''}}>未配貨完成</option>
							<option value="1"{{$order->arrival_flg == 1 ? ' selected="selected"': ''}}>已配貨完成</option>
						</select>
					</div>
					<div class="form-group">
						<label for="deliver_flg">出貨狀態</label>
						<select name="deliver_flg" class="form-control" id="deliver_flg">
							<option value="0"{{$order->deliver_flg == 0 ? ' selected="selected"': ''}}>未出貨</option>
							<option value="1"{{$order->deliver_flg == 1 ? ' selected="selected"': ''}}>已出貨</option>
						</select>
					</div>
				</div>
			</div>
			<h2>訂購商品</h2>
			<button type="button" class="btn btn-primary">新增商品</button>
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
						<th scope="col">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php $total = 0; ?>
					@if(!empty($order))
					@foreach($order->order_detail as $k => $v)
					
						@if(!empty($v->product_single))
						<tr>
							<th scope="row">{{$k+1}}</th>
							<td>{{$v->product_single->product->p_name}}</td>
							<td>{{$v->product_single->ps_type}}</td>
							<td>{{$v->product_single->ps_price > 0 ? $v->product_single->ps_price : $v->product_single->product->p_price}}</td>
							<td>{{$v->od_num}}</td>
							<td>{{$v->od_arrival_flg == 1 ? '已配貨' : '未配貨'}}</td>
							<td>{{$v->product_single->ps_inventory}}</td>
							<td>{{$v->od_money}}</td>
							<td>
								<a><i class="fa fa-edit"></i></a>
								<a><i class="fa fa-trash"></i></a>
								<a><i class="fa fa-truck"></i></a>
							</td>
						</tr>
						@elseif(!empty($v->product_sell))
							<tr>
							<th scope="row">{{$k+1}}</th>
							<td>{{$v->product_sell->ps_name}}</td>
							<td></td>
							<td>{{$v->product_sell->ps_price}}</td>
							<td>{{$v->od_num}}</td>
							<td>-</td>
							<td>-</td>
							<td>{{$v->od_money}}</td>
							<td>
								<a><i class="fa fa-edit"></i></a>
								<a><i class="fa fa-trash"></i></a>
							</td>
						</tr>
							@foreach($v->product_sell->product_sell_detail as $sell)
							<tr>
								<td></td>
								<td>{{$sell->product_single->product->p_name}}</td>
								<td>{{$sell->product_single->ps_type}}</td>
								<td>-</td>
								<td>{{$v->od_money * $sell->psd_quantity}}</td>
								<td>{{$sell->psd_arrival_flg == 1 ? '已配貨' : '未配貨'}}</td>
								<td>{{$sell->product_single->ps_inventory}}</td>
								<td>-</td>
								<td>
									<a><i class="fa fa-truck"></i></a>
								</td>
							</tr>
							@endforeach
						@endif
						<?php $total += $v->od_money?>
					
					@endforeach
					@endif
					<tr style="border-top:2px #000000 solid">
						<td colspan="6"></td>
						<td>加總</td>
						<td>{{$total}}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="6"></td>
						<td>折扣</td>
						<td>{{!empty($order) ? $order->o_discount : 0}}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="6"></td>
						<td>自訂折扣</td>
						<td>{{!empty($order) ? $order->o_free_discount : 0}}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="6"></td>
						<td>運費</td>
						<td>{{!empty($order) ? $order->o_fee : 0}}</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="4"></td>
						<td>原本</td>
						<td>{{!empty($order) ? $order->o_money : 0}}</td>
						<td>小記</td>
						<td>{{!empty($order) ? $total - $order->o_discount - $order->o_free_discount + $order->o_fee : 0}}</td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<center>
				<button type="submit" class="btn btn-primary">修改訂單</button>
			</center>
		</div>
	</form>
</div>
