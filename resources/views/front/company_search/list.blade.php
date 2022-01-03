@extends('front.common.root')

@section('description','新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】に掲載されている企業をお好みの条件で絞り込みできる検索詳細ページです。「フリーワード」「業種」「職種」「地域」で絞り込みができるので探している企業を簡単に見つけられます。')

@section('title','企業検索詳細｜LinkT(リンクト) - 新卒・第二新卒向けの次世代型就活サイト')

@section('css')
    <link rel="stylesheet" href="{{asset('css/company-search/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/company-search/index.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .fnd-company {border-radius: 20px;}
        .find-company__selects select {border-radius: 7px;}
        .fnd-company__search input[type='search'] {width: 100%;border-radius: 7px;}
        .find-company__search__checklists {margin: 1px 0px 15px 0px;}
        .find-company__button button[type='submit'] {border-radius: 7px;}
        .find-company__search__checklists input[type='checkbox'] + label {margin-bottom: 10px;}
        .result__company {padding: 0 3.5em;}
        .result__company > article {box-shadow: 3px 3px 6px #00000015;border-radius: 20px;overflow: hidden;}
        .result__company > article > picture img {height: auto;}
        .result__company header {padding: 0 1em;}
        .result__company__body {padding: 0 1em 1em 1em;}
        .result__company__body p{font-size: 15px}
        .result__company__body p:last-child{font-size: 13px}
        .company__info {width: 100%;}
        .company__info h3 {display: inline-block;}
        .tag {display: inline-block !important;font-size: 80%;border-radius: 7px;}
        .company__feature {font-size: 90%;font-weight: normal;}
        .company__feature li:not(:last-child) {border-right: none;}
        .company__feature li:not(:last-child):after {content: '\00a0 \00a0 /';}
        #student_search_toggle_button {display:none}

        @media only screen and (max-width: 480px) and (min-width: 320px){
            .result__company {padding: 0;}
        }
        @media screen and (min-width: 360px) and (max-width: 480px) {
            #student_search_toggle_button {position: fixed;display: flex;width: 40px;height: 100px;background: #0081cc;
                color: #fff;justify-content: center;align-items: center;border-radius: 10px 0px 0px 10px;z-index:1;
                font-size: 24px;margin-top: 25px;right: 0}
            form#company-search{margin-top:-25px;width: calc(100% - 48px)!important;right: calc((-1) * (100% - 48px));position:fixed;z-index: 1;}
            .fnd-company {border-radius: 20px 0px 0px 20px !important;padding: 10px;}
            .selectBox__wrapper::before {top: calc(50% - 8px);}
            .selectBox__wrapper::after {top: calc(50% - 8px - 1px);}
            .find-company__selects{display: block;margin-bottom: 0px}
            .find-company__selects>div{width: 100%;}
            .find-company__selects select {margin: 0 auto 8px;}
            .fnd-company__search>input{margin-top: 0;}
            .find-company__search__checklists {display: block;margin: 0;}
            .find-company__search__checklists input[type='checkbox'] + label{margin-bottom: 4px}
            .result__company > article + article {padding-top: 0;}
            .result__company header {margin-bottom: 1em;}
            .result__company__body p:nth-child(2){margin-bottom: 1em;}
        }
        @media screen and (min-width: 320px) and (max-width: 359px) {
            #student_search_toggle_button {position: fixed;display: flex;width: 40px;height: 100px;background: #0081cc;
                color: #fff;justify-content: center;align-items: center;border-radius: 10px 0px 0px 10px;z-index: 1;
                font-size: 24px;margin-top: 25px;right: 0;}
            form#company-search{margin-top:-25px;width: calc(100% - 48px)!important;right: calc((-1) * (100% - 48px));position:fixed;z-index: 1}
            .fnd-company {border-radius: 20px 0px 0px 20px !important;padding: 10px;}
            .selectBox__wrapper::before {top: calc(50% - 9px);}
            .selectBox__wrapper::after {top: calc(50% - 9px - 1px);}
            .find-company__selects{display: block;margin-bottom: 0px}
            .find-company__selects>div{width: 100%;}
            .find-company__selects select {margin: 0 auto 8px;}
            .fnd-company__search>input{margin-top: 0;}
            .find-company__search__checklists {display: block;margin: 0;}
            .find-company__search__checklists input[type='checkbox'] + label{margin-bottom: 4px}
            .result__company > article + article {padding-top: 0;}
            .result__company header {margin-bottom: 1em;}
            .result__company__body p:nth-child(2){margin-bottom: 1em;}
        }
    </style>
@stop

@section('script')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$data->get('trackingId')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    </script>
    <script>
        $(document).ready(function() {
            var right_position = (screen.width-48);
            var display = false;
            $('#student_search_toggle_button').click(function(){
                if(display){
                    $('#student_search_toggle_button .fa-angle-double-right').removeClass( "fa-angle-double-right" ).addClass( "fa-search" );
                    $('form#company-search').animate({ "right": "-="+right_position+"px" }, "slow" );
                    $('#student_search_toggle_button').animate({ "right": "-="+right_position+"px" }, "slow" );
                    display = false;
                }else{
                    $('#student_search_toggle_button .fa-search').removeClass( "fa-search" ).addClass( "fa-angle-double-right" );
                    $('form#company-search').animate({ "right": "+="+right_position+"px" }, "slow" );
                    $('#student_search_toggle_button').animate({ "right": "+="+right_position+"px" }, "slow" );
                    display = true;
                }
            });
        });
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li>企業検索</li>
        </ul>
    </nav>
@stop

