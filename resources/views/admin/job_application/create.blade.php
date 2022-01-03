@extends('admin.common.root')

@section('title','求人登録')

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
    <h1 class="content-title">求人登録</h1>
    @include('admin.common.input_message_outside_frame')
    <main class="col-12 col-md-9 col-xl-10 main-content">

        <div style="margin-bottom: 2em;">
            <a href="{{route('admin.jobApplication.list.reload')}}">< 求人一覧に戻る</a>
        </div>

        {{Form::open(['url' => route('admin.job-application.create')])}}

        @include('admin.job_application.parts.input', ['viewType' => 'create'])
        <div class="can-not-recruiting-create">
            @include('admin.common.business_error', ['errors' => $errors, 'target' => 'can_not_recruiting_create'])
        </div>
        <div class="btn-row btn-row" style="margin-bottom: 2em;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-create">
                    <i class="iconfont iconfont-plus-circle icon-lg" aria-hidden="true"></i>
                    <span>登録する</span>
                </button>
            </div>
        </div>

        <a href="{{route('admin.jobApplication.list.reload')}}">< 求人一覧に戻る</a>
        @include('admin.common.modals.create_modal')
        {{Form::close()}}
    </main>
@stop

@section('js')
    <script src="{{ asset('js/job_application/input.js') }}"></script>
@stop