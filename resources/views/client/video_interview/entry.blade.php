@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','Web面接予約詳細　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common_custom.css')}}">
    <style>
        #browser_recommandation_container {padding: 0px; text-align: justify; line-height: 1.5; font-size: 15px;}
        .find-company__checklists {margin: 0px 0px 15px 0px;}
        .find-company__checklists label {font-weight: 600;color: #2a2a2a;}
        .find-company__checklists input[type='checkbox'] + label{margin-right: 0;font-size: 15px;}
        #browser_support {margin-left: 1.5em;margin-bottom: 1.5em;}
        #pc_browser,#mobile_browser {border-left: 3px solid #0081CC;padding-left: 15px;margin-bottom: 15px;}
        #pc_browser ul,#mobile_browser ul {display: inline-grid;min-width: 40%;}
        #pc_browser ul li, #mobile_browser ul li {list-style: disc;margin-left: 30px;}
        #browser_support p {font-weight: 700;color: #2a2a2a;}
        .main__content__headline:first-of-type {margin-top: 1em !important;}
        div#linkDiv {min-height: 30px;margin-top: 1.5em;text-align: center;color: #E60113;font-size: 20px;}

        @media only screen and (max-width: 767px) and (min-width: 320px){
            #browser_recommandation_container {padding: 0px 25px;}
            .find-company__checklists input[type='checkbox'] + label::before{width: 36px;}
            #browser_support {font-size: 15px;}
            div#linkDiv {font-size: 16px;}
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#videoInterviewLink').prop('checked', false);

            $('#videoInterviewLink').change(function(){
                if(this.checked)
                    $('.next').css('background', '#B9010F');
                else
                    $('.next').css('background', '#434343');
            });

            $('.registForm').submit(function(e) {
                if($("#videoInterviewLink").prop('checked') == false){
                    $('.find-company__checklists input[type=\'checkbox\'] + label').css('color','#E60113');
                    $('#linkDiv').show();
                    e.preventDefault();
                    $('html, body').animate({ scrollTop: '0px'},0);
                    return false;
                }
            });
        });
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.video-interview.list')}}">Web面接</a></li>
            <li>Web面接予約登録</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <div class="main__content">
        <div id="linkDiv" style="display: none">
            <p>注意事項の推奨ブラウザを確認して面接へ進んでください。</p>
        </div>
        <h2 class="main__content__headline_interview-reserve">Web面接予約登録</h2>
        <section class="companyInfo">
            <div class="round-img">
                <picture>
                    <img src="{{$data->get('idImage')}}" alt="証明写真">
                </picture>
            </div>
            <div>
                <h2 class="headline--small"><a>{{$data->get('memberName')}}</a><span>（{{$data->get('age')}}歳／{{$data->get('graduationPeriod')}}年卒業予定）</span></h2>
                <p>{{$data->get('schoolName')}}／{{$data->get('departmentName')}}</p>
                @if(!empty($data->get('hashTagName')))
                    <p class="tag {{$data->get("hashTagColor")}}">{{$data->get('hashTagName')}}</p>
                @endif
            </div>
        </section>
        {{Form::open(['url'=>route('client.video-interview.to-confirm',['userAccountId'=>$data->get("memberUserAccountId")]), 'class'=>("registForm")])}}
            <table class="form__table">
                <tr class="invalid-form">
                    <th class="required"><label for="date">面接日</label></th>
                    <td>
                        {{Form::date('date', $data->get("date"), ["class" => (!empty($errors->has('date')) ? "invalid-control" : ""), "id"=>"date"])}}
                        @include('client.common.input_error', ['errors' => $errors, 'targets' => ['date']])
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="time">開始時間</label></th>
                    <td>
                        {{Form::time('time', $data->get("time"), ["class" => (!empty($errors->has('time')) ? "invalid-control" : ""), "id"=>"time"])}}
                        @include('client.common.input_error', ['errors' => $errors, 'targets' => ['time']])
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th>内容</th>
                    <td>
                        {{Form::textarea('content',  '', ["class" => "width100", "cols" => 30,  "rows" => 10, "id"=>"content", "maxlength" => 400, "placeholder" => "当日は、ざっくばらんにお話できればと思います。時間になりましたらご参加ください。"])}}
                        @include('client.common.input_error', ['errors' => $errors, 'targets' => ['content']])
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th></th>
                    <td>
                        <div id="browser_recommandation_container">
                            <div class="find-company__checklists">
                                {{Form::checkbox('videoInterviewLink', 1, '', ["id"=>"videoInterviewLink"])}}
                                <label for="videoInterviewLink">以下推奨ブラウザを確認して問題がなければ、チェックして面接予約へ進んでください。</label>
                            </div>
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
                                <p>※上記以外のブラウザをご利用の場合、正常に動作しない場合がございます。</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="form__controls">
                <input type="button" value="戻る" class="prev js-btn-link" data-href="{{$data->get("messageDetailUrl")}}">
                <input type="submit" value="面接を予約する" class="next" style="background: #434343;">
            </div>
        {{Form::close()}}
    </div>
@stop
