@extends('admin.common.root')

@section('title','求人変更')

@section('css')
    <style>
        .display-company-data {
            margin-top: 10px;
        }
    </style>
@stop

@section('content')
    @include('admin.common.input_message_outside_frame')
    <main class="col-12 col-md-9 col-xl-10 main-content">
        {{Form::open(['url' => route('admin.job-application.edit', ['jobApplicationId'=>$data->get('jobApplication.id')])])}}

        <h1 class="content-title">求人変更</h1>
        @if(session('success') === 'create')
            {{--登録完了モーダル--}}
            @include('admin.common.create_complete')
        @endif
        @if(session('success') === 'edit')
            {{--変更完了モーダル--}}
            @include('admin.common.edit_complete')
        @endif
        <a href="{{route('admin.jobApplication.list.reload')}}">< 求人一覧に戻る</a>

        <div class="btn-row btn-row" style="text-align: right;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg js-btn-target-blank" data-href="{{route('admin.job-application.preview', ['jobApplicationId'=>$data->get('company.id')])}}">
                    <span>プレビューする</span>
                </button>
            </div>
        </div>

        @include('admin.job_application.parts.input', ['viewType' => 'edit'])
        <div class="btn-row btn-row" style="margin-bottom: 2em;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-edit">
                    <i class="fas fa-plus-circle icon icon-lg"></i>
                    <span>変更する</span>
                </button>
            </div>
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#modal-delete">
                    <span>削除する</span>
                </button>
            </div>
        </div>

        <a href="{{route('admin.jobApplication.list.reload')}}">< 求人一覧に戻る</a>
        @include('admin.common.modals.edit_modal')
        @include('admin.common.modals.delete_confirm_modal')
        {{Form::close()}}
    </main>
@stop

{{Form::open(['id' => 'js-delete-target-id', 'url' => route('admin.jobApplication.delete', ['jobApplicationId' => $data->get('jobApplication.id')])])}}
{{Form::close()}}

@section('js')
    <script src="{{ asset('js/job_application/input.js') }}"></script>
    <script>
        $(function () {
            @if(session('success') === 'create')
            $("#create-complete").show();
            setTimeout(function () {
                $("#create-complete").fadeOut(1500);
            }, 2000);
            @elseif(session('success') === 'edit')
            $("#edit-complete").show();
            setTimeout(function () {
                $("#edit-complete").fadeOut(1500);
            }, 2000);
            @endif

            /**
             * ボタンリンク（別タブ表示）
             */
            $(document).on('click', '.js-btn-target-blank', function () {
                var href = $(this).data('href');
                window.open(href);
            });
        });
    </script>
@stop