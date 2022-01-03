@extends('client.common.root')

@section('title','メッセージ詳細｜メッセージ一覧｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/message/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/message/common_custom.css')}}">
@stop

@section('vue')
    <script src="{{asset('js/message/detail_vue.js')}}"></script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.student.list')}}">マイページ</a></li>
            <li>メッセージ詳細</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')

    <header id="message__hdr" class="fullWidth">
        <div>
            <picture>
                <a href={{$data->get("studentDetailUrl")}}><img src="{{$data->get('privateImage')}}" alt="プライベート写真"></a>
            </picture>
            <h2 class="headline--xsmall flex--ctr">{{$data->get("memberName")}}</h2>
        </div>
    </header>
    <div v-cloak class="main__content message-detail">
        @foreach($data->get('exchangeMessageList') as $key => $list)
            @if ($list->get('sendingUserAccountId') !== $data->get('loggedInUserAccountId') )
                <div class="chats chats--company">
                    <div class="round-img unread">
                        <picture>
                            <a href={{$data->get("studentDetailUrl")}}><img src="{{$list->get('idImage')}}" alt="証明写真"></a>
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
        {{Form::open(['url'=>route('client.message.detail', ['userAccountId' => $data->get("memberUserAccountId")])])}}
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
            {{Form::textarea('messageToSend',  '', ["class" => "width100", "id"=>"messageToSend", "maxlength" => 400, "placeholder" => "メッセージを記入してください"])}}
            @include("client.common.input_error",['errors' => $errors, 'targets' => ['messageToSend']])
            <div class="form__controls">
                <input type="submit" value="送信する">
            </div>
        </div>
        {{Form::close()}}
        <form action="{{$data->get("videoInterviewEntryUrl")}}" class="interview__form">
            <button class="button interview" type="submit">面接を予約する</button>
        </form>
    </div>

@stop
@section('js')
    <script src="{{asset('js/message-detail/model-sentence.js')}}"></script>
@stop
