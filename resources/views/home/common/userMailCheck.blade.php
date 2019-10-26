@inject('mainPresenter', 'App\Presenters\MainPresenter')
@if( !empty(Auth::user()->create_token))
    <div class="btn btn-success js-send_check_mail" style="float: right;">{{ $mainPresenter->showText('userMailCheck') }}</div>
@endif
