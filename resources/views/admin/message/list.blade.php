@extends('admin.common.root')

@section('title','メッセージ一覧')

@section('content')
    <h1 class="content-title">メッセージ一覧</h1>

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
                  url="{{route("admin.message.search")}}"
                  :initial-search="true" @if($data->get("pager.index"))
                  :initial-page-index="{{$data->get("pager.index")}}" @endif>

            <div slot="condition-field" slot-scope="component">
                <div class="form-group row">
                    <label for="companyName" class="col-form-label-lg col-sm-3 col-lg-2">会社名</label>
                    <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyName ? 'invalid-form' : '']">
                        {{Form::text('companyName',$data->get("companyName"),["id"=>"companyName", "class"=>"form-control invalid-control form-control-lg", "placeholder" => "例）株式会社infit", "maxlength" =>255])}}
                        @include("admin.common.search_error",["target"=>"component.errors.companyName"])
                    </div>
                    <label for="status" class="col-form-label-lg col-sm-3 col-lg-2">ステータス</label>
                    <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.statusList ? 'invalid-form' : '']">
                        @foreach($data->get("statusList") as $value => $status)
                            <div class="custom-control custom-checkbox custom-control-inline custom-control-lg col-xl-4 col-sm-4">
                                {{Form::checkbox("status[$value]", $value, "", ["id" => "status_$value", "class" => "custom-control-input"])}}
                                @include("admin.common.search_error",["target"=>"component.errors.statusList"])
                                <label for=status_{{$value}} class="custom-control-label">{{$status}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-form-label-lg col-sm-3 col-lg-2">会員名</label>
                    <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.name ? 'invalid-form' : '']">
                        {{Form::text('name',$data->get("name"),["id"=>"name", "class"=>"form-control invalid-control form-control-lg", "placeholder" => "例）後藤 剛志", "maxlength" =>255])}}
                        @include("admin.common.search_error",["target"=>"component.errors.name"])
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
                @include('admin.common.vue_pagination')
                <div v-if="component.hasResults" class="table-responsive-md my-3">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="tw-5">
                            <col class="tw-15">
                            <col class="tw-15">
                            <col class="tw-25">
                            <col class="tw-10">
                            <col class="tw-5">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">送信元</th>
                            <th scope="col">送信先</th>
                            <th scope="col">メッセージ </th>
                            <th scope="col">送信日時</th>
                            <th scope="col">ステータス</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="message in component.result.messages">
                            <td class="text-center">@{{ message.id }}</td>
                            <td>@{{ message.sendingName }}</td>
                            <td>@{{ message.receivingName }}</td>
                            <td><a v-bind:href="message.detailUrl">@{{ message.content }}</a></td>
                            <td>@{{ message.contributionDatetime }}</td>
                            <td  class="text-center">@{{ message.status }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @include('admin.common.vue_pagination')
                <div v-if="!component.hasResults" class="alert-light no-data" role="alert">
                    検索結果はございません。
                </div>
            </div>
        </div>
    </async-search>
    {{--削除確認モーダル--}}
    {{ Form::open(["url" => '#',"id" => "js-member-delete-form"])}}
    @include('admin.common.modals.delete_confirm_modal')
    {{ Form::close() }}
@stop