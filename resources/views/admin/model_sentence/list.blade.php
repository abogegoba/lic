@extends('admin.common.root')

@section('title','例文一覧')

@section('content')
    <h1 class="content-title">例文一覧</h1>

    @if(session('success') === 'delete')
        {{--削除完了モーダル--}}
        @include('admin.common.delete_complete')
    @endif

    <async-search v-cloak id="model-sentence-search"
                  url="{{route("admin.model-sentence.search")}}"
                  :initial-search="true" @if($data->get("pager.index"))
                  :initial-page-index="{{$data->get("pager.index")}}" @endif>

        <div slot="condition-field" slot-scope="component">
            <div class="form-group row">
                <label for="modelSentenceName" class="col-form-label-lg col-sm-3 col-lg-2">例文名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.modelSentenceName ? 'invalid-form' : '']">
                    {{Form::text('modelSentenceName',$data->get("modelSentenceName"),["id"=>"modelSentenceName", "class"=>"form-control invalid-control form-control-lg", "placeholder" => "例）面接希望メッセージ", "maxlength" =>32])}}
                    @include("admin.common.search_error",["target"=>"component.errors.modelSentenceName"])
                </div>
                <label for="typeList" class="col-form-label-lg col-sm-3 col-lg-2">例文種別</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.typeList ? 'invalid-form' : '']">
                    @foreach($data->get("typeList") as $value => $type)
                        <div class="custom-control custom-checkbox custom-control-inline custom-control-lg col-xl-4 col-sm-4">
                            {{Form::checkbox("modelSentenceType[$value]", $value, true, ["id" => "modelSentenceType_$value", "class" => "custom-control-input"])}}
                            @include("admin.common.search_error",["target"=>"component.errors.typeList"])
                            <label for=modelSentenceType_{{$value}} class="custom-control-label">{{$type}}</label>
                        </div>
                    @endforeach
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
            @include('admin.common.create_button',["route"=>'admin.model-sentence.create'])
        </div>

        <div slot="result-field" slot-scope="component">
            <div v-if="component.searched">
                @include('admin.common.vue_pagination')
                <div v-if="component.hasResults" class="table-responsive-md my-3">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="tw-10">
                            <col class="tw-20">
                            <col class="tw-20">
                            <col class="tw-50">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">例文種別</th>
                            <th scope="col">例文名</th>
                            <th scope="col">本文 </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="modelSentence in component.result.modelSentences">
                            <td class="text-center">@{{ modelSentence.id }}</td>
                            <td>@{{ modelSentence.type }}</td>
                            <td><a v-bind:href="modelSentence.editUrl">@{{ modelSentence.name }}</a></td>
                            <td>@{{ modelSentence.content }}</td>
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
@stop
@section('js')
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