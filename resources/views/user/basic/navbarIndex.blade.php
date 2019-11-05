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
<li class="dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SẢN PHẨM</a>
    <div class="dropdown-menu">
        @foreach($mainPresenter->productList() as $product)
            <a class="dropdown-item" href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank">{{ $product->p_title }}</a>
        @endforeach
    </div>
</li>

