@extends('admin.common.root')

@section('title','メッセージ詳細')

@section('js')
    <script src="{{asset('js/message/status-edit.js')}}"></script>
@stop

@section('content')
    <h1 class="content-title">メッセージ詳細</h1>
    <div style="margin-bottom: 2em;">
    <a href="{{route('admin.message.reload')}}">< メッセージ一覧に戻る</a>
    </div>

    <p class="content-lead mb-0">
        会員 ： {{ $data->get("memberName") }} ／ 企業：{{ $data->get(("companyName")) }}
    </p>
    <div class="accordion message-detail">
        @foreach($data->get('exchangeMessageList') as $key => $list)
            <div class="card">
                <div class="card-header" data-toggle="collapse" data-target="#messageDetail{{$key}}">
                    <div class="d-flex align-items-center message-detail-header">
                        <div class="message-detail-icon rounded-circle">
                            <img src="{{ $list->get('thumbnail') }}" alt="サムネイル">
                        </div>
                        <div class="message-detail-user">
                            <div class="message-detail-name">
                                {{$list->get('name')}}
                            </div>
                            <div class="message-detail-date">
                                <span>
                                    {{$list->get('contributionDatetime')}}
                                </span>
                                @if($list->get('status') === 20)
                                    <span class="badge badge-secondary badge-lg">
                                        非公開
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="message-detail-btn">
                            <i class="fas fa-chevron-down fa-lg icon"></i>
                        </div>
                    </div>
                </div>

                <div id="messageDetail{{$key}}" class="collapse show">
                    <div class="card-body">
                        @if($list->get('status') === 20)
                            <button type="button" class="btn btn-primary message-detail-display js-message-status-update"
                                    data-toggle="modal" data-target="#modal-status-display" data-id="{{$list->get('id')}}" data-status="{{$list->get('status')}}">
                                表示する
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-primary message-detail-display js-message-status-update"
                                    data-toggle="modal" data-target="#modal-status-hide-display" data-id="{{$list->get('id')}}" data-status="{{$list->get('status')}}">
                                非表示にする
                            </button>
                        @endif
                        <div class="message-detail-body">
                            <p>{!!nl2br($list->get('content'))!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a href="{{route('admin.message.reload')}}">< メッセージ一覧に戻る</a>
    {{--モーダル読み込み--}}
    {{Form::open(["url" => route('admin.message.status',["memberUserAccountId" => $data->get("memberUserAccountId"), "companyUserAccountId" => $data->get("companyUserAccountId"),"messageId" => "js-message-id"]),
        "id" => "js-message-status-update-form"])}}
    @include('admin.common.modals.status_display')
    @include('admin.common.modals.status_hide_display')
    {{Form::close()}}
@stop
