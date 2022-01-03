@extends('admin.common.root')

@section('title','ビデオ通話履歴一覧')

@section('content')
    <h1 class="content-title">ビデオ通話履歴一覧</h1>

    @if(!empty($errors->get("business_exception")))
        @include("admin.common.input_error",["target"=>"business_exception"])
    @endif

    <async-search v-cloak id="video-interview-search"
                  url="{{route("admin.video-interview.search")}}"
                  :initial-search="true" @if($data->has("pager.index"))
                  :initial-page-index="{{$data->get("pager.index")}}" @endif>

        <div slot="condition-field" slot-scope="component">

            <div class="form-group row">
                <label for="companyName" class="col-form-label-lg col-sm-4 col-lg-2">会社名：</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyName ? 'invalid-form' : '']">
                    {{Form::text('companyName',$data->get("companyName"),["id"=>"companyName","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.companyName"])
                </div>
                <label for="memberName" class="col-form-label-lg col-sm-4 col-lg-2">会員名：</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberName ? 'invalid-form' : '']">
                    {{Form::text('memberName',$data->get("memberName"),["id"=>"memberName","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.memberName"])
                </div>
            </div>

            <div class="form-group row">
                <label for="companyNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会社名かな：</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyNameKana ? 'invalid-form' : '']">
                    {{Form::text('companyNameKana',$data->get("companyNameKana"),["id"=>"companyNameKana","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.companyNameKana"])
                </div>
                <label for="memberNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会員名かな：</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberNameKana ? 'invalid-form' : '']">
                    {{Form::text('memberNameKana',$data->get("memberNameKana"),["id"=>"memberNameKana","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.memberNameKana"])
                </div>
            </div>

            <div class="btn-row mb-5">
                <div class="btn-col btn-row-sm">
                    <button type="button" v-on:click="component.search" class="btn btn-lg btn-primary">
                        <i aria-hidden="true" class="iconfont iconfont-search icon-xl"></i>
                        <span>検索する</span>
                    </button>
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
                            <col class="tw-30">
                            <col class="tw-20">
                            <col class="tw-15">
                            <col class="tw-10">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">
                                ID
                            </th>
                            <th scope="col">
                                会社名
                            </th>
                            <th scope="col">
                                会員名
                            </th>
                            <th scope="col">
                                開始日時
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
                                <a v-bind:href="videoCallHistory.companyListUrl">
                                    @{{ videoCallHistory.companyName }}
                                </a>
                            </td>
                            <td>
                                <a v-bind:href="videoCallHistory.memberListUrl">
                                @{{ videoCallHistory.memberName }}
                                </a>
                            </td>
                            <td>
                                @{{ videoCallHistory.startDatetime }}
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
@stop