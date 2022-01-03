@extends('front.common.root')

@section('title','語学・資格│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（語学・資格）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        {{Form::open(['url'=>route('front.profile.language.edit.store')])}}
        <table class="form__table">
            <tr class="invalid-form">
                <th><label for="toeicScore">TOEIC</label></th>
                <td>
                    {{Form::text('toeicScore', $data->get("toeicScore"), ["class" => (!empty($errors->has('toeicScore')) ? "invalid-control width100" : "width100"), "id"=>"toeicScore", "placeholder" => "例）456点","maxlength" =>3])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['toeicScore']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="toeflScore">TOEFL</label></th>
                <td>
                    {{Form::text('toeflScore', $data->get("toeflScore"), ["class" => (!empty($errors->has('toeflScore')) ? "invalid-control width100" : "width100"), "id"=>"toeflScore", "placeholder" => "例）234点","maxlength" =>3])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['toeflScore']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="certificationList[]">保有資格・検定など</label></th>
                <td>
                    <additional v-cloak id="licences" data="{{$data->toJsonQualifications($errors)}}" :max="10" class="licences-container" :initial-add="true">
                        <div slot="field" slot-scope="component" class="licences-wrap">
                            <div v-for="(certificationList, index) in component.data" class="licences">
                                {{Form::text('certificationList[]', null, ["v-model"=>"certificationList.certification", "class" => "width100","v-bind:class"=>"[certificationList.certificationListErrors||certificationList.certificationListsErrors? 'invalid-control':'']", "id"=>"certificationList","placeholder"=>"保有する資格をご記載ください。", "maxlength" =>32])}}
                                <button type="button" class="button remove" v-if="index !== 0" v-on:click="component.remove(index)">削除する</button>
                                @include('front.common.vue_input_error', ['target' => 'certificationList.certificationListErrors'])
                                @include('front.common.vue_input_error', ['target' => 'certificationList.certificationListsErrors'])
                                <div class="width100"></div>
                                <button type="button" class="button add" v-if="index +1 === component.data.length" v-on:click="component.add()" v-bind:disabled="!component.addable">最終行に追加する</button>
                            </div>
                        </div>
                    </additional>
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="{{route("front.profile")}}">
            <input type="submit" value="保存する" class="save">
        </div>
        {{Form::close()}}
    </div>
@stop
