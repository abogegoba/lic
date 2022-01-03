@extends('front.common.root')

@section('title','志望情報入力│会員登録｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/entry/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/entry/index4.css')}}">
@stop

@section('content')
    <header id="main__hdr">
        <img src="{{asset('img/entry/icon_title_entry04.png')}}" alt="志望情報入力">
        <div>
            <h1>志望情報入力</h1>
            <p>志望する業種や勤務地を入力してください。</p>
        </div>
    </header>
    <div id="main__content">
        {{Form::open(['url'=>route('front.member-entry.four-next')])}}
        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="industry1">志望業種</label></th>
                <td>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('industry1', $data->get("businessTypeList"), $data->get("industry1"), ["class" => (!empty($errors->has('industry1')) ? "invalid-control" : ""), "id"=>"industry1","placeholder" => "選択してください"])}}
                    </div>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('industry2', $data->get("businessTypeList"), $data->get("industry2"), ["class" => (!empty($errors->has('industry2')) ? "invalid-control" : ""), "id"=>"industry2","placeholder" => "選択してください"])}}
                    </div>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('industry3', $data->get("businessTypeList"), $data->get("industry3"), ["class" => (!empty($errors->has('industry3')) ? "invalid-control" : ""), "id"=>"industry3","placeholder" => "選択してください"])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['industry1','industry2','industry3']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="location1">志望勤務地</label></th>
                <td>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('location1', $data->get("prefectureList"), $data->get("location1"), ["class" => (!empty($errors->has('location1')) ? "invalid-control" : ""), "id"=>"location1","placeholder" => "選択してください"])}}
                    </div>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('location2', $data->get("prefectureList"), $data->get("location2"), ["class" => (!empty($errors->has('location2')) ? "invalid-control" : ""), "id"=>"location2","placeholder" => "選択してください"])}}
                    </div>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('location3', $data->get("prefectureList"), $data->get("location3"), ["class" => (!empty($errors->has('location3')) ? "invalid-control" : ""), "id"=>"location3","placeholder" => "選択してください"])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['location1','location2','location3']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="intern">インターン</label></th>
                <td>
                    {{Form::checkbox('intern', 1, !empty($data->get("intern"))? $data->get("intern"):"checked", ["class" => (!empty($errors->has('intern')) ? "invalid-control" : ""), "id"=>"intern"])}}
                    <label for="intern">希望する</label>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['intern']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="recruitInfo">就活イベントやその他就職活動に関 する情報取得について</label></th>
                <td>
                    {{Form::checkbox('recruitInfo', 1, !empty($data->get("recruitInfo"))? $data->get("recruitInfo"):"checked", ["class" => (!empty($errors->has('recruitInfo')) ? "invalid-control" : ""), "id"=>"recruitInfo"])}}
                    <label for="recruitInfo">希望する</label>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['recruitInfo']])
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="form__controls__prev js-btn-link" data-href="{{route('front.member-entry.revise-three')}}">
            <input type="submit" value="次に進む" class="form__controls__next">
        </div>
        {{Form::close()}}
    </div>
@stop
