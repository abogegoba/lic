@extends('front.common.root')

@section('description','会員登録：基本情報入力')

@section('title','メッセージ詳細│メッセージ一覧│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/message/common.css')}}">
@stop


@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>メッセージ詳細</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('front.common.mypage_menu')
    <header id="message__hdr" class="fullWidth">
        <div>
            <picture>
                <a href={{$data->get("companyDetailUrl")}}><img src="{{$data->get("companyLogoFilePath")}}" alt="企業ロゴ"></a>
            </picture>
            <h2 class="headline--xsmall flex--ctr">{{$data->get("name")}}</h2>
        </div>
    </header>
    <div class="main__content message-detail">
        @foreach($data->get('exchangeMessageList') as $key => $list)
            @if ($list->get('sendingUserAccountId') !== $data->get('loggedInUserAccountId') )
                <div class="chats chats--company">
                    <div class="round-img unread">
                        <picture>
                            <a href={{$data->get("companyDetailUrl")}}><img src="{{$list->get('companyLogo')}}" alt="企業ロゴ"></a>
                        </picture>
                    </div>

                    <div>
                        <p>{!!nl2br($list->get('content'))!!}</p>
                        <div class="chats__date">{{$list->get('contributionDatetime')}}</div>
                    </div>
                </div>
            @else
                <div class="chats chats--student">
                    <div>
                        <p>{!!nl2br($list->get('content'))!!}</p>
                        <div class="chats__date">{{$list->get('contributionDatetime')}}</div>
                    </div>
                </div>
            @endif
        @endforeach
        {{Form::open(['url'=>route('front.message.detail', ['userAccountId' => $data->get("companyUserAccountId")])])}}
        <div class="chats__form invalid-form">
            <div class="model_sentence">
                <label>例文：</label>
                <div class="selectBox__wrapper">
                    {{Form::select('modelSentenceName',$data->get("modelSentenceNameList"), $data->get("modelSentenceName"),["class" => (!empty($errors->has('modelSentenceName')) ? "invalid-control " : ""), "id"=>"modelSentenceName"])}}
                    @foreach($data->get("modelSentenceContentList") as $key => $content)
                        {{Form::hidden('modelSentenceContent',$content,['id'=>'modelSentenceContent_'.$key])}}
                    @endforeach
                </div>
                <button type="button" id="js_model_sentence_button" class="model_sentence_button">表示</button>
            </div>

            @if ($data->get("requestFlg") === true)
                {{Form::textarea('messageToSend', $data->get("request"), ["class" => "width100", "id"=>"messageToSend", "maxlength" => 400, "placeholder" => "メッセージを記入してください"])}}
            @else
                {{Form::textarea('messageToSend', '', ["class" => "width100", "id"=>"messageToSend", "maxlength" => 400, "placeholder" => "メッセージを記入してください"])}}
            @endif
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['messageToSend']])
            @include('front.common.business_error',['errors' => $errors, 'target' => 'can_not_send_message'])

            <div class="form__controls">
                <input type="submit" value="送信する">
            </div>
        </div>
        {{Form::close()}}
    </div>
@stop
@section('js')
    <script src="{{asset('js/message-detail/model-sentence.js')}}"></script>
@stop
