@extends('front.common.root')

@section('description')
次世代型新卒・第二新卒採用サービス【LinkT（リンクト）】に掲載されている{{$data->get("name")}}の新卒採用・企業情報です。{{$data->get("name")}}に興味が湧いたら、メッセージやオンライン面接でさらなるコミュニケーションが取れます。
@stop

@section('title')
{{$data->get("name")}}の新卒採用、求人・企業情報｜次世代の就活ならLinkT(リンクト)
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/company-search/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/company-search/detail/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/company-search/detail/index_custom.css')}}">
    <link rel="stylesheet" href="{{asset('js/slick/slick_custom.css')}}">
    <link rel="stylesheet" href="{{asset('js/slick/slick-theme.css')}}">
    <style>
        .main__img picture img{
            width: 100%;
            height: auto;
        }
    </style>
@stop

@section('vue')
    {{--    <script src="{{ asset('js/company-search-detail/detail_vue.js') }}"></script>--}}
@stop

@section('js')
    <script src="/assets/js/common.js"></script>
    <script src="{{ asset('js/company-search-detail/detail.js') }}"></script>

    <script>
        jQuery(document).ready(function ($) {
            /* 求人情報タブ切替
            --------------------------------------------- */
            // 初期化
            var tab = '.switchTab';
            var $list = $(tab).children('ul').children('li');

            // 初期処理：contents hide
            for (i = 0; i < $list.length; i++) {
                if (!$($list[i]).hasClass('active')) {
                    var target = $($list[i]).children('a').attr('href');
                    $(target).hide();
                }
            }

            // タブ切替処理
            $(tab + ' a').on('click', {$list: $list}, function (e) {
                var index = $(this).parent('li').index();
                var $list = e.data.$list;

                $($list).each(function () {
                    if ($(this).hasClass('active')) {
                        e.data.index = $(this).index();
                    }
                });
                // active削除・コンテンツhide
                var $active = ($list).eq(e.data.index);
                $active.removeClass('active');
                $($active.children('a').attr('href')).hide();

                // active付与・コンテンツshow
                $(this).parent('li').addClass('active');
                $($(this).parent('li').children('a').attr('href')).show();

                return false;
            })
        });
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">企業検索</a></li>
            <li>企業詳細</li>
        </ul>
    </nav>
@stop

