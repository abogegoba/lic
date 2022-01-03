@extends('admin.common.root')

@section('title','予約登録')

@section('js')
    <script src="{{ asset('js/datetime-picker.js') }}"></script>
@stop

@section('vue')
    <script src="{{ asset('js/interview-appointment/input_vue.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
@stop

@section('content')
    <h1 class="content-title">予約登録</h1>

    <div style="margin-bottom: 2em;">
        <a href="{{route('admin.interview-appointment.reload')}}">< 予約一覧に戻る</a>
    </div>

    {{Form::open(['url'=>route('admin.interview-appointment.create')])}}

    @include('admin.interview_appointment.parts.input')
    <div class="btn-row btn-row" style="margin-bottom: 2em;">
        <div class="btn-col btn-row-sm">
            <button type="button" class="btn btn-secondary btn-lg js-btn-link" data-href="{{route("admin.interview-appointment.reload")}}">
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

    <a href="{{route('admin.interview-appointment.reload')}}">< 予約一覧に戻る</a>

    {{Form::close()}}
    @include('admin.common.modals.create_modal')
@stop