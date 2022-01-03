@extends('admin.common.root')

@section('title','会員一覧')

@section('js')
    <script src="{{ asset('js/member/list.js') }}"></script>
    <script>
        $(function () {
            @if(session('success') === 'delete')
            $("#delete-complete").show();
            setTimeout(function () {
                $("#delete-complete").fadeOut(1500);
            }, 2000);
            @endif
        });
    </script>
@stop

@section('content')
    <h1 class="content-title">会員一覧</h1>

    @if(session('success') === 'delete')
        {{--削除完了モーダル--}}
        @include('admin.common.delete_complete')
    @endif
    @if(session('success') === 'edit')
        {{--変更完了モーダル--}}
        @include('admin.common.edit_complete')
    @endif
    @if(!empty($errors->get("business_exception")))
        @include("admin.common.input_error",["target"=>"business_exception"])
    @endif

    <async-search v-cloak id="member-search"
                  url="{{route("admin.member.search")}}"
                  :initial-search="true" @if($data->has("pager.index"))
                  :initial-page-index="{{$data->get("pager.index")}}" @endif>

        <div slot="condition-field" slot-scope="component">

            <div class="form-group row">
                <label for="memberName" class="col-form-label-lg col-sm-4 col-lg-2">会員名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberName ? 'invalid-form' : '']">
                    {{Form::text('memberName',$data->get("memberName"),["id"=>"memberName","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）陸 太郎", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.memberName"])
                </div>
                <label for="schoolName" class="col-form-label-lg col-sm-4 col-lg-2">学校名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.schoolName ? 'invalid-form' : '']">
                    {{Form::text('schoolName',$data->get("schoolName"),["id"=>"schoolName","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）東京大学",'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.schoolName"])
                </div>
            </div>

            <div class="form-group row">
                <label for="memberNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会員名かな</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberNameKana ? 'invalid-form' : '']">
                    {{Form::text('memberNameKana',$data->get("memberNameKana"),["id"=>"memberNameKana","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）りく たろう", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.memberNameKana"])
                </div>
                <label for="phoneNumber" class="col-form-label-lg col-sm-4 col-lg-2">連絡先電話番号</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.phoneNumber ? 'invalid-form' : '']">
                    {{Form::text('phoneNumber',$data->get("phoneNumber"),["id"=>"phoneNumber","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）0364449999",'maxlength' => 15])}}
                    @include("admin.common.search_error",["target"=>"component.errors.phoneNumber"])
                </div>
            </div>

            <div class="form-group row">
                <label for="memberNameKana" class="col-form-label-lg col-sm-4 col-lg-2">卒業年月</label>
                <div class="col-sm-9 col-lg-2" v-bind:class="[component.errors.graduationPeriodYear ? 'invalid-form' : '']">
                    {{Form::select('graduationPeriodYear', $data->get("yearList"), $data->get("graduationPeriodYear"),["id"=>"graduationPeriodYear","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"選択して下さい"])}}
                    @include("admin.common.search_error",["target"=>"component.errors.graduationPeriodYear"])
                </div>
                <div class="col-sm-9 col-lg-2" v-bind:class="[component.errors.graduationPeriodMonth ? 'invalid-form' : '']">
                    {{Form::select('graduationPeriodMonth', $data->get("monthList"), $data->get("graduationPeriodMonth"),["id"=>"graduationPeriodMonth","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"選択して下さい"])}}
                    @include("admin.common.search_error",["target"=>"component.errors.graduationPeriodMonth"])
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
            @include('admin.common.create_button',["route"=>'admin.member.create'])
        </div>

        <div slot="result-field" slot-scope="component">
            <div v-if="component.searched">
                @include('admin.common.vue_pagination')
                <div v-if="component.hasResults" class="table-responsive-md my-3">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="tw-5">
                            <col class="tw-25">
                            <col class="tw-25">
                            <col class="tw-15">
                            <col class="tw-15">
                            <col class="tw-15">
                            <col class="tw-5">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">
                                会員名
                            </th>
                            <th scope="col">
                                会員名かな
                            </th>
                            <th scope="col">
                                学校名
                            </th>
                            <th scope="col">
                                連絡先電話番号
                            </th>
                            <th scope="col">
                                ステータス
                            </th>
                            <th scope="col">
                                削除
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="member in component.result.members">
                            <td class="text-center">
                                @{{ member.id }}
                            </td>
                            <td>
                                <a v-bind:href="member.editUrl">
                                    @{{ member.memberName }}
                                </a>
                            </td>
                            <td>
                                @{{ member.memberNameKana }}
                            </td>
                            <td>
                                @{{ member.schoolName }}
                            </td>
                            <td>
                                @{{ member.phoneNumber }}
                            </td>
                            <td>
                                @{{ member.status }}
                            </td>
                            <td class="text-center cell-btn">
                                <button type="button" class="cell-btn-icon js-member-delete" data-toggle="modal" data-target="#modal-delete" v-bind:data-id="member.id">
                                    <i aria-hidden="true" class="iconfont iconfont-trash"></i>
                                </button>
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
    {{--削除確認モーダル--}}
    {{ Form::open(["url" => route("admin.member.delete", ["id" => "js-member-id"]), "id" => "js-member-delete-form"])}}
    @include('admin.common.modals.delete_confirm_modal')
    {{ Form::close() }}
@stop
