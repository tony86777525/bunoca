<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="">
        <div class="container">
            <a class="navbar-brand" href="/"><img width="50" src="/img/index/logo.png">BUNOCA VIETNAM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(empty($side_title)) active @endif" href="{{ route('house') }}">房地產</a>
                    </li>
                    @if(!empty($side_title))
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route($side_title['href']) }}">{{ $side_title['title'] }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
