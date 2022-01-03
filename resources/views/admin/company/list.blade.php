@extends('admin.common.root')

@section('title','企業一覧')

@section('content')
    <h1 class="content-title">企業一覧</h1>

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

    <async-search v-cloak id="company-search"
                  url="{{route("admin.company.search")}}"
                  :initial-search="true" @if($data->has("pager.index"))
                  :initial-page-index="{{$data->get("pager.index")}}" @endif>

        <div slot="condition-field" slot-scope="component">

            <div class="form-group row">
                <label for="companyName" class="col-form-label-lg col-sm-4 col-lg-2">会社名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyName ? 'invalid-form' : '']">
                    {{Form::text('companyName',$data->get("companyName"),["id"=>"companyName","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）株式会社infit",'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.companyName"])
                </div>
                <label for="companyStatus" class="col-form-label-lg col-sm-3 col-lg-2">ステータス</label>
                <div class="col-sm-9 col-lg-4">
                    @foreach($data->get("companyStatusList") as $value => $companyStatusLabel)
                        <div class="custom-control custom-checkbox custom-control-inline custom-control-lg col-xl-4 col-sm-4" v-bind:class="[component.errors.companyStatus ? 'invalid-form' : '']">
                            {{Form::checkbox("companyStatusList[$value]", $value, ($data->get("companyStatus") == $value) ? "checked='checked'": $value === "1",
                            ["id" => "companyStatus$value", "class" => "custom-control-input"])}}
                            <label for="companyStatus{{$value}}" class="custom-control-label">{{$companyStatusLabel}}</label>
                        </div>
                    @endforeach
                    <div v-bind:class="[component.errors.companyStatus ? 'invalid-form' : '']">
                        @include("admin.common.search_error",["target"=>"component.errors.companyStatus"])
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="companyNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会社名かな</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyNameKana ? 'invalid-form' : '']">
                    {{Form::text('companyNameKana',$data->get("companyNameKana"),["id"=>"companyNameKana","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）かぶしきがいしゃいんふぃっと",'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.companyNameKana"])
                </div>
                <label for="jobApplicationAvailableNumber" class="col-form-label-lg col-sm-3 col-lg-2">求人枠</label>
                <div class="col-sm-9 col-lg-4">
                    <div class="row align-items-center justify-content-start">
                        <div class="input-group col-11 col-sm-3 mb-2 mb-sm-0"
                             v-bind:class="[component.errors.minJobApplicationAvailableNumber ? 'invalid-form' : '']">
                            {{Form::select("minJobApplicationAvailableNumber", $data->get("jobApplicationAvailableNumberList"), $data->get("minJobApplicationAvailableNumber"), ['class'=>'form-control invalid-control form-control-lg border-right-0', "placeholder" => ""])}}
                        </div>
                        <div class="col-auto px-0">～</div>
                        <div class="input-group col-11 col-sm-3"
                             v-bind:class="[component.errors.maxJobApplicationAvailableNumber ? 'invalid-form' : '']">
                            {{Form::select("maxJobApplicationAvailableNumber", $data->get("jobApplicationAvailableNumberList"), $data->get("maxJobApplicationAvailableNumber"), ['class'=>'form-control invalid-control form-control-lg border-right-0', "placeholder" => ""])}}
                        </div>
                    </div>
                    <div v-bind:class="[component.errors.minJobApplicationAvailableNumber || component.errors.maxJobApplicationAvailableNumber ? 'invalid-form' : '']">
                        @include("admin.common.search_error",["target"=>"component.errors.minJobApplicationAvailableNumber"])
                        @include("admin.common.vue_input_error",["target"=>"component.errors.maxJobApplicationAvailableNumber"])
                    </div>
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
            @include('admin.common.create_button',["route"=>'admin.company.create'])
        </div>

        <div slot="result-field" slot-scope="component">
            <div v-if="component.searched">
                @include('admin.common.vue_pagination')
                <div v-if="component.hasResults" class="table-responsive-md my-3">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="tw-5">
                            <col class="tw-30">
                            <col class="tw-25">
                            <col class="tw-15">
                            <col class="tw-10">
                            <col class="tw-10">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">
                                企業名
                            </th>
                            <th scope="col">
                                連絡先電話番号
                            </th>
                            <th scope="col">
                                求人枠
                            </th>
                            <th scope="col">
                                公開求人数
                            </th>
                            <th scope="col">
                                ステータス
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="company in component.result.companies">
                            <td class="text-center">
                                @{{ company.id }}
                            </td>
                            <td>
                                <a v-bind:href="company.editUrl">
                                @{{ company.companyName }}
                                </a>
                            </td>
                            <td>
                                @{{ company.picPhoneNumber }}
                            </td>
                            <td>
                                @{{ company.jobApplicationAvailableNumber }}
                            </td>
                            <td>
                                @{{ company.publishJobApplication }}
                            </td>
                            <td>
                                @{{ company.status }}
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
    {{ Form::open(["url" => '#',"id" => "js-member-delete-form"])}}
    @include('admin.common.modals.delete_confirm_modal')
    {{ Form::close() }}
@stop
