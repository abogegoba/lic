@extends('admin.common.root')

@section('title','企業別ビデオ通話一覧')

@section('content')
    <h1 class="content-title">企業別ビデオ通話一覧</h1>

    @if(!empty($errors->get("business_exception")))
        @include("admin.common.input_error",["target"=>"business_exception"])
    @endif

    <div style="margin-bottom: 2em;">
    <a href="{{route('admin.video-interview.reload')}}">< ビデオ通話履歴一覧に戻る</a>
    </div>

    <async-search v-cloak id="video-interview-company-search"
                  url="{{route("admin.video-interview.company.search")}}"
                  :initial-search="true" @if($data->has("pager.index"))
                  :initial-page-index="{{$data->get("pager.index")}}" @endif>

        <div slot="condition-field" slot-scope="component">

            <div class="form-group row">
                <label id="companyId" class="col-form-label-lg col-sm-4 col-lg-2">ＩＤ：</label>
                <div class="col-sm-9">
                    <label id="companyIdValue" class="col-form-label-lg">{{ $data->get("companyId") }}</label>
                    <input id="companyId" name="companyId" type="hidden" value="{{ $data->get("companyId") }}">
                </div>
            </div>

            <div class="form-group row">
                <label id="companyName" class="col-form-label-lg col-sm-4 col-lg-2">会社名：</label>
                <div class="col-sm-9">
                    <label id="companyNameValue" class="col-form-label-lg">{{ $data->get("companyName") }}</label>
                </div>
            </div>
        </div>

        <div slot="result-field" slot-scope="component">
            <div v-if="component.searched">
                ※ 通話分数は計測できた場合のみ数値が表示されます。ブラウザを閉じた場合など例外時は表示されません。
                @include('admin.common.vue_pagination')
                <div v-if="component.hasResults" class="table-responsive-md my-3">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="tw-5">
                            <col class="tw-15">
                            <col class="tw-20">
                            <col class="tw-10">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">
                                ID
                            </th>
                            <th scope="col">
                                開始日時
                            </th>
                            <th scope="col">
                                会員名
                            </th>
                            <th scope="col">
                                時間(分)
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="videoCallHistory in component.result.videoCallHistories">
                            <td class="text-center">
                                @{{ videoCallHistory.id }}
                            </td>
                            <td>
                                @{{ videoCallHistory.startDatetime }}
                            </td>
                            <td>
                                <a v-bind:href="videoCallHistory.memberListUrl">
                                @{{ videoCallHistory.memberName }}
                                </a>
                            </td>
                            <td>
                                @{{ videoCallHistory.callMinutes }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @include('admin.common.vue_pagination')
                <div v-if="!component.hasResults" class="alert alert-light no-data" role="alert">
                    検索結果はございません
                </div>
            </div>
        </div>
    </async-search>

    <a href="{{route('admin.video-interview.reload')}}">< ビデオ通話履歴一覧に戻る</a>

@stop