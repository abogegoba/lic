@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','Web面接予約確認　｜　次世代型就活サイト　LinkT')

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
            <li>Web面接予約確認</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <div class="main__content">
        <h2 class="main__content__headline">Web面接予約登録</h2>
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
            <dd>{{$data->get("date")}}</dd>
            <dt>開始時間</dt>
            <dd>{{$data->get("time")}}</dd>
            <dt>内容</dt>
            <dd>
                <p>{{$data->get("content")}}</p>
            </dd>
        </dl>
        {{Form::open(['url'=>route('client.video-interview.execute',['userAccountId'=>$data->get("memberUserAccountId")])])}}
            <p class="confirmMessage">上記の内容で面接を予約します。よろしいですか？<br>面接を予約すると学生にお知らせのメールが送信されます。</p>
            <div class="form__controls">
                <input type="button" value="戻る" class="prev js-btn-link" data-href="{{$data->get("videoInterviewReviseUrl")}}">
                <input type="submit" value="面接を予約する" class="next">
            </div>
        {{Form::close()}}
    </div>
@stop