@section('content')
    <div class="main__content">
        <header>
            <div class="company__logo">
                <picture>
                    <img src="{{$data->get("companyLogoFilePath")}}" alt="">
                </picture>
            </div>
            <div class="company__info">
                <h2 class="main__content__headline">{{$data->get("name")}}</h2>
                <div>
                    <ul class="company__feature">
                        @foreach($data->get("recruitTagList") as $recruitTag)
                            <li>{{$recruitTag}}</li>
                        @endforeach
                    </ul>
                    <div class="tag {{$data->get("hashTagColor")}}">{{$data->get("hashTagName")}}</div>
                </div>
            </div>
        </header>

        <div class="main__img">
            @if($data->get('companyPrVideoFilePath') === null)
                <div class="js_company_images">
                    @foreach($data->get('companyImageFilePathList') as $key => $companyImage)
                        <picture>
                            <img src="{{$companyImage}}" alt="企業画像{{$key}}">
                        </picture>
                    @endforeach
                </div>
            @else
                <div class="video">
                    <video controlsList="nodownload" controls="" muted="" autoplay="" loop="" poster="" id="js_video_auto" playsinline="">
                        <source src="{{$data->get("companyPrVideoFilePath")}}">
                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                    </video>
                </div>
            @endIf

            <div class="js_short_length_videos video">
                @foreach($data->get("shortLengthVideos") as $key => $shortLengthVideo)
                    <video controlsList="nodownload" controls="controls" muted="" poster="" id="js_video_{{$key}}" style="display: none;" playsinline="">
                        <source src="{{$shortLengthVideo}}">
                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                    </video>
                @endforeach
            </div>

            @if($data->get("shortLengthVideos.five") === null && $data->get("shortLengthVideos.ten") === null && $data->get("shortLengthVideos.fifteen") === null)
            @else
                <div class="main__img__thumbs flex--bet">
                    @if(($data->get("shortLengthVideos.five")) !== null)
                        <div class="thumb__5sec">
                            <span class="js_thumbnail_img cursor-pointer" id="js_video_five">
                            @if(($data->get("shortLength5sVideoThumbnail")) === null)
                                    <span class="thumb__noimg"></span>
                                @else
                                    <picture>
                                    <img src="{{$data->get("shortLength5sVideoThumbnail")}}" alt="{{$data->get("shortLength5sVideoTitle")}}">
                                </picture>
                                @endif
                            </span>
                            <p class="thumb__title">
                                {{$data->get("shortLength5sVideoTitle")}}
                            </p>
                        </div>
                    @endif
                    @if(($data->get("shortLengthVideos.ten")) !== null)
                        <div class="thumb__10sec">
                            <span class="js_thumbnail_img cursor-pointer" id="js_video_ten">
                            @if(($data->get("shortLength10sVideoThumbnail")) === null)
                                    <span class="thumb__noimg"></span>
                                @else
                                    <picture>
                                    <img src="{{$data->get("shortLength10sVideoThumbnail")}}" alt="{{$data->get("shortLength10sVideoTitle")}}">
                                </picture>
                                @endif
                                </span>
                            <p class="thumb__title">
                                {{$data->get("shortLength10sVideoTitle")}}
                            </p>
                        </div>
                    @endif
                    @if(($data->get("shortLengthVideos.fifteen")) !== null)
                        <div class="thumb__15sec">
                            <span class="js_thumbnail_img cursor-pointer" id="js_video_fifteen">
                            @if(($data->get("shortLength15sVideoThumbnail")) === null)
                                    <span class="thumb__noimg"></span>
                                @else
                                    <picture>
                                    <img src="{{$data->get("shortLength15sVideoThumbnail")}}" alt="{{$data->get("shortLength15sVideoTitle")}}">
                                </picture>
                                @endif
                            </span>
                            <p class="thumb__title">
                                {{$data->get("shortLength15sVideoTitle")}}
                            </p>
                        </div>
                    @endif
                    <div class="tooltip">
                        <a href="" class="tooltip__open">？</a>
                        <div class="tooltip__inner">
                            <span class="tooltip__close">×</span>
                            <p class="tooltip__text">5秒・10秒・15秒の紹介動画を閲覧</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if(($data->get('introductorySentence')) != null)
            <div class="main__content__about">
                <h2 class="main__content__headline">企業紹介</h2>
                <div class="about__content">
                    <input type="checkbox" id="about__toggle" class="about__toggle__input">
                    <label class="about__toggle__btn" for="about__toggle"></label>
                    <p>
                        {{$data->get("introductorySentence")}}
                    </p>
                </div>
            </div>
        @endif
        @if(($data->get('jobApplications')) != null)
            <section class="switchTab">
                <h2 class="main__content__headline">求人詳細</h2>
                <ul>
                    @foreach($data->get('jobApplications') as $key => $jobApplication)
                        <li class="{{$key === 0 ? 'active':''}}">
                            <a href="#{{$jobApplication->get('id')}}">{{$jobApplication->get("recruitmentJobType")->get('name')}}</a>
                        </li>
                    @endforeach
                </ul>
            </section>
            @foreach($data->get('jobApplications') as $key => $jobApplication)
                <section id="{{$jobApplication->get('id')}}">
                    <h2 class="main__content__headline">{{$jobApplication->get("RecruitmentJobType")->get('name')}}</h2>
                    <p>{!!nl2br($jobApplication->get("recruitmentJobTypeDescription"))!!}</p>
                    <dl class="basic">
                        <dt>募集職種</dt>
                        <dd>{{$jobApplication->get("RecruitmentJobType")->get('name')}}</dd>
                        <dt>仕事内容</dt>
                        <dd>{!!nl2br($jobApplication->get("jobDescription"))!!}</dd>
                        <dt>雇用形態</dt>
                        <dd>{{$data->get('employmentTypeList')[$jobApplication->get("employmentType")]}}</dd>
                        <dt>求める人物像</dt>
                        <dd>{!!nl2br($jobApplication->get("statue"))!!}</dd>
                        <dt>選考方法</dt>
                        <dd>{!!nl2br($jobApplication->get("screeningMethod"))!!}</dd>
                        <dt>給与</dt>
                        <dd>{!!nl2br($jobApplication->get("compensation"))!!}</dd>
                        <dt>賞与<br>昇給<br>手当</dt>
                        <dd>{!!nl2br($jobApplication->get("bonus"))!!}</dd>
                        <dt>勤務地</dt>
                        <dd>
                            @if(!empty($jobApplication->get("recruitmentWorkLocations")))
                                @foreach($jobApplication->get("recruitmentWorkLocations") as $key => $prefecture)
                                    {{($key>0? ' / ':'').$prefecture->get('name')}}
                                @endforeach
                            @endif
                        </dd>
                        <dt>勤務時間</dt>
                        <dd>{!!nl2br($jobApplication->get("dutyHours"))!!}</dd>
                        <dt>待遇<br>福利厚生</dt>
                        <dd>{!!nl2br($jobApplication->get("compensationPackage"))!!}</dd>
                        <dt>休日・休暇</dt>
                        <dd>{!!nl2br($jobApplication->get("nonWorkDay"))!!}</dd>
                        <dt>採用予定人数</dt>
                        <dd>{{$jobApplication->get("recruitmentNumber")}}</dd>
                    </dl>
                </section>
            @endforeach
            <div class="main__content__apply">
                <form action="{{$data->get('messageDetailUrl')}}" class="flex--ctr">
                    <button type="submit">メッセンジャーで面接依頼<br>または質問をする</button>
                    <div class="tooltip">
                        <a href="" class="tooltip__open">？</a>
                        <div class="tooltip__inner">
                            <span class="tooltip__close">×</span>
                            <p class="tooltip__text">企業の人事担当者に面接の依頼、メッセージ、質問等を行うことができます</p>
                        </div>
                    </div>
                </form>
            </div>
        @endif
        @if ($data->get("companyIntroductionListsList") !== null )
            <div class="main__content__feature">
                <h2 class="main__content__headline">当社の紹介</h2>
                @foreach($data->get("companyIntroductionListsList") as $key => $companyIntroduction)
                    <section>
                        <div class="content">
                            @if(preg_match('/\.(png|jpeg|jpg)$/i', $companyIntroduction->get("filePath")))
                                <picture>
                                    <img src="{{$companyIntroduction->get("filePath")}}" alt="">
                                </picture>
                            @else
                                <div class="video">
                                    <video controlsList="nodownload" controls="" muted="" autoplay="" loop="" poster="" playsinline="">
                                        <source src="{{$companyIntroduction->get("filePath")}}">
                                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                </div>
                            @endif
                        </div>
                        <h3>{{$companyIntroduction->get("title")}}</h3>
                        <p>
                            {!!nl2br($companyIntroduction->get("description"))!!}
                        </p>
                    </section>
                @endforeach
            </div>
            <div class="main__content__apply">
                <form action="{{$data->get('messageDetailUrl')}}" class="flex--ctr">
                    <button type="submit">メッセンジャーで面接依頼<br>または質問をする</button>
                    <div class="tooltip">
                        <a href="" class="tooltip__open">？</a>
                        <div class="tooltip__inner">
                            <span class="tooltip__close">×</span>
                            <p class="tooltip__text">企業の人事担当者に面接の依頼、メッセージ、質問等を行うことができます</p>
                        </div>
                    </div>
                </form>
            </div>
        @endif
        <div class="main__content__info">
            <h2 class="main__content__headline">企業情報</h2>
            <dl class="basic">
                <dt>事業内容</dt>
                <dd>{!!nl2br($data->get("descriptionOfBusiness"))!!}</dd>
                <dt>設立</dt>
                <dd>{{$data->get("establishmentDate")}}</dd>
                <dt>資本金</dt>
                <dd>{{$data->get("capital")}}</dd>
                <dt>代表者</dt>
                <dd>{{$data->get("representativePerson")}}</dd>
                <dt>役員構成</dt>
                <dd>{!!nl2br($data->get("exectiveOfficers"))!!}</dd>
                <dt>事業所</dt>
                <dd>{!!nl2br($data->get("establishment"))!!}</dd>
                <dt>関連会社</dt>
                <dd>{!!nl2br($data->get("affiliatedCompany"))!!}</dd>
                <dt>登録／資格</dt>
                <dd>{!!nl2br($data->get("qualification"))!!}</dd>
                <dt>ホームページ</dt>
                @if(filter_var($data->get("homePageUrl"), FILTER_VALIDATE_URL) && preg_match('|^https?://.*$|', $data->get("homePageUrl")))
                    <dd><a href={{$data->get("homePageUrl")}} target="_blank">{{$data->get("homePageUrl")}}</a></dd>
                @else
                    <dd>{{$data->get("homePageUrl")}}</dd>
                @endif
                <dt>採用ホームページ</dt>
                @if(filter_var($data->get("recruitmentUrl"), FILTER_VALIDATE_URL) && preg_match('|^https?://.*$|', $data->get("recruitmentUrl")))
                    <dd><a href={{$data->get("recruitmentUrl")}} target="_blank">{{$data->get("recruitmentUrl")}}</a></dd>
                @else
                    <dd>{{$data->get("recruitmentUrl")}}</dd>
                @endif
                <dt>主要取引先</dt>
                <dd>{!!nl2br($data->get("mainClient"))!!}</dd>
            </dl>
        </div>
        <div class="main__content__apply">
            <form action="{{$data->get('messageDetailUrl')}}" class="flex--ctr">
                <button type="submit">メッセンジャーで面接依頼<br>または質問をする</button>
                <div class="tooltip">
                    <a href="" class="tooltip__open">？</a>
                    <div class="tooltip__inner">
                        <span class="tooltip__close">×</span>
                        <p class="tooltip__text">企業の人事担当者に面接の依頼、メッセージ、質問等を行うことができます</p>
                    </div>
                </div>
            </form>
        </div>
        <footer class="anchor">
            <a data-href="{{route("front.company.list.reload")}}" class="anchor--back cursor-pointer js-btn-link js-key-save">戻る</a>
        </footer>
    </div>
@stop
