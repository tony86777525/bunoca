@inject('mainPresenter', 'App\Presenters\MainPresenter')
@inject('housePresenter', 'App\Presenters\HousePresenter')
<li class="nav-item@if($housePresenter->isCurrentRouteName('house')) active@endif">
    <a class="nav-link" href="{{ route('index') }}#about">GIỚI THIỆU<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('index') }}#news">TIN TỨC<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('index') }}#contactUs">LIÊN HỆ<span class="sr-only">(current)</span></a>
</li>
{{--<li class="nav-item@if($housePresenter->isCurrentRouteName('house')) active@endif">--}}
    {{--<a class="nav-link" href="{{ route('house') }}">房地產<span class="sr-only">(current)</span></a>--}}
{{--</li>--}}
<li class="dropdown  d-none d-lg-block">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SẢN PHẨM</a>
    <div class="dropdown-menu dropdown-menu-center">
        <table class=" d-none d-lg-block">
            <thead>
            <tr>
                @foreach($mainPresenter->productCategoryList() as $productCategory)
                    <td>
                        <div class="dropdown-item">{{ $productCategory->pc_type }}</div>
                        <div class="dropdown-divider"></div>
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody class="dropdown-table-tbody">
            <tr>
                @foreach($mainPresenter->productCategoryList() as $productCategory)
                    <td>
                        @foreach($productCategory->product as $product)
                            <a class="dropdown-item dropdown-item-product" href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank"> - {{ $product->p_title }}</a>
                        @endforeach
                        @foreach($productCategory->children as $productCategory)
                            <div class="dropdown-item">{{ $productCategory->pc_type }}</div>
                            @foreach($productCategory->product as $product)
                                <a class="dropdown-item dropdown-item-product" href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank"> - {{ $product->p_title }}</a>
                            @endforeach
                        @endforeach
                    </td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
</li>
<li class="dropdown d-lg-none">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SẢN PHẨM</a>
    <div class="dropdown-menu">
        @foreach($mainPresenter->productCategoryList() as $productCategory)
            <div class="dropdown-item">{{ $productCategory->pc_type }}</div>
            <div class="dropdown-divider"></div>
            @foreach($productCategory->product as $product)
                <a class="dropdown-item dropdown-item-product" href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank"> - {{ $product->p_title }}</a>
            @endforeach
            @foreach($productCategory->children as $productCategory)
                <div class="dropdown-item">{{ $productCategory->pc_type }}</div>
                @foreach($productCategory->product as $product)
                    <a class="dropdown-item dropdown-item-product" href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank"> - {{ $product->p_title }}</a>
                @endforeach
            @endforeach
        @endforeach
    </div>
</li>

