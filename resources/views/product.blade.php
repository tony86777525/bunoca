<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <title>Laravel</title>

        <style>
            .test {
                font-size: 32px;
                font-weight: bold;
                border-bottom: 1px solid black
            }
            .space {
                margin-top: 4em;
                padding: 1em;
            }
        </style>
    </head>
    <body>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light bg-info" style="">
                <div class="container">
                      <a class="navbar-brand" href="#"><img src="https://www.taiwanexcellence.org/official/images/layout/logo/logo_en.svg"></a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item active">
                            <a class="nav-link" href="#">關於我們 <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">購物中心</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">最近消息</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">聯絡我們</a>
                          </li>
                          <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                          </li> -->
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                        </form>
                      </div>
                </div>
            </nav>
        </div>
        <div class="space" style="background-color: #545454;">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="https://s.yimg.com/vd/ec-material/mall_tw_hp/s11-g_big-f1-5cff6578580bf.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://s.yimg.com/vd/ec-material/mall_tw_hp/s13-g_big-f1-5cff6716d3639.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://s.yimg.com/vd/ec-material/mall_tw_hp/s31-g_big-f1-5cff65f25f4d5.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card space">
                      <img src="https://f.ecimg.tw/img/h24/v2/layout/sign/beauty/20190612164426_b7-06-640x640.jpg" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                        <p class="card-text">M89火山能量微精華5</p>
                        <p class="card-text">$1243</p>
                        <label><button type="button" class="btn btn-dark p-1 mr-1">-</button><input type="number" class="mr-1" style="width: 50px;padding-top: 1px;padding-bottom: 5px;"><button type="button" class="btn btn-dark p-1 mr-1">+</button><button type="button" class="btn btn-info">加入購物車</button></label>
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card space">
                      <img src="https://f.ecimg.tw/img/h24/v2/layout/sign/beauty/20190612164426_b7-06-640x640.jpg" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                        <p class="card-text">M89火山能量微精華5</p>
                        <p class="card-text">$1243</p>
                        <label><button type="button" class="btn btn-dark p-1 mr-1">-</button><input type="number" class="mr-1" style="width: 50px;padding-top: 1px;padding-bottom: 5px;"><button type="button" class="btn btn-dark p-1 mr-1">+</button><button type="button" class="btn btn-info">加入購物車</button></label>
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card space">
                      <img src="https://f.ecimg.tw/img/h24/v2/layout/sign/beauty/20190612164426_b7-06-640x640.jpg" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                        <p class="card-text">M89火山能量微精華5</p>
                        <p class="card-text">$1243</p>
                        <label><button type="button" class="btn btn-dark p-1 mr-1">-</button><input type="number" class="mr-1" style="width: 50px;padding-top: 1px;padding-bottom: 5px;"><button type="button" class="btn btn-dark p-1 mr-1">+</button><button type="button" class="btn btn-info">加入購物車</button></label>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card space">
                      <img src="https://f.ecimg.tw/img/h24/v2/layout/sign/beauty/20190612164426_b7-06-640x640.jpg" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                        <p class="card-text">M89火山能量微精華5</p>
                        <p class="card-text">$1243</p>
                        <label><button type="button" class="btn btn-dark p-1 mr-1">-</button><input type="number" class="mr-1" style="width: 50px;padding-top: 1px;padding-bottom: 5px;"><button type="button" class="btn btn-dark p-1 mr-1">+</button><button type="button" class="btn btn-info">加入購物車</button></label>
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card space">
                      <img src="https://f.ecimg.tw/img/h24/v2/layout/sign/beauty/20190612164426_b7-06-640x640.jpg" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                        <p class="card-text">M89火山能量微精華5</p>
                        <p class="card-text">$1243</p>
                        <label><button type="button" class="btn btn-dark p-1 mr-1">-</button><input type="number" class="mr-1" style="width: 50px;padding-top: 1px;padding-bottom: 5px;"><button type="button" class="btn btn-dark p-1 mr-1">+</button><button type="button" class="btn btn-info">加入購物車</button></label>
                      </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card space">
                      <img src="https://f.ecimg.tw/img/h24/v2/layout/sign/beauty/20190612164426_b7-06-640x640.jpg" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                        <p class="card-text">M89火山能量微精華5</p>
                        <p class="card-text">$1243</p>
                        <label><button type="button" class="btn btn-dark p-1 mr-1">-</button><input type="number" class="mr-1" style="width: 50px;padding-top: 1px;padding-bottom: 5px;"><button type="button" class="btn btn-dark p-1 mr-1">+</button><button type="button" class="btn btn-info">加入購物車</button></label>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 space">
                    <p class='test'>公司位置</p>
                    <div id="map"><img src="https://i.ytimg.com/vi/wtXFWU4r9FQ/maxresdefault.jpg" style="max-width: 100%;"></div>
                </div>
            </div>
        </div>



        <div class="footer text-white bg-dark space">
            <div class="" style="font-size: 0.5rem;line-height: 0.3em; margin-left: calc(100vw / 2 - 150px)">
                <p >BUNOCA VIET NAM COMPANY LIMITED</p>
                <p>Adds.：BT11-VT 25, Khu do thi Xa La,</p>
                <p style="margin-left: 42px">phuong Phu La, Ha Dong, Ha Noi</p>
                <p>Mobile. +84 962 764 918</p>
                <p>Email. XXXXX@gmail.com</p>
                <button type="button" class="btn btn-primary" style="width: 90px;"><a href="https://www.facebook.com/" class="text-white">FB</a></button>
                <button type="button" class="btn btn-danger" style="width: 90px;"><a href="https://www.youtube.com/" class="text-white">YouTube</a></button>
                <button type="button" class="btn btn-success" style="width: 90px;"><a href="http://line.naver.jp/R/msg/text/?http://www.emath.math.ncu.edu.tw/e_school/" class="text-white">LINE</a></button>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
