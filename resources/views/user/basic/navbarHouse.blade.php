@inject('mainPresenter', 'App\Presenters\MainPresenter')
@inject('housePresenter', 'App\Presenters\HousePresenter')
<li class="nav-item
@if($housePresenter->isCurrentRouteName('house'))
        active
@endif
        ">
    <a class="nav-link" href="{{ route('house') }}">房地產<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item
@if($housePresenter->isCurrentRouteName('smartCity'))
        active
@endif
        ">
    <a class="nav-link" href="{{ route('smartCity') }}">Smaity City<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item
@if($housePresenter->isCurrentRouteName('westPoint'))
        active
@endif
        ">
    <a class="nav-link" href="{{ route('westPoint') }}">West Point<span class="sr-only">(current)</span></a>
</li>
<li class="nav-item
@if($housePresenter->isCurrentRouteName('oceanPark'))
        active
@endif
        ">
    <a class="nav-link" href="{{ route('oceanPark') }}">Ocean Park<span class="sr-only">(current)</span></a>
</li>
