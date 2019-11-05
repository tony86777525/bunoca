@inject('housePresenter', 'App\Presenters\HousePresenter')
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
                    <div><a href="/login" class="nav-link">登入</a></div>
                    <div><a href="/register" class="nav-link">註冊</a></div>
                @else
                    <div>
                        <a href="/login" class="nav-link">{{ Auth::user()->name }}</a>
                    </div>
                    <div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('登出') }}
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
