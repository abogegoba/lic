@extends('front.common.root')

@section('title','学校情報│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('js')
    @if($data->get("country") > 1)
    <script>
        $(document).ready(function(){
            $("#facultyType").change(function(){
                var departmentName = $("#facultyType option:selected").text();
                $('#departmentName').val(departmentName);
            });
        });
    </script>
    @endif
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（学校情報）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        @if($data->get("country") == 1)
        {{Form::open(['url'=>route('front.profile.school.edit.store')])}}
        @else
        {{Form::open(['url'=>route('front.profile.school.edit.overseas_store')])}}
        @endif
            <table class="form__table">
                <tr class="invalid-form">
                    <th class="required"><label for="schoolType">学校種別</label></th>
                    <td>
                        <div class="selectBox__wrapper width75">
                            {{Form::select('schoolType', $data->get("schoolTypeList"), $data->get("schoolType"), ["class" => (!empty($errors->has('schoolType')) ? "invalid-control" : ""), "id"=>"schoolType","placeholder" => "選択してください"])}}
                        </div>
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['schoolType']])
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="name">学校名</label></th>
                    <td>
                        {{Form::text('name', $data->get("name"), ["class" => (!empty($errors->has('name')) ? "invalid-control width100" : "width100"), "id"=>"name", "placeholder" => "例）東京大学","maxlength" =>($data->get("country") == 1)?24:72])}}
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['name']])
                    </td>
                </tr>
                @if($data->get("country") == 1)
                <tr class="invalid-form">
                    <th class="required"><label for="departmentName">学部・学科名</label></th>
                    <td>
                        {{Form::text('departmentName', $data->get("departmentName"), ["class" => (!empty($errors->has('departmentName')) ? "invalid-control width100" : "width100"), "id"=>"departmentName", "placeholder" => "例）経済学部経済学科","maxlength" =>24])}}
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['departmentName']])
                    </td>
                </tr>
                @else
                {{Form::hidden('departmentName', $data->get("departmentName"), ["class" => (!empty($errors->has('departmentName')) ? "invalid-control width100" : "width100"), "id"=>"departmentName", "placeholder" => "例）経済学部経済学科", "maxlength" =>72])}}
                @endif
                <tr class="invalid-form">
                    <th class="required">
                        <label for="facultyType">
                            @if($data->get("country") == 1)
                            学部系統
                            @else
                            学部名
                            @endif
                        </label>
                    </th>
                    <td>
                        <div class="selectBox__wrapper width100">
                        {{Form::select('facultyType', $data->get("facultyTypeList"), $data->get("facultyType"), ["class" => (!empty($errors->has('facultyType')) ? "invalid-control width100" : "width100"), "id"=>"facultyType","placeholder" => "選択してください"])}}
                        </div>
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['facultyType']])
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="year">卒業年月</label></th>
                    <td>
                        <div class="flex--bet">

                            <div class="selectBox__wrapper width45">
                                {{Form::select('graduationPeriodYear', $data->get("yearList"), $data->get("graduationPeriodYear"), ["class" => ((!empty($errors->has('graduationPeriodYear'))|| !empty($errors->get("business_exception")['business.cant_store_graduation_period'])) ? "invalid-control" : ""), "id"=>"graduationPeriodYear","placeholder" => "選択してください"])}}
                            </div>
                            <div class="selectBox__wrapper width45">
                                {{Form::select('graduationPeriodMonth', $data->get("monthList"), $data->get("graduationPeriodMonth")? $data->get("graduationPeriodMonth"):"3", ["class" => ((!empty($errors->has('graduationPeriodMonth'))|| !empty($errors->get("business_exception")['business.cant_store_graduation_period'])) ? "invalid-control" : ""), "id"=>"graduationPeriodMonth" ,"placeholder" => "選択してください"])}}
                            </div>
                        </div>
                        @include('front.common.business_error', ['errors'=>$errors, 'target'=>'cant_store_graduation_period'])
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['graduationPeriodYear','graduationPeriodMonth']])
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
