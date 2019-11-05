@inject('mainPresenter', 'App\Presenters\MainPresenter')
<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="">
        <div class="container">
            <a class="navbar-brand" href="/"><img width="50" src="/img/index/logo.png">BUNOCA VIETNAM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('index') }}#about">GIỚI THIỆU<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}#companyLocation">公司位置<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="dropdown">
                        <div class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">台灣精品</div>
                        <div class="dropdown-menu">
                            @foreach($mainPresenter->productList() as $product)
                                <a class="dropdown-item" href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank">{{ $product->p_title }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                @guest
                    <div>
                        <a href="/login" class="nav-link">登入</a>
                    </div>
                    <div>
                        <a href="/register" class="nav-link">註冊</a>
                    </div>

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
