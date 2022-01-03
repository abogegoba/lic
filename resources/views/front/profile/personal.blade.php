@extends('front.common.root')

@section('title','個人情報│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（個人情報）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        @if($data->get("country") == 1)
            {{Form::open(['url'=>route('front.profile.personal.edit.store')])}}
        @else
            {{Form::open(['url'=>route('front.profile.personal.edit.overseas_store')])}}
        @endif
        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="name1">氏名</label></th>
                <td>
                    <div class="flex--bet">
                        {{Form::text('lastName', $data->get("lastName"), ["class" => (!empty($errors->has('lastName')) ? "invalid-control" : ""), "id"=>"name1","placeholder" => "例）陸", "maxlength" =>16])}}
                        {{Form::text('firstName', $data->get("firstName"), ["class" => (!empty($errors->has('firstName')) ? "invalid-control" : ""),"placeholder" => "例）太郎", "maxlength" =>16])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['lastName','firstName']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required">
                    <label for="kana1">
                        @if($data->get("country") == 1)
                            氏名(かな)
                        @else
                            氏名(カタカナ)
                        @endif
                    </label>
                </th>
                <td>
                    <div class="flex--bet">
                        {{Form::text('lastNameKana', $data->get("lastNameKana"), ["class" => (!empty($errors->has('lastNameKana')) ? "invalid-control" : ""), "id"=>"kana1","placeholder" => "例）りく", "maxlength" =>16])}}
                        {{Form::text('firstNameKana', $data->get("firstNameKana"), ["class" => (!empty($errors->has('firstNameKana')) ? "invalid-control" : ""),"placeholder" => "例）たろう", "maxlength" =>16])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['lastNameKana','firstNameKana']])
                </td>
            </tr>
            @if($data->get("country") > 1)
                <tr class="invalid-form">
                    <th><label for="englishName">English Name</label></th>
                    <td>
                        <div class="flex--bet">
                            {{Form::text('englishName', $data->get("englishName"), ["class" => (!empty($errors->has('englishName')) ? "invalid-control" : ""), "id"=>"englishName","placeholder" => "例）Riku Taro", "maxlength" =>32])}}
                        </div>
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['englishName']])
                    </td>
                </tr>
            @endif
            <tr class="invalid-form">
                <th class="required">
                    <label for="birthday">生年月日</label>
                    <span class="notice" style="display: inline">例)19910814</span>
                </th>
                <td>
                    {{Form::number('birthday', $data->get("birthday"), ["class" => (!empty($errors->has('birthday')) ? "invalid-control" : ""), "id"=>"birthday","placeholder" => "例）19910814", "maxlength" =>8])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['birthday']])
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
