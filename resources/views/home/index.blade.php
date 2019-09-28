<div class="container top-div">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    訊息
                    @if( !empty(Auth::user()->create_token))
                        <div class="btn btn-success js-send_check_mail" style="float: right;">會員驗證</div>
                    @endif
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if( !empty($message) )
                        @if( $message['check'] )
                            <center style="margin-top: 30px;" class="btn btn-success"><?= $message['message'] ?></center>
                        @else
                            <center style="margin-top: 30px;" class="btn btn-danger"><?= $message['message'] ?></center>
                        @endif
                    @endif
                    <center><a href="/index" class="btn btn-primary" style="margin-top: 100px;">回首頁</a></center>
                </div>
                <div class="card-group">
                    <div class="card">
{{--                        <img src="..." class="card-img-top" alt="...">--}}
                        <div class="card-body">
                            <h5 class="card-title text-center">購物車</h5>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">三項商品未結帳</small>
                        </div>
                    </div>
                    <div class="card">
{{--                        <img src="..." class="card-img-top" alt="...">--}}
                        <div class="card-body">
                            <h5 class="card-title text-center">訂單紀錄</h5>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">三筆訂單未回報</small>
                        </div>
                    </div>
                    <div class="card">
{{--                        <img src="..." class="card-img-top" alt="...">--}}
                        <div class="card-body">
                            <h5 class="card-title text-center">會員資料</h5>
                        </div>
                        <div class="card-footer">
                            @if( !empty(Auth::user()->create_token))
                                <small class="text-danger">尚未通過會員驗證</small>
                            @endif
                                <small class="text-success">已通過會員驗證</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
