@extends('client.common.root')

@section('title','メッセージ詳細｜メッセージ一覧｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/message/common_new.css')}}">
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
    @if(!empty($data->get('exchangeUserAccountInformationList')))
        <header id="message__hdr" class="message_list">
            <div>
                <a id="message_list" data-openmodal="message_list_modal" class="message_list_modal">メッセージ一覧を開く</a>
            </div>
            @if(!empty($data->get('messageSendToName')))
                <div>{{$data->get('messageSendToName')}}</div>
            @endif
        </header>
    @endif
    <div class="message-detail">
        <div id="message_history">
            @if($data->get('exchangeMessageList'))
                @foreach($data->get('exchangeMessageList') as $key => $list)
                    @if ($list->get('sendingUserAccountId') !== $data->get('loggedInUserAccountId') )
                        <div class="chats chats--company">
                            <div class="round-img">
                                <picture>
                                    <a href={{$data->get("studentDetailUrl")}}><img src="{{$list->get('idImage')}}" alt="証明写真"></a>
                                </picture>
                            </div>

                            <i class="fa fa-play fa-rotate-180" aria-hidden="true"></i>
                            <div class="company_bubble">
                                <p>{!!nl2br($list->get('content'))!!}</p>
                                <div class="chats__date">{{date('Y/m/d H:i',strtotime($list->get('contributionDatetime')))}}</div>
                            </div>
                        </div>
                    @else
                        <div class="chats chats--student">
                            <div class="student_bubble">
                                <p>{!!nl2br($list->get('content'))!!}</p>
                                <div class="chats__date">
                                    {{date('Y/m/d H:i',strtotime($list->get('contributionDatetime')))}}
                                    <span class="delete_msg" id="delete_{{$list->get('id')}}" data-id="{{$list->get('id')}}" data-status="{{$list->get('status')}}" data-openmodal="delete_modal" class="delete_modal"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </div>
                    @endif
                @endforeach
                @else
                <div class="chats chats--company">
                    <div class="round-img bgw">
                        <picture>
                            <img src="{{asset('img/mypage/message/system_company_logo.png')}}" alt="LinkT">
                        </picture>
                    </div>

                    <i class="fa fa-play fa-rotate-180" aria-hidden="true"></i>
                    <div class="company_bubble">
                        <p>メッセージエリア左上の「メッセージ一覧を開く」をクリックして、メッセージ相手を選択してください。
                        <br>
                        <br>
                        ※まだ誰ともメッセージがない場合は表示されません。</p>
                    </div>
                </div>
            @endif
        </div>
        @if($data->get('exchangeMessageList'))
        <div id="message_send">
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
                <div class="model_sentence">
                    {{Form::textarea('messageToSend',  '', ["id"=>"messageToSend", "maxlength" => 400, "placeholder" => "メッセージを記入してください"])}}
                    <button type="submit" class="model_sentence_button">送信</button>
                    {{--<div class="model_sentence_button">
                        <input type="submit" value="送信">
                    </div>--}}
                    @include("client.common.input_error",['errors' => $errors, 'targets' => ['messageToSend']])
                </div>
            </div>
            {{Form::close()}}
            <form action="{{$data->get("videoInterviewEntryUrl")}}" class="interview__form">
                <button class="button interview" type="submit">Web面接を予約する</button>
            </form>
        </div>
        @endif
    </div>
    <div class="modalwindow" id="delete_modal">
        <div class="body" id="custome_delete_modal_design">
            <div class="main">
                <h2>メッセージを削除しますか？</h2>

                <button id="delete_cancle" data-closemodal="delete_modal">キャンセル</button>
                <button id="delete_ok">削除</button>
            </div>
        </div>
    </div>
    <div
        class="modalwindow"
        id="message_list_modal"
        data-data="{{json_encode($data->get('exchangeUserAccountInformationList'))}}"
        data-logged-in-user-account-id="{{$data->get("loggedInUserAccountId")}}"
        >
        <div v-if="exchangeUserAccountInformationList.length > 0" class="body" id="custome_message_list_modal_design">
            <div class="main">
                <div class="header">
                    <input class="filter" v-model="filterWord" placeholder="学生名で検索" maxlength="255">
                    <img class="sort" data-openmodal="sort_modal" src="{{asset('img/mypage/message/sort.png')}}" alt="sort">
                    <img class="close" data-closemodal="message_list_modal" src="{{asset('img/mypage/message/close.png')}}" alt="close">
                </div>
                <div v-cloak class="articles">
                    <article v-for="exchangeUserAccountInformation in displayExchangeUserAccountInformationList" class="message js-link-area cursor-pointer" :data-href="exchangeUserAccountInformation.messageDetailUrl">
                        <div class="round-img">
                            <picture>
                                <img :src="exchangeUserAccountInformation.idImage" alt="証明写真">
                            </picture>
                        </div>
                        <section class="message__body">
                            <h3>@{{ exchangeUserAccountInformation.memberName }}</h3>
                            <p>@{{ exchangeUserAccountInformation.content }}</p>
                        </section>
                        <footer>
                            <div class="message__date">@{{ exchangeUserAccountInformation.contributionDatetime }}</div>
                            <div v-if="exchangeUserAccountInformation.unreadCount" class="message__unRead">
                                @{{ exchangeUserAccountInformation.unreadCount }}
                            </div>
                        </footer>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <div class="modalwindow" id="sort_modal">
        <div class="body" id="custome_sort_modal_design">
            <div class="main">
                <div>
                    <button data-closemodal="sort_modal" @click="sortByRecieved(false)">受信時間 (降順)</button>
                </div>
                <div>
                    <button data-closemodal="sort_modal" @click="sortByRecieved(true)">受信時間 (昇順)</button>
                </div>
                <div>
                    <button data-closemodal="sort_modal" @click="sortByAlreadyRead">未読</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{asset('js/message-detail/model-sentence.js')}}"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.delete_msg').click(function(){
                var that = $(this);
                $('#delete_ok').attr('msg_id',that.data('id'));
            });
            $('#delete_ok').click(function(){
                var data = {
                    'id' : $('#delete_ok').attr('msg_id'),
                    'status' : 20,
                    'sending_user_account_id' : parseInt('{{$data->get('loggedInUserAccountId')}}'),
                    'receiving_user_account_id' : parseInt('{{$data->get('memberUserAccountId')}}'),
                }

                $.ajax({
                    type: "POST",
                    url: '{!! route('client.message.delete-message') !!}',
                    data: data,
                    cache: false,
                    success: (data) => {
                        if(data == 1){
                            location.reload();
                        }else{
                            alert('something wrong');
                            location.reload();
                        }
                    }
                });
            });

            $('#delete_cancle').click(function(){
                $('#delete_ok').removeAttr('msg_id','');
            })
        })
    </script>
@stop
