@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','Web面接キャンセル確認　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/video/common_custom.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.video-interview.list')}}">Web面接</a></li>
            <li>Web面接キャンセル確認</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <div class="main__content">
        <h2 class="main__content__headline">Web面接キャンセル確認</h2>
        <p class="cancelMessage">以下の予約をキャンセルしますか？</p>
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
        <dl class="basic">
            <dt>予約日</dt>
            <dd>{{$data->get('appointmentDate')}}</dd>
            <dt>開始時間</dt>
            <dd>{{$data->get('appointmentTime')}}</dd>
            <dt>内容</dt>
            <dd>
                <p>{{$data->get('content')}}</p>
            </dd>
        </dl>
        {{Form::open(['url'=>route('client.video-interview.cancel-execute',['interviewAppointmentId'=>$data->get("interviewAppointmentId")]), 'class'=>("cancelForm")])}}
        <dl class="invalid-form">
            <dt><label for="cancelMessage">キャンセルメッセージ</label></dt>
            <dd>
                {{Form::textarea('cancelMessage', $data->get("cancelMessage"), ["class" => (!empty($errors->has('cancelMessage')) ? "invalid-control width100" : "width100"), "id"=>"cancelMessage","cols"=>"30", "rows"=>"10", "placeholder" => "弊社都合で恐縮ですが、誠に勝手ながら今年度の採用人数を超えてしまいました。申し訳ございませんが、本面接予約はキャンセルとさせていただきます。", "maxlength" =>400])}}
                @include('client.common.input_error', ['errors' => $errors, 'targets' => ['cancelMessage']])
            </dd>
        </dl>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="{{$data->get("videoInterviewReservationDetailUrl")}}">
            <input type="submit" value="キャンセルする" class="cancel">
        </div>
        {{Form::close()}}
    </div>
@stop