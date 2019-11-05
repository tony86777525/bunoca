@inject('mainPresenter', 'App\Presenters\MainPresenter')
<div class="top-div">
    <div id="carouselExampleIndicators" data-interval="3000" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            @foreach($mainPresenter->productList() as $key => $product)
                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $key+1 ?>"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/img/index/top.jpg" class="d-block w-100 top-img top-img-opacity" alt="...">
                <div class="top-content d-none d-sm-block wow fadeInDown">
                    <h5 class="wow heartBeat" data-wow-delay="0.8s"><img width="100" src="/img/index/logo.png"></h5>
                    <p>BUNOCA VIETNAM</p>
                </div>
            </div>
            @foreach($mainPresenter->productList() as $product)
                <div class="carousel-item">
                    <a href="{{ route('shop', ['id' => $product->id]) }}/" target="_blank"><img src="/uploads/{{$product->p_image}}" class="d-block w-100 top-img" alt="..."></a>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="container space">
    <div class="row">
        <div class="col-12 space bg-light card" id="about">
            <p class='title wow fadeInLeft'>GIỚI THIỆU</p>
            <div class="row">
                <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="0.6s">
                  	<p class="text">
                        Bunoca Viet Nam tự hào là Công ty thương mại chuyên xuất nhập khẩu các sản phẩm chất lượng cao của Đài Loan và Việt Nam. Các sản phẩm bao gồm: mỹ phẩm, thực phẩm bổ dưỡng, các sản phẩm bảo vệ sức khỏe, thực phẩm, và rất nhiều các sản phẩm khác đảm bảo chất lượng.
                        Chúng tôi cam kết sẽ là cầu nối để đưa các sản phẩm chất lượng cao tốt nhất của Đài Loan đến với người tiêu dùng Việt Nam, và Việt Nam đến Đài Loan. Để người tiêu dùng cả 2 nơi có thể thưởng thức, sử dụng các sản phẩm tốt nhất của nhau.
                        Giá của các sản phẩm trên trang web chính thức là giá bán buôn, vì vậy mô hình của Bunoca Viet Nam là hình thức bán buôn.
                    </p>
                  	<p class="text font-weight-bold font-italic">
              			Bạn luôn được chào đón là đại lý khu vực các sản phẩm của chúng tôi. Bạn cũng có thể tìm thấy các sản phẩm Đài Loan bạn cần hoặc các sản phẩm Việt Nam bạn muốn xuất khẩu sang Đài Loan.
                    </p>
                </div>
                <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="1.2s">
                    <div class="pic">
                        <img class="img-responsive" width="100%" src="/img/index/about.jpg">
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="col-12 space bg-light card">
          	<div class="border-img"><p class='title'>公司介紹</p></div>

            <p class="text">誠信，創新，負責<br><br>
                誠信：誠信是本公司最重要的無形資產，我們堅持以言出必行，信守承諾的原則，贏取客戶的信頼。<br><br>
                創新：核心技術以創新作為企業生存發展的推動要素之一。沒有創新能力的企業必然逐步失去市場競爭力，最終被市場淘汰。只有不斷學習，持續自我反省，才能不斷創新，不斷進步。<br><br>
                負責：負責是本公司的服務精神，我們的企業對客戶負責，對員工負責，也對社會負責；而我們的員工對工作負責，對夥伴負責，如此我們就可以具有專業、誠信、負責的團隊合作精神，去服務客戶，實現共同的理念。
            </p>
        </div>

        <div class="col-12 space bg-light card">
            <p class='title'>公司業務</p>
            <p class="text">
                本公司的主要業務，是製作大型網站及從事業務系統開發、設計、維護。<br>
                本公司的專案中約80%是由集團公司提供，<br>
                因此擁有一個穩定的收益，並可提供，良好的工作環境。<br>
                我們製作日本最大的休閒網站和人才招募網站。<br>
                由於我們日本公司持續的研發高質技術，<br>
                所承擔製作的官方網站，<br>
                月間瀏覽數總是超出千萬的，也因此公司業績直線上升。<br>
                我們竭誠將這些經驗與技術著力在本公司事業，<br>
                並期盼進而挑戰商業模式的擴大與發展。
            </p>
        </div>

        <div class="col-12 space bg-light card">
            <p class='title'>公司堅持</p>
            <div class="row">
                <div class="col-12 col-md-4 space">
                    <div class="card" style="border:0px">
                        <center>
                            <img src="https://www.esunbank.com.tw/bank/-/media/esunbank/images/home/about/feature_02_150831.png?h=141&la=en&w=141" width="141" height="141" alt="...">
                        </center>
                        <div class="card-body text-center">
                            <p class="card-text">服務</p>
                            <p class="card-text">
                                服務，源於一顆溫暖的心，是發自內心的真誠與熱忱，也是玉山人的DNA。玉山領先將精緻服務與全面創新的觀念帶進金融業，首創大廳接待員與顧客服務師，榮獲最多銀行業服務大獎，我們認為提供有溫度的服務與優質顧客體驗，才能真正創造顧客的價值。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 space card">
                    <div class="card" style="border:0px">
                        <center>
                            <img src="https://www.esunbank.com.tw/bank/-/media/esunbank/images/home/about/feature_01_150831.png?h=141&la=en&w=141" width="141" height="141" alt="...">
                        </center>
                        <div class="card-body text-center">
                            <p class="card-text">專業</p>
                            <p class="card-text">
                                創立之初，玉山就建立專家領航的專業經營制度，用心培育最專業的人才，提供顧客最好的服務。從傾聽顧客聲音開始，透過瞭解顧客需求，建構產品地圖，創造產品差異，聚焦客群經營，整合玉山的資源與團隊，有效解決顧客的問題，提供完整的解決方案。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 space card">
                    <div class="card" style="border:0px">
                        <center>
                            <img src="https://www.esunbank.com.tw/bank/-/media/esunbank/images/home/about/feature_03_150831.png?h=141&la=en&w=141" width="141" height="141" alt="...">
                        </center>
                        <div class="card-body text-center">
                            <p class="card-text">科技</p>
                            <p class="card-text">
                                為了持續提供顧客更好的金融服務，因應Bank 3.0的趨勢，玉山運用創新的科技，領先同業推出許多金融創新，譬如兩岸支付通、玉山全球通、票券預售通、e指可貸、e指辦卡、行動CEO、行動理專等，期望透過創新，和大家共創更美好的生活。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="col-12 space bg-light card" id="companyLocation">
            <p class='title wow fadeInLeft'>公司位置</p>
          	<center>
              	<div id="map" class="wow flipInX" data-wow-delay="0.6s"><img src="/img/index/map.jpg" style="max-width: 100%;"></div>
          	</center>
        </div>
    </div>
</div>
