<link rel="stylesheet" href="/css/admin/product/detail.css">
<div class="container">
    <div class="row">
        <div>
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" class="tab-p" href="#p_form">{{$p_column_name['product']}}</a></li>
                <li class="active"><a data-toggle="tab" class="tab-ps" href="#ps_form">{{$p_column_name['product_detail']}}</a></li>
            </ul>
            <div class="tab-content">
                <div id="p_form" class="tab-pane fade form">
                    <div class="new-product">
                        <div class="form-group">
                            <label for="product_category_id">{{$p_column_name['product_category_id']}}： {{$pcArray[$product->product_category_id]}}</label>
                        </div>
                        <!-- 訂購者 -->
                        <div class="form-group">
                            <label for="p_name">{{$p_column_name['p_name']}}： {{$product->p_name}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_title">{{$p_column_name['p_title']}}： {{$product->p_title}}</label>
                        </div>
                        <div class="form-group">
                            <label for="p_price">{{$p_column_name['p_price']}}： {{$product->p_price}}</label></div>
                        <div class="form-group">
                            <label for="p_display_flg">{{$p_column_name['p_display_flg']}}： {{$p_display_flg_text[$product->p_display_flg]}}</label>
                        </div>
                        <div class="form-group">
                            @if(!empty($product->p_image))
                                <img class="p_image" src="{{'/uploads/'.$product->p_image}}"></label>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="ps_form" class="tab-pane fade in active form">
                    <div class="new-single">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{$ps_column_name['ps_type']}}</th>
                                    <th scope="col">{{$ps_column_name['ps_price']}}</th>
                                    <th scope="col">{{$ps_column_name['ps_inventory']}}</th>
                                    <th scope="col">{{$ps_column_name['ps_display_flg']}}</th>
                                    <th scope="col">{{$ps_column_name['ps_href']}}</th>
                                </tr>
                            </thead>
                            <tbody class="js-add-new-single">
                                @foreach($product->product_single as $k => $v)
                                <tr class="js-product-single-column">
                                    <th scope="row">
                                        {{$k+1}}
                                    </th>
                                    <td>{{$v->ps_title}}</td>
                                    <td>{{$v->ps_price}}</td>
                                    <td>{{$v->ps_inventory}}</td>
                                    <td></td>
                                    <td><a href="{{$v->ps_href}}" target="_blank">前往</a></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <table>
                                            <tr>
                                                <td class="ps_title"></td>
                                            </tr>
                                            <tr>
                                                <td><?= $v->ps_content ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td colspan="2">
                                        <img class="ps_image_{{$k}}" src="{{'/uploads/'.$v->ps_image}}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
