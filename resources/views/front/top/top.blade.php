@extends('front.common.root')

@section('description','新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】は、企業・学生双方のコミュニケーションが可能な新時代の就活サイトです。全国の企業・学生の写真やPR動画を見て自由にメッセージ交換、オンライン面接を行うことができます。')

@section('title','LinkT(リンクト) - 新卒・第二新卒向けの次世代型就活サイト')

@section('css')
    <link rel="stylesheet" href="{{asset('js/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('js/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/base.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/modalwindow.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/chatstyle.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">

<!-- 追加フォント -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <!-- <style>
       body {font-family: "Josefin Sans";}
    </style> -->
<!-- ここまで     -->
    <style>
        .inner h3 {text-align: center;margin-bottom: 30px;line-height: 2;font-weight: 700;font-size: 17px;}
        .main__content__news__details p {text-align: left;}
        a.btn {padding: 21px 0;max-width: 250px;}
        a.btn-red {font-size: 18px;padding: 50px 0;max-width: 700px;}
        /* .fnd-company {border-radius: 20px;} */
        .fnd-company {box-shadow: 0 10px 25px 0 rgb(245, 245, 245, 3.5);}
        .find-company__selects select {border-radius: 7px;}
        .fnd-company__search input[type='search'] {width: 100%;border-radius: 7px;}
        /* .find-company__checklists {margin: 1px 0px 15px 0px;} */
        /* .find-company__button button[type='submit'] {border-radius: 7px;} */
        .find-company__button{float:none}
        .find-company__checklists input[type='checkbox'] + label {margin-bottom: 10px;}
        /* .center{width: 60%;margin: 0 auto;max-width: 500px;} */

        @media screen and (min-width: 1024px) {
            .inner {margin: 0 auto;padding: 0px !important;}
        }
        @media only screen and (min-width: 768px) and (max-width: 1023px){
            .inner { margin: 0 auto;padding: 0px !important;}
            .company_user {margin-left: 60px !important;}
            .main__content__news dl {font-size: 14px;}
        }
        @media only screen and (max-width: 640px) and (min-width: 320px){
            .main__content__coming .inner {padding: 0px;}
        }
        @media only screen and (max-width: 360px) and (min-width: 320px){
            a.btn {padding: 14px 0;width: 64%;}
        }
        @media only screen and (max-width: 374px) and (min-width: 361px){
            a.btn {padding: 12px 0;width: 62%;}
        }
        @media only screen and (max-width: 480px) and (min-width: 375px){
            a.btn {padding: 10px 0;width: 62%;}
        }
        @media only screen and (max-width: 640px) and (min-width: 481px){
            a.btn {padding: 15px 0;width: 61%;}
        }
        @media only screen and (max-width: 768px) and (min-width: 641px){
            a.btn {padding: 21px 0;width: 66%;}
        }

        .mtb3em{margin-top: 3em !important;margin-bottom: 3em !important;}
        @media screen and (min-width: 768px){
            .main__content__news {min-height: 0em;}
            .main__content__news__details {min-height: 8em;}
            .main__about, .main__movie{margin-bottom: 0em;}
            .main__movie{padding-top: 80px;padding-bottom: 80px;}
        }
        @media screen and (min-width: 600px){
            #device_capability {
                top: 80px;
            }
        }
        @media screen and (min-width: 320px) and (max-width: 599px){
            #device_capability {
                top: 50px;
            }
        }
    </style>
@stop

@section('js')
    <!-- TOPファーストビュー用 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('js/top/TweenMax.min.js')}}"></script>
    <script src="{{asset('js/top/main.js')}}"></script>
    <script src="{{asset('js/top/PixiPlugin.min.js')}}"></script>
    <script src="{{asset('js/top/pixi-legacy.min.js')}}"></script>
    <script src="{{asset('js/top/index.js')}}"></script>
    <!-- ここまで -->
    <script src="{{asset('js/top/top.js')}}"></script>
    <script src="{{asset('js/slick/slick.min.js')}}"></script>
    <script>
        $(function () {
            $('#catch_slider').slick({
                autoplay: true,
                autoplaySpeed: 6000,
                speed: 600,
                cssEase: 'ease-out',
                dots: true,
                arrows: true,
                pauseOnHover: false
            });

            if ($(window).width() < 768) {
                $('#slider').slick({
                    autoplay: true,
                    autoplaySpeed: 5000,
                    dots: true,
                    arrows: false
                });
            }
        });
    </script>

    <script>

        // FAQ処理
        $('.main__qa--more-qa').on("click",function(e) {
            // メニュー表示/非表示
            $(this).toggleClass('close').next('dd').slideToggle();
            e.stopPropagation();
        });


    </script>

