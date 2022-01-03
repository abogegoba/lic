@extends('client.common.root')

@section('title','学生検索詳細｜LinkT(リンクト) - 次世代型新卒・第二新卒採用サービス')

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
        .result > article {max-width: 100%;padding: 15px 15px 25px; border-radius: 15px;background: #F4F4F4;box-sizing: border-box;}
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
            .student_search{margin-top:-36px;}
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
            .student_search{margin-top:-36px;}
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
    <script>
        var right_position = (screen.width-48);
        var tab_right_position = (screen.width-48)+(screen.width-320);
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            if(cityName == 'overseas'){
                $('#'+cityName+' form#student-search').css('right',0);
                $('#'+cityName+' form#overseas-student-search').css('right',0);
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        var display = false;
        $('#student_search_toggle_button').click(function(){
            if(display){
                $('#student_search_toggle_button .fa-angle-double-right').removeClass( "fa-angle-double-right" ).addClass( "fa-search" );
                $('form#student-search').animate({ "right": "-="+right_position+"px" }, "slow" );
                $('form#overseas-student-search').animate({ "right": "-="+right_position+"px" }, "slow" );
                $('.tab').animate({ "right": "-="+tab_right_position+"px" }, "slow" );
                $('#student_search_toggle_button').animate({ "right": "-="+right_position+"px" }, "slow" );
                display = false;
            }else{
                $('#student_search_toggle_button .fa-search').removeClass( "fa-search" ).addClass( "fa-angle-double-right" );
                $('form#student-search').animate({ "right": "+="+right_position+"px" }, "slow" );
                $('form#overseas-student-search').animate({ "right": "+="+right_position+"px" }, "slow" );
                $('.tab').animate({ "right": "+="+tab_right_position+"px" }, "slow" );
                $('#student_search_toggle_button').animate({ "right": "+="+right_position+"px" }, "slow" );
                display = true;
            }
        });

    </script>
@stop

@section('vue')
    <script src="{{asset('js/student/list_vue.js')}}"></script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li>学生検索</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <section class="main__content">
        <h2 class="main__content__headline">学生検索</h2>
        <div id="student_search_toggle_button"><i class="fa fa-search"></i></div>
        <div class="tab">
            <button class="tablinks bk" onclick="openCity(event, 'japan')" id="defaultOpen">日本</button>
            <button class="tablinks ash" onclick="openCity(event, 'overseas')">海外</button>
        </div>

        <div id="japan" class="tabcontent">
            @if($data->get("reloadFlg") === false)
            <async-search v-cloak id="student-search" class="japan_student_search" url="{{route("client.student.search")}}" :initial-search="false" @if($data->get("pager.index")) :initial-page-index="{{$data->get("pager.index")}}" :is-pager="true" @endif>
            @elseif($data->get("reloadFlg") === true)
            <async-search v-cloak id="student-search" class="japan_student_search" url="{{route("client.student.search")}}" :initial-search="true" @if($data->get("pager.index")) :initial-page-index="{{$data->get("pager.index")}}" :is-pager="true" @endif>
            @endif
                <div slot="condition-field" slot-scope="component" class="fnd-company student">
                    <div class="error" v-if="component && component.errors && (component.errors.keywordCondition || component.errors.undergraduateCourseCondition || component.errors.isBelongsAthleticClubCondition || component.errors.isInternApplicantCondition)">
                        <div v-for="messages in component.errors">
                            <div v-for="(message, key) in messages">
                                @{{ message }}<br>
                            </div>
                        </div>
                    </div>
                    <div class="error condition_error">条件を入力してください</div>
                    <div class="fnd-company__search invalid-form">
                        {{Form::search('keywordCondition', $data->get("keywordCondition"), ["v-bind:class" => "component.errors.keywordCondition ? 'invalid-control' : ''", "id"=>"keywordCondition","placeholder"=>"学生名、学校名で検索してください", "maxlength" =>255])}}
                        {{--<input type="submit" value="検索" class="js-search-keyword">--}}
                    </div>
                    <div class="find-company__selects invalid-form">
                        <div>
                            {{--<p>学部系統</p>--}}
                            <div class="selectBox__wrapper">
                                {{--{{Form::select('undergraduateCourseCondition', $data->get("facultyTypeList"), $data->get("undergraduateCourseCondition"), ["v-bind:class" => "component.errors.undergraduateCourseCondition ? 'invalid-control' : ''", "id"=>"undergraduateCourseCondition","placeholder" => "選択してください"])}}--}}
                                {{Form::select('undergraduateCourseCondition', $data->get("facultyTypeList"), $data->get("undergraduateCourseCondition"), ["v-bind:class" => "component.errors.undergraduateCourseCondition ? 'invalid-control' : ''", "id"=>"undergraduateCourseCondition","placeholder" => "学部系統"])}}
                            </div>
                        </div>
                        <div>
                            {{--<p>希望業種</p>--}}
                            <div class="selectBox__wrapper">
                                {{Form::select('industryCondition', $data->get("businessTypeList"), $data->get("industryCondition"), ["v-bind:class" => "component.errors.industryCondition ? 'invalid-control' : ''", "id"=>"industryCondition","placeholder" => "希望業種"])}}
                                {{--{{Form::select('industryCondition', $data->get("businessTypeList"), $data->get("industryCondition"), ["v-bind:class" => "component.errors.industryCondition ? 'invalid-control' : ''", "id"=>"industryCondition","placeholder" => "選択してください"])}}--}}
                            </div>
                        </div>
                        <div>
                            {{--<p>希望勤務地</p>--}}
                            <div class="selectBox__wrapper">
                                {{Form::select('areaCondition', $data->get("prefectureList"), $data->get("areaCondition"), ["v-bind:class" => "component.errors.areaCondition ? 'invalid-control' : ''", "id"=>"areaCondition","placeholder" => "希望勤務地"])}}
                                {{--{{Form::select('areaCondition', $data->get("prefectureList"), $data->get("areaCondition"), ["v-bind:class" => "component.errors.areaCondition ? 'invalid-control' : ''", "id"=>"areaCondition","placeholder" => "選択してください"])}}--}}
                            </div>
                        </div>
                        <input type="hidden" name="countryCondition" id="countryCondition" value="1">
                    </div>
                    <div class="find-company__selects invalid-form">
                        <div>
                            {{--<p>卒業年</p>--}}
                            <div class="selectBox__wrapper">
                                {{Form::select('graduationPeriodYear', $data->get("yearList"), $data->get("graduationPeriodYear"), ["v-bind:class" => "component.errors.graduationPeriodYear ? 'invalid-control' : ''", "id"=>"graduationPeriodYear","placeholder" => "卒業年"])}}
                            </div>
                        </div>
                        <div>
                            {{--<p>卒業月</p>--}}
                            <div class="selectBox__wrapper">
                                {{Form::select('graduationPeriodMonth', $data->get("monthList"), $data->get("graduationPeriodMonth"), ["v-bind:class" => "component.errors.graduationPeriodMonth ? 'invalid-control' : ''", "id"=>"graduationPeriodMonth","placeholder" => "卒業月"])}}
                            </div>
                        </div>
                        <div></div>
                    </div>
                    <div class="find-company__checklists">
                        {{Form::checkbox('isInternApplicantCondition', 1, '', ["v-bind:checked" => "component.isInternApplicantCondition", "id"=>"isInternApplicantCondition"])}}
                        <label for="isInternApplicantCondition">インターン希望者</label>

                        {{Form::checkbox('isBelongsAthleticClubCondition', 1, '', ["v-bind:checked" => "component.isBelongsAthleticClubCondition", "id"=>"isBelongsAthleticClubCondition"])}}
                        <label for="isBelongsAthleticClubCondition">体育会系所属</label>
                    </div>
                    <div class="find-company__button js-submit-search">
                        <button type="submit">検索</button>
                    </div>
                </div>

                <div class="student_search" v-cloak slot="result-field" slot-scope="component" v-if="component.searched">
                    <div v-if="component.hasResults" class="result">
                        <article v-for="(student, index) in component.result.students" class="js-link-area cursor-pointer" v-bind:data-href="student.detail_pass">
                            <header class="result-hdr scroll-save">
                                <div class="round-img">
                                    <picture>
                                        <img v-bind:src="student.imgPass" v-bind:alt="student.studentName">
                                    </picture>
                                    <div class="student-like-parent">
                                        <div @click.stop="likeMember(index, component.result.students, component.result.loggedInCompanyAccountId)">
                                            <div v-if="student.checkLikeOrNotStatus == 20" class="student-like">
                                                <p>気になる</p>
                                                <img src="{{asset('img/client/student-search/heart-small-regular.png')}}" alt="">
                                            </div>
                                            <div v-else class="student-not-like">
                                                <p>気になる</p>
                                                <img src="{{asset('img/client/student-search/heart-small-gray.png')}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="student.hasReceivedMessages" class="message-sent">メッセージ済</div>
                                </div>
                                <div class="student-basic-info">
                                    <h3 style="display:inline;">@{{ student.studentName }}</h3>
                                    <span>（@{{ student.age }}歳 / @{{ student.graduationYear }}年@{{ student.alreadyGraduated }}）</span>
                                    <h3 style="font-size: 14px; margin-top: 5px;">@{{ student.universityName }} / @{{ student.faculty }}</h3>
                                    <div class="student-detail">
                                        <div class="student-aspiration-business-types">
                                            <span class="student-requirements-type">志望業種</span>
                                            <span class="student-requirements"> @{{ student.aspirationBusinessTypes }}</span>
                                        </div>
                                        <div class="student-aspiration-prefectures">
                                            <span class="student-requirements-type">志望勤務地</span>
                                            <span class="student-requirements"> @{{ student.aspirationPrefectures }}</span>
                                        </div>
                                        <span class="tag" v-bind:class="student.tagColorClass" v-if="student.tag !== null">@{{ student.tag }}</span>
                                        <span class="intern" v-if="student.isInternApplicant === true">インターン希望</span>
                                        <span class="tag tag--bk mr7" v-for="studentType in student.studentTypes">@{{ studentType }}</span>
                                        {{--<ul class="student-type">
                                            <li v-for="studentType in student.studentTypes">@{{ studentType }}</li>
                                        </ul>--}}
                                    </div>
                                </div>
                                <div class="student-basic-info-pc">
                                    <h3>@{{ student.studentName }}</h3>
                                    <p>(@{{ student.age }}歳 / @{{ student.graduationYear }}年@{{ student.alreadyGraduated }})</p>
                                    <p>@{{ student.universityName }} / @{{ student.faculty }}</p>
                                </div>
                                <div class="student-detail-pc">
                                    <div class="student-aspiration-business-types">
                                        <span class="student-requirements-type">志望業種</span>
                                        <span class="student-requirements"> @{{ student.aspirationBusinessTypes }}</span>
                                    </div>
                                    <div class="student-aspiration-prefectures">
                                        <span class="student-requirements-type">志望勤務地</span>
                                        <span class="student-requirements"> @{{ student.aspirationPrefectures }}</span>
                                    </div>
                                    <span class="tag" v-bind:class="student.tagColorClass" v-if="student.tag !== null">@{{ student.tag }}</span>
                                    <span class="intern" v-if="student.isInternApplicant === true">インターン希望</span>
                                    <span class="tag tag--bk mr7" v-for="studentType in student.studentTypes">@{{ studentType }}</span>
                                    {{--<ul class="student-type">
                                        <li v-for="studentType in student.studentTypes">@{{ studentType }}</li>
                                    </ul>--}}
                                </div>
                                <div class="student-like-parent-pc">
                                    <div @click.stop="likeMember(index, component.result.students, component.result.loggedInCompanyAccountId)" style="margin-left: 50%;">
                                        <div v-if="student.checkLikeOrNotStatus == 20" class="student-like-pc">
                                            <p>気になる</p>
                                            <img src="{{asset('img/client/student-search/heart-small-regular.png')}}" alt="">
                                        </div>
                                        <div v-else class="student-not-like-pc">
                                            <p>気になる</p>
                                            <img src="{{asset('img/client/student-search/heart-small-gray.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </header>
                        </article>
                    </div>
                    @include('client.common.vue_pagination_except_pages')
                    <div class="empty_search_result" v-else-if="!component.hasResults">
                        検索結果はございません
                    </div>
                </div>
            </async-search>
        </div>

        <div id="overseas" class="tabcontent">
            @if($data->get("reloadFlg") === false)
            <async-search v-cloak id="overseas-student-search" class="overseas_student_search" url="{{route("client.overseas.student.search")}}" :initial-search="false" style="" @if($data->get("pager.index")) :initial-page-index="{{$data->get("pager.index")}}" :is-pager="true" @endif>
            @elseif($data->get("reloadFlg") === true)
            <async-search v-cloak id="overseas-student-search" class="overseas_student_search" url="{{route("client.overseas.student.search")}}" :initial-search="true" @if($data->get("pager.index")) :initial-page-index="{{$data->get("pager.index")}}" :is-pager="true" @endif>
            @endif
                <div slot="condition-field" slot-scope="component" class="fnd-company student">
                    <div class="error" v-if="component && component.errors && (component.errors.keywordCondition || component.errors.undergraduateCourseCondition || component.errors.isBelongsAthleticClubCondition || component.errors.isInternApplicantCondition)">
                        <div v-for="messages in component.errors">
                            <div v-for="(message, key) in messages">
                                @{{ message }}<br>
                            </div>
                        </div>
                    </div>
                    <div class="error condition_error">条件を入力してください</div>

                    <div class="find-company__selects invalid-form">
                        <div>
                            {{--<p>学部系統</p>--}}
                            <div class="selectBox__wrapper">
                                {{--{{Form::select('undergraduateCourseCondition', $data->get("facultyTypeList"), $data->get("undergraduateCourseCondition"), ["v-bind:class" => "component.errors.undergraduateCourseCondition ? 'invalid-control' : ''", "id"=>"undergraduateCourseCondition","placeholder" => "選択してください"])}}--}}
                                {{Form::select('countryCondition', $data->get("overseasList"), $data->get("countryCondition"), ["v-bind:class" => "component.errors.countryCondition ? 'invalid-control' : ''", "id"=>"countryCondition","placeholder" => "国籍"])}}
                            </div>
                        </div>
                    </div>
                    <div class="find-company__selects invalid-form">
                        <div>
                            {{--<p>学部系統</p>--}}
                            <div class="selectBox__wrapper">
                                {{--{{Form::select('undergraduateCourseCondition', $data->get("facultyTypeList"), $data->get("undergraduateCourseCondition"), ["v-bind:class" => "component.errors.undergraduateCourseCondition ? 'invalid-control' : ''", "id"=>"undergraduateCourseCondition","placeholder" => "選択してください"])}}--}}
                                {{Form::select('undergraduateCourseCondition', $data->get("overseasFacultyTypeList"), $data->get("undergraduateCourseCondition"), ["v-bind:class" => "component.errors.undergraduateCourseCondition ? 'invalid-control' : 'undergraduate_course_condition'", "id"=>"undergraduateCourseCondition","placeholder" => "学部"])}}
                            </div>
                        </div>
                        <div>
                            {{--<p>希望業種</p>--}}
                            <div class="selectBox__wrapper">
                                {{Form::select('industryCondition', $data->get("businessTypeList"), $data->get("industryCondition"), ["v-bind:class" => "component.errors.industryCondition ? 'invalid-control' : 'industry_condition'", "id"=>"industryCondition","placeholder" => "希望業種"])}}
                                {{--{{Form::select('industryCondition', $data->get("businessTypeList"), $data->get("industryCondition"), ["v-bind:class" => "component.errors.industryCondition ? 'invalid-control' : ''", "id"=>"industryCondition","placeholder" => "選択してください"])}}--}}
                            </div>
                        </div>
                        <div>
                            {{--<p>希望勤務地</p>--}}
                            <div class="selectBox__wrapper">
                                {{Form::select('areaCondition', $data->get("prefectureList"), $data->get("areaCondition"), ["v-bind:class" => "component.errors.areaCondition ? 'invalid-control' : 'area_condition'", "id"=>"areaCondition","placeholder" => "希望勤務地"])}}
                                {{--{{Form::select('areaCondition', $data->get("prefectureList"), $data->get("areaCondition"), ["v-bind:class" => "component.errors.areaCondition ? 'invalid-control' : ''", "id"=>"areaCondition","placeholder" => "選択してください"])}}--}}
                            </div>
                        </div>
                    </div>
                    <div class="find-company__checklists">
                        {{Form::checkbox('isInternApplicantCondition', 1, '', ["v-bind:checked" => "component.isInternApplicantCondition", "id"=>"overseasIsInternApplicantCondition"])}}
                        <label for="overseasIsInternApplicantCondition">インターン希望者</label>

                        {{--{{Form::checkbox('isBelongsAthleticClubCondition', 1, '', ["v-bind:checked" => "component.isBelongsAthleticClubCondition", "id"=>"isBelongsAthleticClubCondition"])}}
                        <label for="isBelongsAthleticClubCondition">体育会系所属</label>--}}
                    </div>
                    <div class="find-company__button js-submit-search-overseas">
                        <button type="submit">検索</button>
                    </div>
                </div>

                <div class="student_search" v-cloak slot="result-field" slot-scope="component" v-if="component.searched">
                    <div v-if="component.hasResults" class="result">
                        <article v-for="(student, index) in component.result.students" class="js-link-area cursor-pointer" v-bind:data-href="student.detail_pass">
                            <header class="result-hdr scroll-save">
                                <div class="round-img">
                                    <picture>
                                        <img v-bind:src="student.imgPass" v-bind:alt="student.studentName">
                                    </picture>
                                    <div class="student-like-parent">
                                        <div @click.stop="likeMember(index, component.result.students, component.result.loggedInCompanyAccountId)">
                                            <div v-if="student.checkLikeOrNotStatus == 20" class="student-like">
                                                <p>気になる</p>
                                                <img src="{{asset('img/client/student-search/heart-small-regular.png')}}" alt="">
                                            </div>
                                            <div v-else class="student-not-like">
                                                <p>気になる</p>
                                                <img src="{{asset('img/client/student-search/heart-small-gray.png')}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="student.hasReceivedMessages" class="message-sent">メッセージ済</div>
                                </div>
                                <div class="student-basic-info">
                                    <h3 style="display:inline;">@{{ student.studentName }}</h3>
                                    <span>（@{{ student.age }}歳 / @{{ student.graduationYear }}年@{{ student.alreadyGraduated }}）</span>
                                    <h3 style="font-size: 14px; margin-top: 5px;">@{{ student.universityName }} / @{{ student.faculty }}</h3>
                                    <div class="student-detail">
                                        <div class="student-aspiration-business-types">
                                            <span class="student-requirements-type">志望業種</span>
                                            <span class="student-requirements"> @{{ student.aspirationBusinessTypes }}</span>
                                        </div>
                                        <div class="student-aspiration-prefectures">
                                            <span class="student-requirements-type">志望勤務地</span>
                                            <span class="student-requirements"> @{{ student.aspirationPrefectures }}</span>
                                        </div>
                                        <span class="tag" v-bind:class="student.tagColorClass" v-if="student.tag !== null">@{{ student.tag }}</span>
                                        <span class="intern" v-if="student.isInternApplicant === true">インターン希望</span>
                                        <span class="tag tag--bk mr7" v-for="studentType in student.studentTypes">@{{ studentType }}</span>
                                        {{--<ul class="student-type">
                                            <li v-for="studentType in student.studentTypes">@{{ studentType }}</li>
                                        </ul>--}}
                                    </div>
                                </div>
                                <div class="student-basic-info-pc">
                                    <h3>@{{ student.studentName }}</h3>
                                    <p>（@{{ student.age }}歳 / @{{ student.graduationYear }}年@{{ student.alreadyGraduated }}）</p>
                                    <p>@{{ student.universityName }} / @{{ student.faculty }}</p>
                                </div>
                                <div class="student-detail-pc">
                                    <div class="student-aspiration-business-types">
                                        <span class="student-requirements-type">志望業種</span>
                                        <span class="student-requirements"> @{{ student.aspirationBusinessTypes }}</span>
                                    </div>
                                    <div class="student-aspiration-prefectures">
                                        <span class="student-requirements-type">志望勤務地</span>
                                        <span class="student-requirements"> @{{ student.aspirationPrefectures }}</span>
                                    </div>
                                    <span class="tag" v-bind:class="student.tagColorClass" v-if="student.tag !== null">@{{ student.tag }}</span>
                                    <span class="intern" v-if="student.isInternApplicant === true">インターン希望</span>
                                    <span class="tag tag--bk mr7" v-for="studentType in student.studentTypes">@{{ studentType }}</span>
                                    {{--<ul class="student-type">
                                        <li v-for="studentType in student.studentTypes">@{{ studentType }}</li>
                                    </ul>--}}
                                </div>
                                <div class="student-like-parent-pc">
                                    <div @click.stop="likeMember(index, component.result.students, component.result.loggedInCompanyAccountId)" style="margin-left: 50%;">
                                        <div v-if="student.checkLikeOrNotStatus == 20" class="student-like-pc">
                                            <p>気になる</p>
                                            <img src="{{asset('img/client/student-search/heart-small-regular.png')}}" alt="">
                                        </div>
                                        <div v-else class="student-not-like-pc">
                                            <p>気になる</p>
                                            <img src="{{asset('img/client/student-search/heart-small-gray.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </header>
                        </article>
                    </div>
                    @include('client.common.vue_pagination_except_pages')
                    <div class="empty_search_result" v-else-if="!component.hasResults">
                        検索結果はございません
                    </div>
                </div>
            </async-search>
        </div>

    </section>
    @include('front.common.indicator')
@stop
