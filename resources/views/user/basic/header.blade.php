@inject('housePresenter', 'App\Presenters\HousePresenter')
@inject('mainPresenter', 'App\Presenters\MainPresenter')
<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}"><img width="50" src="{{ asset('img/index/logo.png') }}">BUNOCA VIETNAM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @if($housePresenter->isCurrentRouteName(['house', 'westPoint', 'oceanPark', 'smartCity']))
                        @include('user.basic.navbarHouse')
                    @else
                        @include('user.basic.navbarIndex')
                    @endif
                </ul>
                @guest
                    <div><a href="{{ route('login') }}" class="nav-link">{{ $mainPresenter->showText('login') }}</a></div>
                    <div><a href="{{ route('register') }}" class="nav-link">{{ $mainPresenter->showText('register') }}</a></div>
                @else
                    <div>
                        <a href="/login" class="nav-link">{{ Auth::user()->name }}</a>
                    </div>
                    <div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Thoát ra') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</div>
