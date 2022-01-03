@extends('front.common.root')

@section('title','Web面接予約キャンセル│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common_custom.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li><a href="{{route('front.video-interview.list')}}">面接予約一覧</a></li>
            <li>予約キャンセル確認</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        <h2 class="main__content__headline">Web面接予約詳細</h2>
        <p class="cancelMessage">以下の予約をキャンセルしますか？</p>
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
            <dd>{{$data->get("appointmentDate")}}(木)</dd>
            <dt>開始時間</dt>
            <dd>{{$data->get("appointmentTime")}}</dd>
            <dt>内容</dt>
            <dd>
                <p>{{$data->get("content")}}</p>
            </dd>
        </dl>
        {{Form::open(['url'=>route('front.video-interview.cancel-execute',['userAccountId'=>$data->get("interviewAppointmentId")]), 'class'=>("cancelForm")])}}
        <dl>
            <dt>キャンセルメッセージ</dt>
            <dd class="invalid-form">
                {{Form::textarea('cancelMessage', '', ["class" => (!empty($errors->has('contact')) ? "invalid-control width100" : "width100"), "id"=>"cancelMessage", "cols"=>"30", "rows"=>"10", "placeholder" => "この度は勝手ながら御社の面接を辞退させていただけますと幸いです。",  "maxlength" => 400])}}
                @include('front.common.input_error', ['errors' => $errors, 'targets' => ['cancelMessage']])
            </dd>
        </dl>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="{{$data->get("videoInterviewListUrl")}}">
            <input type="submit" value="キャンセルする" class="cancel">
        </div>
        {{Form::close()}}
    </div>
@stop
