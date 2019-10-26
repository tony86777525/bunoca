@inject('mainPresenter', 'App\Presenters\MainPresenter')
<div class="card">
    <div class="card-header">
        <div class="btn">{{ $mainPresenter->showText('message') }}</div>
        @include('home.common.userMailCheck')
    </div>
    <div class="card-body message-board">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="text-center align-bottom"><a href="/index" class="btn btn-primary" style="margin-top: calc(43vh - 100px);">{{ $mainPresenter->showText('goIndex') }}</a></div>
    </div>
    @include('home.tool')
</div>

