@extends('client.common.root')

@section('title','気になる学生｜LinkT(リンクト) - 次世代型新卒・第二新卒採用サービス')

@section('css')
    <link rel="stylesheet" href="{{asset('css/student-search/common.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .tab {overflow: hidden;}
        .tab>button {float: left;cursor: pointer;padding: 3px 45px;transition: 0.3s;font-size: 15px;border-radius: 10px 10px 0px 0px;margin: 0;}
        .tab>.bk{background: #313131;}
        .tab>.ash{background: #5C5C5C;}
        #overseas .student{background: #5C5C5C !important;}
        .tab>button:hover {opacity: 1;}
        .tabcontent {display: none;margin: 0;}
        .topright {float: right;cursor: pointer;font-size: 28px;}
        .topright:hover {color: red;}
        .fnd-company {border-radius: 0px 10px 10px 10px !important}
        .find-company__selects {margin-bottom: 10px;}
        #overseas .find-company__selects:nth-child(1) {margin: 8px 0px;}
        .find-company__selects select {border-radius: 5px;}
        .fnd-company__search input[type='search']{width: 100% !important;border-radius: 5px !important;}
        .fnd-company button{border-radius: 10px;}
        #student_search_toggle_button {display:none}
        .result > article {max-width: 100%;padding: 15px;border-radius: 15px;background: #F4F4F4;box-sizing: border-box;}
        .result > article + article {margin-top: 1em;padding-top: 15px;border-top: none;}
        .result-hdr {margin-bottom: 0;}
        .tag--bk{background: #AAA6A6;}
        .mr7{margin-right: 8px;}
        .tag, .intern {
            padding: .5em 1.2em;
            border-radius: 7px;
            font-size: 13px;
        }

        @media screen and (min-width: 1200px){
            #breadcrumbs ~ #main .main__content {
                margin-top: 190px;
            }
        }

        @media screen and (min-width: 768px){
            .result > article {width: 100%;margin: 0 0 1em 0;}
            .result > article + article {margin-top: 0em;padding-top: 15px;}
            #breadcrumbs ~ #main #mypageMenu + .main__content {
                margin-top: calc(30px + 101px + 30px);
            }
        }

        @media screen and (min-width: 360px) and (max-width: 480px) {
            #student_search_toggle_button {
                position: fixed;display: flex;width: 40px;height: 100px;background: #313131;color: #fff;
                justify-content: center;align-items: center;border-radius: 10px 0px 0px 10px;z-index:1;
                font-size: 24px;margin-top: 25px;right: 0}
            .tab,form#student-search,form#overseas-student-search{position:fixed;z-index: 1}
            .tab{margin-top:-50px;right: calc((-1) * (100% - 160px));}
            .tab>button {padding: 3px 25px;}
            form#student-search,form#overseas-student-search{margin-top:-25px;width: calc(100% - 48px)!important;right: calc((-1) * (100% - 48px));}
            .fnd-company {border-radius: 0px 0px 0px 10px !important;padding: 10px;}
            #overseas .find-company__selects:nth-child(1) {margin: 8px 0px 0px 0px;}
            .selectBox__wrapper::before {top: calc(50% - 8px);}
            .selectBox__wrapper::after {top: calc(50% - 8px - 1px);}
            .find-company__selects{display: block;margin-bottom: 0px}
            .find-company__selects>div{width: 100%;}
            .find-company__selects select {margin: 0 auto 8px;}
            .find-company__checklists {display: block;margin: 0;}
            .find-company__checklists input[type='checkbox'] + label{margin-bottom: 4px}
            .result, .empty_search_result{margin-top: 60px;}
            /*.result > article + article {margin-top: 1em;padding-top: 15px;border-top: none;}*/
        }
        @media screen and (min-width: 320px) and (max-width: 359px) {
            #student_search_toggle_button {
                position: fixed;display: flex;width: 40px;height: 100px;background: #313131;color: #fff;
                justify-content: center;align-items: center;border-radius: 10px 0px 0px 10px;z-index:1;
                font-size: 24px;margin-top: 25px;right: 0}
            .tab,form#student-search,form#overseas-student-search{position:fixed;z-index: 1}
            .tab{margin-top:-50px;right: calc((-1) * (100% - 160px));}
            .tab>button {padding: 3px 25px;}
            form#student-search,form#overseas-student-search{margin-top:-25px;width: calc(100% - 48px)!important;right: calc((-1) * (100% - 48px));}
            .fnd-company {border-radius: 0px 0px 0px 10px !important;padding: 10px;}
            #overseas .find-company__selects:nth-child(1) {margin: 8px 0px 0px 0px;}
            .selectBox__wrapper::before {top: calc(50% - 9px);}
            .selectBox__wrapper::after {top: calc(50% - 9px - 1px);}
            .find-company__selects{display: block;margin-bottom: 0px}
            .find-company__selects>div{width: 100%;}
            .find-company__selects select {margin: 0 auto 8px;}
            .find-company__checklists {display: block;margin: 0;}
            .find-company__checklists input[type='checkbox'] + label{margin-bottom: 4px}
            .result, .empty_search_result{margin-top: 60px;}
            /*.result > article + article {margin-top: 1em;padding-top: 15px;border-top: none;}*/
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('js/company/list.js') }}"></script>
    <script src="{{ asset('js/student/scroll.js') }}"></script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li>気になる学生</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <section class="main__content">
        <h2 class="main__content__headline">気になる学生</h2>
        <div class="student_search">
            @if(count($data) > 0)
                <div class="result">
                    @foreach($data as $key=>$value)
                    <article data-href="{{route('client.student.detail',$value->userAccountId)}}" class="js-link-area cursor-pointer">
                        <header class="result-hdr scroll-save">
                            <div class="round-img">
                                <picture><img src="{{$value->photo}}" alt="{{$value->studentName}}"></picture>
                            </div>
                            <div>
                                <h3>{{$value->studentName}}<span>（{{$value->age}}歳／{{$value->graduationYear}}年{{($value->graduationYear <= date("Y")) ? '卒業':'卒業予定'}}）</span></h3>
                                <p>{{$value->schoolName}}／{{$value->departmentName}}</p>
                                @if($value->hashTag)
                                <span class="tag {{$value->hashTagColor? \App\Domain\Entities\Tag::TAG_COLLAR_CLASS_LIST[$value->hashTagColor]:''}}">{{$value->hashTag}}</span>
                                @endif

                                @if($value->internNeeded == 1)
                                <span class="intern">インターン希望</span>
                                @endif

                                @if($value->affiliationExperience == 1)
                                <span class="tag tag--bk mr7">体育会経験あり</span>
                                @endif

                                @if($value->instagramFollowerNumber && \App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_MORE_A_THOUSAND <= $value->instagramFollowerNumber && $value->instagramFollowerNumber <= \App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_MORE_TEN_THOUSAND)
                                <span class="tag tag--bk mr7">インスタフォロワー{{\App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_LABEL_LIST[$value->instagramFollowerNumber]}}</span>
                                @endif
                            </div>
                        </header>
                    </article>
                    @endforeach
                </div>
                @if($pagination_limit > 1)
                <div class="pager">
                    <ul class="pager__list">
                        @if($page == null || $page == 1 )
                            <li class="pager__item disabled">＜</li>
                        @else
                            <li class="pager__item"><a href="{{route('client.like.member.list',($page-1))}}">＜</a></li>
                        @endif

                        @for($i=0;$i<$pagination_limit;$i++)
                            @if($page == null)
                                <li class="pager__item {{ $i == 0 ? 'active':'' }}"><a href="{{route('client.like.member.list',($i+1))}}">{{$i+1}}</a></li>
                            @else
                                <li class="pager__item {{ $i == ($page-1) ? 'active':'' }}"><a href="{{route('client.like.member.list',($i+1))}}">{{$i+1}}</a></li>
                            @endif
                        @endfor

                        @if($page == $pagination_limit)
                            <li class="pager__item disabled">＞</li>
                        @else
                            <li class="pager__item"><a href="{{route('client.like.member.list',(($page == null) ? 2 : ($page + 1)))}}">＞</a></li>
                        @endif

                    </ul>
                </div>
                @endif
            @else
                <p>現在気になる学生がいません。</p>
            @endif
        </div>
    </section>
    @include('front.common.indicator')
@stop