@stop

@section('content')
<div class="base-main page-sitetop">
    <div class="sitetop-loader js-sitetop-loader"></div>
    <div class="sitetop-hero" id="sitetop-hero">
      <div class="sitetop-hero_container">
        <div class="sitetop-hero_content">

          <div class="sitetop-hero_txt">
            <div class="sitetop-hero_txtmask js-carouselmask">
              <div class="sitetop-hero_txtmaskimg js-carouselmaskimg" wovn-wait="">
                <p class="sitetop-hero_title" wovn-wait=""><span>さあ、新しい就活だ</span></p>
                <p class="sitetop-hero_lead" wovn-wait=""><span>企業と直接つながる就活サイト</span></p>
              </div>
            </div>
          </div>
          <div class="sitetop-hero_txt">
            <div class="sitetop-hero_txtmask js-carouselmask">
              <div class="sitetop-hero_txtmaskimg js-carouselmaskimg" wovn-wait="">
                <p class="sitetop-hero_title" wovn-wait=""><span>全てをオンラインで</span></p>
                <p class="sitetop-hero_lead" wovn-wait=""><span>#自宅で就活</span></p>
              </div>
            </div>
          </div>
          <!-- <div class="sitetop-hero_txt">
            <div class="sitetop-hero_txtmask js-carouselmask">
              <div class="sitetop-hero_txtmaskimg js-carouselmaskimg" wovn-wait="">
                <p class="sitetop-hero_title" wovn-wait=""><span>テキスト１</span></p>
                <p class="sitetop-hero_lead" wovn-wait=""><span>テキスト１<br>テキスト１テキスト１</span></p>
              </div>
            </div>
          </div> -->

        </div>
        <div class="sitetop-hero_figure">

          <div class="sitetop-hero_img">
            <picture>
              <!--[if IE 9]><video style="display: none;"><![endif]-->
              <source srcset={{asset('img/index/top_01-1.jpg')}} media="(min-width: 768px)"></source>
              <!--[if IE 9]></video><![endif]--><img src="{{asset('img/index/top_01-1.jpg')}}" alt=""></picture>
          </div>
          <div class="sitetop-hero_img">
            <picture>
              <!--[if IE 9]><video style="display: none;"><![endif]-->
              <source srcset={{asset('img/index/top_02-1.jpg')}} media="(min-width: 768px)"></source>
              <!--[if IE 9]></video><![endif]--><img src="{{asset('img/index/top_02-1.jpg')}}" alt=""></picture>
          </div>
          <!-- <div class="sitetop-hero_img">
            <picture>
              <source srcset={{asset('img/index/top_01-1.jpg')}} media="(min-width: 768px)"></source>
              <img src="{{asset('img/index/top_01-1.jpg')}}" alt=""></picture>
          </div> -->
          <div class="sitetop-hero_canvas" id="sitetop-hero_canvas"></div>
          <div class="sitetop-hero_progressbar" id="sitetop-hero_progressbar"></div>
        </div>
      </div>
      <div class="sitetop-hero_nav" id="sitetop-hero_nav">
        <div class="sitetop-hero_navmask">
          <div class="sitetop-hero_navinner">
            <div class="sitetop-next">
              <div class="sitetop-next_bg"></div>
              <div class="sitetop-next_thumbmask js-carouselmask">
                <div class="sitetop-next_thumbmaskimg js-carouselmaskimg">

                  <div class="sitetop-next_thumb -active">

                    <div class="sitetop-next_thumbinner" wovn-wait=""><img src="wp/wp-content/uploads/2020/02/top_02-1-180x124.jpg" alt="">

                      <span class="sitetop-next_txt">NEXT<br><strong>採用１</strong></span>

                    </div>
                  </div>
                  <div class="sitetop-next_thumb">

                    <div class="sitetop-next_thumbinner" wovn-wait=""><img src="wp/wp-content/uploads/2020/02/top_03-1-180x124.jpg" alt="">

                      <span class="sitetop-next_txt">NEXT<br><strong>採用２</strong></span>

                    </div>
                  </div>
                  <!-- <div class="sitetop-next_thumb">

                    <div class="sitetop-next_thumbinner" wovn-wait=""><img src="wp/wp-content/uploads/2020/02/top_01-1-180x124.jpg" alt="">

                      <span class="sitetop-next_txt">NEXT<br><strong>採用３</strong></span>

                    </div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          <div class="sitetop-hero_navbtn p-btn -block -md"><svg class="p-carousel_icon p-btn_icon c-icon">
              <use xlink:href="assets/img/common/sprite.svg#arrow_right"></use></svg></div>
        </div>
        <div class="sitetop-hero_pagination" id="sitetop-hero_pagination">
          <div class="sitetop-hero_paginationinner" wovn-wait=""><em>00</em><small>00</small></div>
        </div>
      </div>
    </div>
  </div>

    <section class="main__catch requid">
        <!-- <div id="catch_slider" class="main__catch__slider">
            <a href="{{route('front.static.describe')}}">
                <picture>
                    <source media="(max-width: 767px)" srcset={{asset('img/index/slider_main01_sp.jpg')}}>
                    <img src="{{asset('img/index/slider_main01_pc.jpg')}}" alt="自宅で就活">
                </picture>
            </a>
        </div> -->
        <nav class="main__catch__nav navSp sp fontSize--small">
            @if(!isset($memberAuthentication))
                <ul>
                    <li><a href="{{route('front.member.login')}}">ログイン</a></li>
                    <li><a href="{{route('front.static.select_entry')}}">会員登録</a></li>
                </ul>
            @endif
        </nav>
    </section>
    <section class="main__content">
        {{Form::open(['url'=>route('front.top.search') , 'class'=>("fnd-company")])}}
        @if( !empty($errors) && (!empty($errors->has('companyNameCondition')) || !empty($errors->has('industryCondition')) ||!empty($errors->has('jobTypeCondition')) || !empty($errors->has('areaCondition'))))
            <div class="error">
                @include('front.common.input_error', ['errors' => $errors, 'targets' => ['companyNameCondition','industryCondition','jobTypeCondition','areaCondition']])
            </div>
        @endif
        <div class="center">
        <div class="find-company__selects">
            <div class="selectBox__wrapper">
                {{Form::select('industryCondition', $data->get('businessTypeList'), $data->get("member.industryCondition"), ["class" => (!empty($errors->has('industryCondition')) ? "invalid-control" : ""), "id"=>"industryCondition","placeholder" => "業種"])}}
            </div>
            <div class="selectBox__wrapper">
                {{Form::select('jobTypeCondition', $data->get('jobTypeList'), $data->get("member.jobTypeCondition"), ["class" => (!empty($errors->has('jobTypeCondition')) ? "invalid-control" : ""), "id"=>"jobTypeCondition","placeholder" => "職種"])}}
            </div>
            <div class="selectBox__wrapper">
                {{Form::select('areaCondition', $data->get('prefectureList'), $data->get("member.areaCondition"), ["class" => (!empty($errors->has('areaCondition')) ? "invalid-control" : ""), "id"=>"areaCondition","placeholder" => "エリア"])}}
            </div>
            <div class="selectBox__wrapper">
              {{Form::search('companyNameCondition', $data->get("companyNameCondition"), ["class" => (!empty($errors->has('companyNameCondition')) ? "invalid-control" : ""), "id"=>"companyNameCondition","placeholder"=>"企業名", "maxlength" =>255])}}
              {{--<input type="submit" value="検索">--}}
            </div>
        </div>
        <!-- <div class="fnd-company__search">
            {{Form::search('companyNameCondition', $data->get("companyNameCondition"), ["class" => (!empty($errors->has('companyNameCondition')) ? "invalid-control" : ""), "id"=>"companyNameCondition","placeholder"=>"企業名で検索しよう", "maxlength" =>255])}}
            {{--<input type="submit" value="検索">--}}
        </div> -->
        <div class="find-company__checklists">
            {{--<p>募集対象</p>--}}
            {{Form::checkbox('recruitmentTargetConditionThisYear', 1, '', ["id"=>"recruitmentTargetConditionThisYear"])}}
            <label for="recruitmentTargetConditionThisYear">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::THIS_YEAR]}}</label>
            {{Form::checkbox('recruitmentTargetConditionNextYear', 1, '', ["id"=>"recruitmentTargetConditionNextYear"])}}
            <label for="recruitmentTargetConditionNextYear">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::NEXT_YEAR]}}</label>
            {{Form::checkbox('recruitmentTargetConditionIntern', 1, '', ["id"=>"recruitmentTargetConditionIntern"])}}
            <label for="recruitmentTargetConditionIntern">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::INTERN]}}</label>
        </div>
      </div>
        <div class="find-company__button">
            <button type="submit">検索</button>
        </div>
        {{Form::close()}}
        <!-- <section class="main__content__industry">
            <h2 class="headline">きっと出会える。<br>行きたい会社、新しい自分</h2>
            <h3 class="fontSize--large">INDUSTRY</h3>
            <p>業種から探す</p>
            <ul>
                @foreach($data->get('businessTypeList') as $businessTypeKey => $businessType)
                    @if($businessTypeKey == 1)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="1">メーカー</a></li>
                    @elseif($businessTypeKey == 2)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="2">小売</a></li>
                    @elseif($businessTypeKey == 3)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="3">サービス</a></li>
                    @elseif($businessTypeKey == 4)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="4">IT・通信</a></li>
                    @elseif($businessTypeKey == 5)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="5">広告・出版<br>マスコミ</a></li>
                    @elseif($businessTypeKey == 6)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="6">不動産・建設</a></li>
                    @elseif($businessTypeKey == 7)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="7">商社</a></li>
                    @elseif($businessTypeKey == 8)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="8">銀行・証券<br>保険・金融</a></li>
                    @elseif($businessTypeKey == 9)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="9">官公庁<br>公社・団体</a></li>
                    @elseif($businessTypeKey == 10)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="10">医科</a></li>
                    @elseif($businessTypeKey == 11)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="11">歯科</a></li>
                    @elseif($businessTypeKey == 12)
                        <li><a class="js_business_type_button cursor-pointer" data-job-type-id="12">介護</a></li>
                    @endif
                @endforeach
            </ul>
        </section> -->
        <section class="main__content__arrival">
            <h2 class="headline">PICKUP</h2>
            <p>積極採用中の注目企業</p>
            <div class="main__about__detail">
                <div>
                  <a href="{{route('front.company.detail', ['id' => '103'])}}">
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/pickup/global-p01.png')}}>
                        <img src="{{asset('img/index/pickup/global-p01.png')}}" alt="">
                    </picture>
                  </a>
                    <footer>グローバルパートナーズ株式会社</footer>

                    <p>世界を共に変えよう</p>
                </div>
                <div>
                  <a href="{{route('front.company.detail', ['id' => '114'])}}">
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/pickup/tokyo-kai01.png')}}>
                        <img src="{{asset('img/index/pickup/tokyo-kai01.png')}}" alt="">
                    </picture>
                  </a>
                    <footer>東京海上日動あんしん生命保険株式会社</footer>
                    <p>生命保険業界のチャレンジャー</p>
                </div>
                <div>
                  <a href="{{route('front.company.detail', ['id' => '121'])}}">
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/pickup/amb01.png')}}>
                        <img src="{{asset('img/index/pickup/amb01.png')}}" alt="">
                    </picture>
                  </a>
                    <footer>Ambivalent株式会社</footer>
                    <p>#営業</p>
                </div>
                <div>
                  <a href="{{route('front.company.detail', ['id' => '81'])}}">
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/pickup/trans01.png')}}>
                        <img src="{{asset('img/index/pickup/trans01.png')}}" alt="">
                    </picture>
                  </a>
                    <footer>トランスコスモス株式会社</footer>
                    <p>#トランスコスモス障がい者雇用</p>
                </div>
            </div>

        </section>

            <!-- <div id="slider">
                <div class="main__content__arrival__details">
                    <ol>
                        <li><a href="{{route('front.company.detail', ['id' => '40'])}}"><img src="{{asset('img/index/logo/ibn01.png')}}" alt="株式会社インター・ビジネス・ネットワークス"></a></li>
                        <li><a href="{{route('front.company.detail', ['id' => '7'])}}"><img src="{{asset('img/index/logo/pikul01.png')}}" alt="ピックル株式会社"></a></li>
                    </ol>
                    <picture>
                        <a href="{{route('front.company.detail', ['id' => '18'])}}"><img src="{{asset('img/index/pickup/wafull01.jpg')}}" alt="株式会社ワッフル"></a>
                    </picture>
                </div>
                <div class="main__content__arrival__details">
                    <picture>
                        <a href="{{route('front.company.detail', ['id' => '34'])}}"><img src="{{asset('img/index/pickup/good-crew01.jpg')}}" alt="株式会社グッド・クルー"></a>
                    </picture>
                    <ol>
                        <li><a href="{{route('front.company.detail', ['id' => '3'])}}"><img src="{{asset('img/index/logo/person-link01.png')}}" alt="株式会社パーソンリンク"></a></li>
                        <li><a href="{{route('front.company.detail', ['id' => '5'])}}"><img src="{{asset('img/index/logo/ori-plan01.png')}}" alt="株式会社オリジナルプラン"></a></li>
                    </ol>
                </div>
            </div> -->
        </section>
        <section class="main__content__about">
            <h2 class="headline">ABOUT</h2>
            <p>Linktとは</p>
            <p class="about_sub">採用担当者と直接つながる新システム</p>
            <p class="about_sub_2">履歴書を一社ごとに撮影したり、面接会場になんども足を運ぶ必要は一切なし。<br>
                        プロフィールを1枚作成すれば、きになる企業の採用担当者に直接メッセージを送り、そのままWebが面接できる新システム！</p>
            <div class="main__about__detail_a">
                <div>
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/about/about01.png')}}>
                        <img src="{{asset('img/index/about/about01.png')}}" alt="">
                    </picture>
                    <footer>履歴書は不要。プロフィールを作成するだけ</footer>

                </div>
                <div>
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/about/about02.png')}}>
                        <img src="{{asset('img/index/about/about02.png')}}" alt="">
                    </picture>
                    <footer>採用担当と直接チャット！</footer>
                </div>
                <div>
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/about/about03.png')}}>
                        <img src="{{asset('img/index/about/about03.png')}}" alt="">
                    </picture>
                    <footer>Web面接で効率よく就活！</footer>
                </div>
                <div>
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/about/about04.png')}}>
                        <img src="{{asset('img/index/about/about04.png')}}" alt="">
                    </picture>

                    <footer>何度も面接することなく内定Get！</footer>
                </div>
            </div>
            <a href="{{route('front.static.about')}}" class="btn">Linktとは</a>
        </section>

            <!-- <div id="slider">
                <div class="main__content__arrival__details">
                    <ol>
                        <li><a href="{{route('front.company.detail', ['id' => '40'])}}"><img src="{{asset('img/index/logo/ibn01.png')}}" alt="株式会社インター・ビジネス・ネットワークス"></a></li>
                        <li><a href="{{route('front.company.detail', ['id' => '7'])}}"><img src="{{asset('img/index/logo/pikul01.png')}}" alt="ピックル株式会社"></a></li>
                    </ol>
                    <picture>
                        <a href="{{route('front.company.detail', ['id' => '18'])}}"><img src="{{asset('img/index/pickup/wafull01.jpg')}}" alt="株式会社ワッフル"></a>
                    </picture>
                </div>
                <div class="main__content__arrival__details">
                    <picture>
                        <a href="{{route('front.company.detail', ['id' => '34'])}}"><img src="{{asset('img/index/pickup/good-crew01.jpg')}}" alt="株式会社グッド・クルー"></a>
                    </picture>
                    <ol>
                        <li><a href="{{route('front.company.detail', ['id' => '3'])}}"><img src="{{asset('img/index/logo/person-link01.png')}}" alt="株式会社パーソンリンク"></a></li>
                        <li><a href="{{route('front.company.detail', ['id' => '5'])}}"><img src="{{asset('img/index/logo/ori-plan01.png')}}" alt="株式会社オリジナルプラン"></a></li>
                    </ol>
                </div>
            </div> -->

        <section class="main__content__coming">

            <h2 class="headline">USER VOICE</h2>
            <p>利用者の声</p>
            <div class="main__about__detail_v">
                <div>
                  <!-- <a href="{{route('front.static.customer1')}}"> -->
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/voice/voice01.jpg')}}>
                        <img src="{{asset('img/index/voice/voice01.jpg')}}" alt="">
                    </picture>
                  <!-- </a> -->
                    <footer>効率よく就活できる！</footer>
                    <p>Y.Kさん</p>
                </div>
                <div>
                  <!-- <a href="{{route('front.static.customer2')}}"> -->
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/voice/voice02.jpg')}}>
                        <img src="{{asset('img/index/voice/voice02.jpg')}}" alt="">
                    </picture>
                  <!-- </a> -->
                    <footer>１年生から利用できるから早くスタートが切れる！</footer>
                    <p>M.Kさん</p>
                </div>
                <div>
                  <!-- <a href="{{route('front.static.customer3')}}"> -->
                    <picture>
                        <source media="(max-width: 767px)" srcset={{asset('img/index/voice/voice03.jpg')}}>
                        <img src="{{asset('img/index/voice/voice03.jpg')}}" alt="">
                    </picture>
                  <!-- </a> -->
                    <footer>1社ずつ履歴書を作成する必要がない！</footer>
                    <p>J.Aさん</p>
                </div>
            </div>
            <a href="{{route('front.static.customer')}}" class="btn">利用者の声一覧</a>
        </section>

        <section class="main__content__coming">

            <h2 class="headline">FAQ</h2>
            <p>よくある質問</p>
            <section class="main__content__qa">
                <dl>
                    <dt class="main__qa main__qa--more-qa">利用料金は無料ですか？</dt>
                    <dd class="main__ans main__qa--more-ans"><div class="ans__box"><div><p>完全無料です。</p></dd>
                    <br>
                    <dt class="main__qa main__qa--more-qa">インターン選考も受け付けていますか？</dt>
                    <dd class="main__ans main__qa--more-ans"><div class="ans__box"><div><p>受け付けております。<br>インターンタグがついている企業はインターン選考を実施していますので、<br>積極的にコンタクトをとってください。
                    </p></dd>
                    <br>
                    <dt class="main__qa main__qa--more-qa">利用・登録できる学生の対象はありますか？</dt>
                    <dd class="main__ans main__qa--more-ans"><div class="ans__box"><div><div><p>大学、大学院、短大、高専、専門学校の学生の方、大学卒業後2年以内の方が対象となっております。</p></div></dd>
                </dl>
              </section>
            <a href="{{route('front.static.about')}}#qa" class="btn">よくある質問一覧</a>
            <a href="{{route('front.static.select_entry')}}" class="btn-red">今すぐ無料で会員登録</a>
        </section>


		<!-- <section class="main__content__news">
            <div class="main__content__news__details">
                <h2 class="headline">NEWS</h2>
                <p>ニュース</p>
                <dl class="fontSize--small">
                    <dt>2020/03/03（火）<span class="label label-blue mobile_view">ニュースリリース</span></dt>
                    <dt class="web_view"><span class="label label-blue">ニュースリリース</span></dt>
                    <dd><a href="{{route('front.news.detail_4')}}" rel="noopener">LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施</a></dd>

                    <dt>2020/03/03（火）<span class="label label-blue mobile_view">ニュースリリース</span></dt>
                    <dt class="web_view"><span class="label label-blue">ニュースリリース</span></dt>
                    <dd><a href="{{route('front.news.detail_5')}}">LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨</a></dd>
                </dl>
            </div>
            <nav class="navBk fontSize--small"><a href="{{route('front.news.list')}}">ニュース一覧</a></nav>
        </section> -->

    <!-- <section class="main__about">
        <div class="main__about__outline">
            <header>
                <h2><img src="{{asset('img/index/title_profile.png')}}" alt="LinkTとは"></h2>
                <h3>就活を成功に導くサイト</h3>
            </header>
            <picture>
                <img src="{{asset('img/index/photo_profile01.jpg')}}" alt="就活を成功に導くサイト">
            </picture>
            <div>
                <p>これまでの就活は、限られたお金・時間・情報の中で
                    行きたい会社がわからない、自分を企業に見てもらう前にESで落選してしまうなど、うまくいかないことがほとんど。</p>
                <p>LinkTには、そんな就活生の悩みを解決するための様々な機能が盛りだくさん。<br>魅力ある会社と出会い、内定を獲得するための就活サイトです。</p>
            </div>
        </div>
        <div class="main__about__detail">
            <div>
                <header>あなたの動画を見た人事担当者から<br>メッセージが届きます</header>
                <picture>
                    <source media="(max-width: 767px)" srcset={{asset('img/index/img_profile01.jpg')}}>
                    <img src="{{asset('img/index/img_profile01-circle.png')}}" alt="スマホで自己PR">
                </picture>
                <footer>スマホで自己PR動画を撮って<br class="pc">何度でもアップロード</footer>
            </div>
            <div>
                <header>動画や会社情報を見て興味を持った<br>企業に即メッセージが可能です</header>
                <picture>
                    <source media="(max-width: 767px)" srcset={{asset('img/index/img_profile02.jpg')}}>
                    <img src="{{asset('img/index/img_profile02-circle.png')}}" alt="企業動画を見る">
                </picture>
                <footer>企業動画を見て<br class="pc">会社の雰囲気を知れる</footer>
            </div>
            <div>
                <header>就活に必要な時間やお金の問題を解決し、<br>あなたの就活を充実したものに</header>
                <picture>
                    <source media="(max-width: 767px)" srcset={{asset('img/index/img_profile03.jpg')}}>
                    <img src="{{asset('img/index/img_profile03-circle.png')}}" alt="オンライン面接">
                </picture>
                <footer>オンライン面接が可能</footer>
            </div>
        </div>
        <div class="navBk btn__box fontSize--small">
            <a href="{{route('front.static.about')}}#qa">よくある質問</a>
            <a href="{{route('front.static.about')}}">LinkTとは</a>
        </div>

    </section> -->
    <!-- <section class="main__movie">
        <h2 class="headline">LinkT サービス説明動画</h2>
        <div class="video-wrap main__movie__box">
            <video id="video" controlsList="nodownload" controls="" muted="" loop="" preload="none" poster="{{asset('img/index/img_movie_poster.jpg')}}">
                <source src="{{asset('video/introduction-for-students.mp4')}}">
                <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
            </video>
            <div class="video-btn" id="video-btn"></div>
        </div>
        <nav class="navBk fontSize--small"><a href="{{route('front.static.describe')}}">LinkTの使い方</a></nav>
    </section> -->
    <!-- <section class="main__movie">
        <h2 class="headline mtb3em">対応OS<br>ブラウザについて</h2>
        <div id="browser_recommandation_container">
            <p>ご利用上のご注意 <br> LinkTを安全にご利用いただくためには、下記デバイス・ブラウザのご利用を推奨いたします。</p>
            <div id="browser_support">
                <div id="pc_browser">
                    <p>PC</p>
                    <ul>
                        Windows
                        <li>Google Chrome 最新版</li>
                        <li>Firefox 最新版</li>
                    </ul>
                    <ul>
                        Mac
                        <li>Google Chrome 最新版</li>
                        <li>Firefox 最新版</li>
                        <li>Safari 最新版</li>
                    </ul>
                </div>
                <div id="mobile_browser">
                    <p>スマートフォン</p>
                    <ul>
                        iOS
                        <li>Safari 最新版（標準ブラウザ）</li>
                    </ul>
                    <ul>
                        Android
                        <li>Google Chrome 最新版（標準ブラウザ）</li>
                    </ul>
                </div>
                <p>※上記以外のデバイス・ブラウザでご利用された場合には、表示や一部機能に不具合が生じる恐れがございますので予めご了承ください。</p>
            </div>
        </div>
    </section> -->

    <section class="main__movie">
      <section class="main__content__news">
              <div class="main__content__news__details">
                  <h2 class="headline">NEWS</h2>
                  <p>ニュース</p>
                  <nav class="navnews fontSize--small"><a href="{{route('front.news.list')}}">ニュース一覧</a></nav>
                  <dl class="fontSize--small">
                      <dt>2020/03/03<span class="label label-blue mobile_view">ニュースリリース</span></dt>
                      <dt class="web_view"><span class="label label-blue">ニュースリリース</span></dt>
                      <dd><a href="{{route('front.news.detail_4')}}" rel="noopener">LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施</a></dd>

                      <dt>2020/03/03<span class="label label-blue mobile_view">ニュースリリース</span></dt>
                      <dt class="web_view"><span class="label label-blue">ニュースリリース</span></dt>
                      <dd><a href="{{route('front.news.detail_4')}}" rel="noopener">LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施</a></dd>

                      <dt>2020/03/03<span class="label label-blue mobile_view">ニュースリリース</span></dt>
                      <dt class="web_view"><span class="label label-blue">ニュースリリース</span></dt>
                      <dd><a href="{{route('front.news.detail_4')}}" rel="noopener">LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施</a></dd>

                      <dt>2020/03/03<span class="label label-blue mobile_view">ニュースリリース</span></dt>
                      <dt class="web_view"><span class="label label-blue">ニュースリリース</span></dt>
                      <dd><a href="{{route('front.news.detail_5')}}">LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨</a></dd>
                  </dl>
              </div>
          </section>
        <div id="browser_recommandation_container">
            <div id="browser_support">
              <div id="coution">
                  <p>対応OSブラウザについて</p>
                  <ul>
                      利用上の注意
                      <li>Linktを安全にご利用いただくためには、記載のデバイス・ブラウザのご利用を推奨いたします。</li>
                      <li>※表記以外のデバイス・ブラウザでご利用された場合には、表示や一部機能に不具合が生じる恐れがございますので予めご了承ください。</li>
                  </ul>
              </div>
                <div id="pc_browser">
                    <p>PC</p>
                    <ul>
                        Windows
                        <li>Google Chrome 最新版/Firefox 最新版</li>
                        Mac
                        <li>Google Chrome 最新版/Firefox 最新版/Safari 最新版</li>
                    </ul>
                </div>
                <div id="mobile_browser">
                    <p>スマートフォン</p>
                    <ul>
                        iOS
                        <li>Safari 最新版（標準ブラウザ）</li>
                        Android
                        <li>Google Chrome 最新版（標準ブラウザ）</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="footer_end">
      <div class="siteinfo_box">
        <ul class="siteinfo_othernav">
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.top')}}">トップページ</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.static.about')}}">LinkTについて</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.company.list')}}">企業検索</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.static.describe')}}">LinkTの使い方</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.static.customer')}}">利用者の声</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touhchover" href="{{route('front.news.list')}}">ニュース</a></li>
        </ul>
      </div>
      <div class="siteinfo_box">
        <ul class="siteinfo_othernav">
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="/business/">企業様はこちら</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.partner')}}">パートナー企業様ご紹介</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.static.about')}}">ご利用ガイド</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="https://in-fit.co.jp/">運営会社について</a></li>
          <li class="siteinfo_othernavitem"><a class="siteinfo_othernavlink anime-texteffect js-touchhover" href="{{route('front.contact')}}">お問い合わせ</a></li>
        </ul>
      </div>
    </section>
    <nav class="footerNav requid navSp fontSize--small">
        {{--<nav class="navBk"><a href="{{route('front.static.describe')}}">LinkTの使い方</a></nav>--}}
        @if(!isset($memberAuthentication))
            <ul>
                <li><a href="{{route('front.member.login')}}">ログイン</a></li>
                <li><a href="{{route('front.static.select_entry')}}">会員登録</a></li>
            </ul>
        @endif
    </nav>
@stop