@section('js')
    <script src="{{ asset('js/company-search-detail/scroll.js') }}"></script>
    <script src="{{ asset('js/company-search-detail/list.js') }}"></script>
@stop

@section('content')
    <input type="hidden" name="tracking-id" value="{{$data->get('trackingId')}}" id='trackingId'>
    @include('front.common.mypage_menu')
    <section class="main__content">
        <h2 class="main__content__headline">企業検索</h2>
        <div id="student_search_toggle_button"><i class="fa fa-search"></i></div>
        <async-search v-cloak id="company-search" url="{{route("front.company.search")}}" :initial-search="true" @if($data->has("pager.index")) :initial-page-index="{{$data->get("pager.index")}}" :is-pager="true" @endif>
            <div slot="condition-field" slot-scope="component">
                <div class="fnd-company">
                    <div class="error"
                         v-if="component && component.errors && (component.errors.companyNameCondition || component.errors.industryCondition || component.errors.jobTypeCondition || component.errors.recruitmentTargetConditionThisYear || component.errors.recruitmentTargetConditionNextYear || component.errors.recruitmentTargetConditionIntern)">
                        <div v-for="messages in component.errors">
                            <div v-for="(message, key) in messages">
                                @{{ message }}<br>
                            </div>
                        </div>
                    </div>
                    <div class="find-company__selects invalid-form">
                        <div class="selectBox__wrapper">
                            {{Form::select('industryCondition', $data->get('businessTypeList'), $data->get("industryCondition"), ["v-bind:class" => "component.errors.industryCondition ? 'invalid-control' : ''", "id"=>"industryCondition","placeholder" => "業種"])}}
                        </div>
                        <div class="selectBox__wrapper">
                            {{Form::select('jobTypeCondition', $data->get('jobTypeList'), $data->get("jobTypeCondition"), ["v-bind:class" => "component.errors.jobTypeCondition ? 'invalid-control' : ''", "id"=>"jobTypeCondition","placeholder" => "職種"])}}
                        </div>
                        <div class="selectBox__wrapper">
                            {{Form::select('areaCondition', $data->get('prefectureList'), $data->get("areaCondition"), ["v-bind:class" => "component.errors.areaCondition ? 'invalid-control' : ''", "id"=>"areaCondition","placeholder" => "エリア"])}}
                        </div>
                    </div>
                    <div class="fnd-company__search invalid-form">
                        {{Form::search('companyNameCondition', $data->get("companyNameCondition"), ["v-bind:class" => "component.errors.companyNameCondition ? 'invalid-control' : ''", "id"=>"companyNameCondition","placeholder"=>"企業名で検索しよう", "maxlength" =>255])}}
                        {{--<input type="submit" value="検索" class="js-search-company-name">--}}
                    </div>
                    <div class="find-company__search__checklists">
                        {{--<p>募集対象</p>--}}
                        {{Form::checkbox('recruitmentTargetConditionThisYear', 1, $data->get("recruitmentTargetConditionThisYear"), ["v-bind:checked" => "component.recruitmentTargetConditionThisYear","id"=>"recruitmentTargetConditionThisYear"])}}
                        <label for="recruitmentTargetConditionThisYear">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::THIS_YEAR]}}</label>
                        {{Form::checkbox('recruitmentTargetConditionNextYear', 1, $data->get("recruitmentTargetConditionNextYear"), ["v-bind:checked" => "component.recruitmentTargetConditionNextYear","id"=>"recruitmentTargetConditionNextYear"])}}
                        <label for="recruitmentTargetConditionNextYear">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::NEXT_YEAR]}}</label>
                        {{Form::checkbox('recruitmentTargetConditionIntern', 1, $data->get("recruitmentTargetConditionIntern"), ["v-bind:checked" => "component.recruitmentTargetConditionIntern", "id"=>"recruitmentTargetConditionIntern"])}}
                        <label for="recruitmentTargetConditionIntern">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::INTERN]}}</label>
                    </div>
                    <div class="find-company__button js-b js-submit-search">
                        <button type="submit">検索</button>
                    </div>
                </div>
            </div>
            <div v-cloak slot="result-field" slot-scope="component" v-if="component.searched" class="container">
                <div v-if="component.hasResults" class="result__company">
                    <article v-for="company in component.result.companies" class="js-link-area cursor-pointer" v-bind:data-href="company.detail_pass">
                        <picture  class="scroll-save">
                            <img v-bind:src="company.imgPath" v-bind:alt="company.companyName">
                        </picture>
                        <header  class="scroll-save">
                            <div class="company__logo">
                                <picture>
                                    <img v-bind:src="company.logoPath" v-bind:alt="company.companyName">
                                </picture>
                            </div>
                            <div class="company__info">
                                <h3>@{{company.companyName}}</h3>
                                <div class="tag" v-bind:class="company.tagColorClass">@{{ company.tag }}</div>
                                <div>
                                    <ul class="company__feature">
                                        <li v-for="recruitTag in company.recruitTagList">@{{ recruitTag }}</li>
                                    </ul>
                                </div>
                            </div>
                        </header>
                        <div class="result__company__body">
                            <p class="scroll-save" style="font-weight: 700;">業種：@{{company.industries}}</p>
                            <p class="scroll-save" style="font-weight: 700;">本社：@{{company.headOffice}}</p>
                            <p class="scroll-save">@{{company.message}}</p>
                        </div>
                    </article>
                </div>
                <div v-else-if="!component.hasResults">
                    検索結果はございません
                </div>
            @include('front.common.vue_pagination')
        </async-search>
    </section>
    @include('front.common.indicator')
@stop
