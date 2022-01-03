@extends('front.common.root')

@section('description','会員登録：基本情報入力')

@section('title','経歴│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（経歴）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        {{Form::open(['url'=>route('front.profile.career.edit.store')])}}

        <table class="form__table" v-cloak>
            <tr class="invalid-form">
                <th><label for="year">学歴・経歴</label></th>
                <td>
                    <additional v-cloak id="careers" data="{{$data->toJsonCareers($errors)}}" :max="20" :initial-add="true">
                        <div slot="field" slot-scope="component">
                            <div v-for="(career,index) in component.data" class="career">
                                <div v-if='career.periodYear' class="selectBox__wrapper width45">
                                    {{Form::select('periodYears[]', $data->get("yearList"), '', ["v-model"=>"career.periodYear","class" => "width100","v-bind:class"=>"[career.periodYearErrors||career.periodYearsErrors? 'invalid-control':'']", "id"=>"periodYear"])}}
                                </div>
                                <div v-else class="selectBox__wrapper width45">
                                    {{Form::select('periodYears[]', $data->get("yearList"), '', ["class" => "width100","v-bind:class"=>"[career.periodYearErrors||career.periodYearsErrors? 'invalid-control':'']", "id"=>"periodYear"])}}
                                </div>

                                <div v-if='career.periodMonth' class="selectBox__wrapper width45">
                                    {{Form::select('periodMonths[]', $data->get("monthList"), '', ["v-model"=>"career.periodMonth", "class" => "width100","v-bind:class"=>"[career.periodMonthErrors||career.periodMonthsErrors? 'invalid-control':'']", "id"=>"periodMonth"])}}
                                </div>
                                <div v-else class="selectBox__wrapper width45">
                                    {{Form::select('periodMonths[]', $data->get("monthList"), '', [ "class" => "width100","v-bind:class"=>"[career.periodMonthErrors||career.periodMonthsErrors? 'invalid-control':'']", "id"=>"periodMonth"])}}
                                </div>

                                {{Form::text('names[]', null, ["v-model"=>"career.name", "class" => "width100","v-bind:class"=>"[career.nameErrors||career.namesErrors? 'invalid-control':'']", "id"=>"name","placeholder"=>"例）明治大学付属明治高等学校　卒業", "maxlength" =>32])}}
                                @include('front.common.vue_input_error', ['target' => 'career.periodYearErrors'])
                                @include('front.common.vue_input_error', ['target' => 'career.periodYearsErrors'])
                                @include('front.common.vue_input_error', ['target' => 'career.periodMonthErrors'])
                                @include('front.common.vue_input_error', ['target' => 'career.periodMonthsErrors'])
                                @include('front.common.vue_input_error', ['target' => 'career.nameErrors'])
                                @include('front.common.vue_input_error', ['target' => 'career.namesErrors'])
                                <button type="button" class="button add" v-if="index +1 === component.data.length" v-on:click="component.add()" v-bind:disabled="!component.addable">最終行に追加する</button>
                                <button type="button" class="button remove" v-if="index !== 0" v-on:click="component.remove(index)">削除する</button>
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
