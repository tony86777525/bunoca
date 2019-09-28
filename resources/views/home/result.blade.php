<div class="container top-div">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">訊息</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if( !empty($message) )
                        @if( $message['check'] )
                            <center style="margin-top: 30px;" class="text-success"><?= $message['message'] ?></center>
                        @else
                            <center style="margin-top: 30px;" class="text-danger"><?= $message['message'] ?></center>
                        @endif
                    @endif
                    <div>
                        <a href="/home" class="btn btn-primary" style="margin-top: 100px;">會員</a>
                        <a href="/index" class="btn btn-primary" style="margin-top: 100px;">回首頁</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
