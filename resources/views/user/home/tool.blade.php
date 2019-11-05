@inject('mainPresenter', 'App\Presenters\MainPresenter')
<div class="card-group">
    <div class="card shopping-cart">
        <a href="{{ route('shoppingCart') }}" class="btn btn-primary">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $mainPresenter->showText('shoppingCart') }}</h5>
            </div>
        </a>
        <div class="card-footer">
            <a href="{{ route('shoppingCart') }}"><small class="text-muted">{{ $order_list_count }} {{ $mainPresenter->showText('shoppingCartUnPay') }}</small></a>
        </div>
    </div>
    <div class="card order-record">
        @if(!empty(Auth::user()->create_token))
            <button class="btn btn-secondary">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $mainPresenter->showText('orderRecord') }}</h5>
                </div>
            </button>
        @else
            <a href="{{ route('orderRecord') }}" class="btn btn-info">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $mainPresenter->showText('orderRecord') }}</h5>
                </div>
            </a>
        @endif

        @if($unpay_order_count > 0)
            <div class="card-footer">
                @if(empty(Auth::user()->create_token))
                    <a href="{{ route('orderRecord') }}"><small class="text-danger">{{ $unpay_order_count }} {{ $mainPresenter->showText('orderCount') }}{{ $mainPresenter->showText('orderPayFlg.0') }}</small></a>
                @endif
            </div>
        @endif
    </div>
    <div class="card user-data">
        <a href="{{ route('user') }}" class="btn btn-success">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $mainPresenter->showText('user') }}</h5>
            </div>
        </a>
        <div class="card-footer">
            @if( !empty(Auth::user()->create_token))
                <small class="text-danger">{{ $mainPresenter->showText('userMailUncheck') }}</small>
            @else
                <small class="text-success">{{ $mainPresenter->showText('userMailChecked') }}</small>
            @endif
        </div>
    </div>
</div>
