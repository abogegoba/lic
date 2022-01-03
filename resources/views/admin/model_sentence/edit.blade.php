@extends('admin.common.root')

@section('title','例文変更')

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
    <h1 class="content-title">例文変更</h1>
    @include('admin.common.input_message_outside_frame')
    @if(session('success') === 'create')
        {{--登録完了モーダル--}}
        @include('admin.common.create_complete')
    @elseif(session('success') === 'edit')
        {{--変更完了モーダル--}}
        @include('admin.common.edit_complete')
    @endif

        <div style="margin-bottom: 2em;">
            <a href="{{route('admin.model-sentence.reload')}}">< 例文一覧に戻る</a>
        </div>

        {{Form::open(['url' => route('admin.model-sentence.edit',["modelSentenceId" => $data->get("modelSentenceId")])])}}

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
                <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#modal-delete">
                    <span>削除する</span>
                </button>
            </div>
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-edit">
                    <i class="fas fa-plus-circle icon icon-lg"></i>
                    <span>変更する</span>
                </button>
            </div>
        </div>

        <a href="{{route('admin.model-sentence.reload')}}">< 例文一覧に戻る</a>
    @include('admin.common.modals.edit_modal')
    @include('admin.common.modals.delete_confirm_modal')
        {{Form::close()}}
@stop

{{Form::open(['id' => 'js-delete-target-id', 'url' => route('admin.model-sentence.delete', ['modelSentenceId' => $data->get("modelSentenceId")])])}}
{{Form::close()}}

@section('js')
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