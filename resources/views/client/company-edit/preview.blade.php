@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','企業検索詳細プレビュー　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/company-edit/detail-preview/common.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/company-edit/detail-preview/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/company-edit/detail-preview/index_custom.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/company-edit/detail-preview/index_new.css')}}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="{{asset('js/slick/slick_custom.css')}}">
    <link rel="stylesheet" href="{{asset('js/slick/slick-theme.css')}}">
    <style>
        .main__img picture img{
            width: 100%;
            height: auto;
        }
        .mb-15{
            margin-bottom: 15px;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('js/company/preview.js') }}"></script>
    <script src="{{ asset('js/BigPicture.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.js"></script>
    <script>
        var body_width = $('body').width();
        var container_width = $('#container').width();
        if(container_width > 1024){
            container_width = 1000;
        }
        var company_extension_width = $('#company_extension').width();
        var company_extension_right_position = (((body_width - container_width)/2)-company_extension_width)+'px';
        $('#company_extension').css('right',company_extension_right_position);

        var maximum_top_position = (document.body.scrollHeight-document.documentElement.clientHeight);

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

        //when scrolling
        $(document).scroll(function() {
            var current_position = $(this).scrollTop();

            if (window.matchMedia("(min-width: 1281px)").matches)
            {
                //position_fixing(current_position);
                return_button_position_fixing(current_position);
            }else{
                mobile_position_fixing(current_position);
            }
        });

        var footer_height = $('#ftr').innerHeight();
        var se = $('#company_extension');
        var margin_bottom = se.css('margin-bottom');
        function mobile_position_fixing(current_position) {
            if(current_position >= (maximum_top_position - 1000)){
                if(footer_height <= 40){
                    footer_height = 50;
                }
                $('#company_extension').css({
                    position: "absolute",
                    bottom: (footer_height-10)
                });
            }else{
                $('#company_extension').css({
                    position: "fixed",
                    bottom: margin_bottom
                });
            }
        }

        function return_button_position_fixing(current_position) {
            if(current_position >= (maximum_top_position - footer_height)){
                $('#return_button').css({
                    bottom: (40+(footer_height-(maximum_top_position-current_position)))
                });
            }else{
                $('#return_button').css({
                    bottom: 40
                });
            }
        }

        $('.cursor-pointer').click(function(e){
            var event = e.target;
            big_Picture(event);
        });
        //new code
        $('.cursor-pointer>img,.cursor-pointer>span').click(function(){
            $(this).parent().click(function(e){
                var current_event = e.currentTarget;
                big_Picture(current_event);
            });
        });

        function big_Picture(et){
            if(et.tagName.toLowerCase() === 'a')
            {
                BigPicture({
                    el: et,
                    vidSrc: et.getAttribute('vidSrc'),
                })
            }
            $('#bp_vid').attr('controlsList','nodownload');
        }
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.company-edit.basic-information')}}">企業編集</a></li>
            <li>プレビュー</li>
        </ul>
    </nav>
@stop

