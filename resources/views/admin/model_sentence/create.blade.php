@extends('admin.common.root')

@section('title','例文登録')

@section('css')
    <style>
        .display-company-data {
            margin-top: 10px;
        }
        .can-not-recruiting-create {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
@stop

@section('content')
    <h1 class="content-title">例文登録</h1>
    @include('admin.common.input_message_outside_frame')

        <div style="margin-bottom: 2em;">
            <a href="{{route('admin.model-sentence.reload')}}">< 例文一覧に戻る</a>
        </div>

        {{Form::open(['url' => route('admin.model-sentence.create')])}}

        @include('admin.model_sentence.parts.input')
        <div class="can-not-recruiting-create">
            @include('admin.common.business_error', ['errors' => $errors, 'target' => 'can_not_recruiting_create'])
        </div>
        <div class="btn-row btn-row" style="margin-bottom: 2em;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-secondary btn-lg js-btn-link" data-href="{{route("admin.model-sentence.reload")}}">
                    <i class="iconfont iconfont-times-circle icon-lg" aria-hidden="true"></i>
                    <span>キャンセルする</span>
                </button>
            </div>
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-create">
                    <i class="iconfont iconfont-plus-circle icon-lg" aria-hidden="true"></i>
                    <span>登録する</span>
                </button>
            </div>
        </div>

        <a href="{{route('admin.model-sentence.reload')}}">< 例文一覧に戻る</a>
        @include('admin.common.modals.create_modal')
        {{Form::close()}}
@stop
