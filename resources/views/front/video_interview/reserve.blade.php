@extends('front.common.root')

@section('title','Web面接予約詳細│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common_custom.css')}}">
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#videoInterviewLink').prop('checked', false);

            $('#videoInterviewLink').change(function(){
                if(this.checked){
                    $('#videoLink').attr('href',"{{$data->get("videoInterviewRoomUrl")}}");
                    $('#videoLink').css("background","#E60113");
                }else{
                    $('#videoLink').attr('href','#');
                    $('#videoLink').css("background","#808080");
                }
            });

            $('#videoLink').click(function(){
                var link = $('#videoLink').attr('href');
                if(link == '#'){
                    $('.find-company__checklists input[type=\'checkbox\'] + label').css('color','#E60113');
                    $('#linkDiv').show();
                }
            });
        });
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li><a href="{{route('front.video-interview.list')}}">面接予約一覧</a></li>
            <li>予約詳細</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        <div id="linkDiv" style="display: none">
            <p>注意事項の推奨ブラウザを確認して面接へ進んでください。</p>
        </div>
        <h2 class="main__content__headline_interview-reserve">Web面接予約詳細</h2>
        <h2 class="headline--small">{{$data->get("companyName")}}</h2>
        <section class="companyInfo">
            <div>
                <dl>
                    <dt>業種：</dt>
                    <dd>{{$data->get("formattedBusinessTypes")}}</dd>
                </dl>
                <dl>
                    <dt>本社：</dt>
                    <dd>{{$data->get("headOfficePrefecture")}}</dd>
                </dl>
                <p>{{$data->get("introductorySentence")}}</p>
            </div>
        </section>
        <dl class="basic">
            <dt>予約日</dt>
            <dd>{{$data->get("appointmentDate")}}</dd>
            <dt>開始時間</dt>
            <dd>{{$data->get("appointmentTime")}}</dd>
            <dt>注意事項</dt>
            <dd>
                <div class="videoInterview__checklists">
                {{Form::checkbox('videoInterviewLink', 1, '', ["id"=>"videoInterviewLink"])}}
                <label for="videoInterviewLink">以下推奨ブラウザを確認して問題がなければ、チェックして面接へ進んでください。</label>
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
            </dd>
            <dt>内容</dt>
            <dd>
                <p>{{$data->get("content")}}</p>
            </dd>
        </dl>
        <div class="form__controls">
            <a id="videoLink" href="#">Web面接ページへ</a>
        </div>
        <div class="form__controls">
            <input type="button" value="キャンセルする" class="cancel js-btn-link" data-href="{{$data->get("videoInterviewCancelUrl")}}">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="{{route("front.video-interview.list")}}">
        </div>
    </div>
@stop