@section('content')
    <section class="contents">
        <div id="company_details">
            <div class="short_intro">
                <h3>{{$data->get("name")}}</h3>
                <p>
                    @foreach($data->get("recruitTagList") as $recruitTag)
                        <span>{{$recruitTag}}</span>
                    @endforeach
                </p>
                <p class="hash_tags">
                    <span class="tag {{$data->get("hashTagColor")}}">{{$data->get("hashTagName")}}</span>
                </p>
            </div>

            <div class="full_width mt_5">
                <div class="half_width">
                    @if($data->get('companyPrVideoFilePath') === null)
                        <div class="mb-15">
                            <div class="js_company_images">
                                @foreach($data->get('companyImageFilePathList') as $key => $companyImage)
                                    <picture class="slick-slide">
                                        <img src="{{$companyImage}}" alt="企業画像{{$key}}">
                                    </picture>
                                @endforeach
                            </div>
                            <div class="js_short_length_videos video">
                                @foreach($data->get("shortLengthVideos") as $key => $shortLengthVideo)
                                    <video controlsList="nodownload" controls="controls" muted="" poster="" id="js_video_{{$key}}" style="display: none;" playsinline="">
                                        <source src="{{$shortLengthVideo}}">
                                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="member_video_or_image">
                            <div class="video">
                                <video controlsList="nodownload" controls="" muted="" autoplay="" loop="" poster="" id="js_video_auto" playsinline="">
                                    <source src="{{$data->get("companyPrVideoFilePath")}}">
                                    <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                </video>
                            </div>
                            <div class="js_short_length_videos video">
                                @foreach($data->get("shortLengthVideos") as $key => $shortLengthVideo)
                                    <video controlsList="nodownload" controls="controls" muted="" poster="" id="js_video_{{$key}}" style="display: none;" playsinline="">
                                        <source src="{{$shortLengthVideo}}">
                                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                @endforeach
                            </div>
                        </div>
                    @endIf

                    @if($data->get("shortLengthVideos.five") === null && $data->get("shortLengthVideos.ten") === null && $data->get("shortLengthVideos.fifteen") === null)
                    @else
                        <div class="video_tags">
                            @if(($data->get("shortLengthVideos.five")) !== null)
                                <p class="htmlvid"><a vidSrc="{{$data->get("shortLengthVideos.five")}}" class="tag cursor-pointer"><img src="{{asset('/img/common/play-circle-regular.png')}}" alt=""><img src="{{asset('/img/common/5sec.png')}}" alt=""><span>{{$data->get("shortLength5sVideoTitle")}}</span></a></p>
                            @endif

                            @if(($data->get("shortLengthVideos.ten")) !== null)
                                <p class="htmlvid"><a vidSrc="{{$data->get("shortLengthVideos.ten")}}" class="tag cursor-pointer"><img src="{{asset('/img/common/play-circle-regular.png')}}" alt=""><img src="{{asset('/img/common/10sec.png')}}" alt=""><span>{{$data->get("shortLength10sVideoTitle")}}</span></a></p>
                            @endif

                            @if(($data->get("shortLengthVideos.fifteen")) !== null)
                                <p class="htmlvid"><a vidSrc="{{$data->get("shortLengthVideos.fifteen")}}" class="tag cursor-pointer"><img src="{{asset('/img/common/play-circle-regular.png')}}" alt=""><img src="{{asset('/img/common/15sec.png')}}" alt=""><span>{{$data->get("shortLength15sVideoTitle")}}</span></a></p>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="half_width">
                    <div class="member_intro transparent_bg pz_top pz_right pz_bottom mz_left pz_all">
                        <h2><i class="fa fa-pencil" aria-hidden="true"></i> 事業紹介</h2>
                        <p id="fs_15">
                            @if(($data->get('introductorySentence')) != null)
                                {{$data->get("introductorySentence")}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            @if(($data->get('jobApplications')) != null)
                <div class="member_details">
                    <h2><i class="fa fa-pencil" aria-hidden="true"></i> 求人詳細</h2>
                    {{--@if(count($data->get('jobApplications')) > 1)
                        <p id="fs_12 mb_10">タブをスワイプで全求人を確認できます</p>
                    @endif--}}
                    <div class="full_width">
                        <div class="all_width">
                            <div class="switchTab job_application-tab">
                                <ul>
                                    @foreach($data->get('jobApplications') as $key => $jobApplication)
                                        <li class="{{$key === 0 ? 'active':''}}">
                                            <a href="#{{$jobApplication->get('id')}}">
                                                {{mb_strlen($jobApplication->get("recruitmentJobType")->get('name')) > 5 ? mb_substr($jobApplication->get("recruitmentJobType")->get('name'), 0, 5).'...' : $jobApplication->get("recruitmentJobType")->get('name')}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @foreach($data->get('jobApplications') as $key => $jobApplication)
                                <div id="{{$jobApplication->get('id')}}" class="job_application_with_switch_tab">
                                    <h2>{{$jobApplication->get("RecruitmentJobType")->get('name')}}</h2>
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if ($data->get("companyIntroductionListsList") !== null )
                <div class="member_details">
                    <h2><i class="fa fa-pencil" aria-hidden="true"></i> 当社の紹介</h2>
                    @foreach($data->get("companyIntroductionListsList") as $key => $companyIntroduction)
                        <div class="full_width">
                            <div class="half_width mb_10">
                                @if(preg_match('/\.(png|jpeg|jpg)$/i', $companyIntroduction->get("filePath")))
                                    <picture>
                                        <img src="{{$companyIntroduction->get("filePath")}}" alt="">
                                    </picture>
                                @else
                                    <div class="member_video_or_image">
                                        <div class="video">
                                            <video controls="" muted="" autoplay="" loop="" poster="" playsinline="">
                                                <source src="{{$companyIntroduction->get("filePath")}}">
                                                <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                            </video>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="half_width">
                                <div class="member_intro">
                                    <h2 id="fs_15">{{$companyIntroduction->get("title")}}</h2>
                                    <p id="fs_12">
                                        {!!nl2br($companyIntroduction->get("description"))!!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="member_details">
                <h2><i class="fa fa-pencil" aria-hidden="true"></i> 企業情報</h2>
                <div class="full_width">
                    <div class="all_width">
                        <div class="job_application">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="reload web_view" id="return_button">
            {{--<a data-href="{{route("front.company.list.reload")}}" class="anchor--back cursor-pointer js-btn-link js-key-save">戻る</a>--}}
            <form action="#" class="ftr-form">
                <input type="button" class="anchor--back cursor-pointer js-btn-link js-key-save" value="戻る" data-href="{{--{{route("front.company.list.reload")}}--}}">
            </form>
        </div>
        <div id="company_extension">
            <div class="fixed_return mobile_tab_view">
                <form action="#" class="mobile_tab_view">
                    <input type="button" class="anchor--back cursor-pointer js-btn-link js-key-save" value="戻る" data-href="{{--{{route("front.company.list.reload")}}--}}">
                </form>
            </div>
            <div class="fixed_tab">
                <form action="{{$data->get('messageDetailUrl')}}">
                    <button type="submit">
                        <p>面接依頼 or</p>
                        <p>質問をする</p>
                        <img src="{{asset('img/common/comment-dots-regular.svg')}}" alt="">
                    </button>
                </form>
            </div>
        </div>
    </section>
@stop
