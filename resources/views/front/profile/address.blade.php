@extends('front.common.root')

@section('title','現住所・連絡先│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common_custom.css')}}">
@stop

@section('js')
    @if($data->get("country") == 1)
    <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
    <script>
        $(function () {
            $('#zipCode + .js-zipCode').on('click', function () {
                AjaxZip3.zip2addr('zipCode', '', 'prefecture', 'city');
                return false;
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
            <li>プロフィール変更入力（現在住所・連絡先）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        @if($data->get("country") == 1)
        {{Form::open(['url'=>route('front.profile.address.edit.store')])}}
        @else
        {{Form::open(['url'=>route('front.profile.address.edit.overseas_store')])}}
        @endif
        <table class="form__table">
            @if($data->get("country") > 1)
            <tr class="invalid-form">
                <th class="required"><label for="country">国籍</label></th>
                <td>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('country', $data->get("overseasList"),  $data->get("country"), ["class" => (!empty($errors->has('country')) ? "invalid-control" : ""), "id"=>"country", "placeholder" => '選択してください'])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['country']])
                </td>
            </tr>
            @endif
            <tr class="invalid-form">
                <th class="required"><label for="zipCode">郵便番号</label></th>
                <td>
                    {{Form::tel('zipCode', $data->get("zipCode"), ["class" => (!empty($errors->has('zipCode')) ? "invalid-control" : ""), "id"=>"zipCode","placeholder" => "例）1500021"])}}
                    @if($data->get("country") == 1)
                    <button class="button zip js-zipCode">住所を検索</button>
                    @endif
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['zipCode']])
                </td>
            </tr>
            @if($data->get("country") == 1)
            <tr class="invalid-form">
                <th class="required"><label for="prefecture">都道府県</label></th>
                <td>
                    <div class="selectBox__wrapper width100">
                        {{Form::select('prefecture', $data->get("prefectureList"), $data->get("prefecture"), ["class" => (!empty($errors->has('prefecture')) ? "invalid-control" : ""), "id"=>"prefecture", "placeholder" => "選択してください"])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['prefecture']])
                </td>
            </tr>
            @endif
            <tr class="invalid-form">
                <th class="required">
                    <label for="city">
                        @if($data->get("country") == 1)
                        市区町村
                        @else
                        住所
                        @endif
                    </label>
                </th>
                <td>
                    {{Form::text('city', $data->get("city"), ["class" => (!empty($errors->has('city')) ? "invalid-control width100" : "width100"), "id"=>"city", "placeholder" => '例）渋谷区',"maxlength" =>56])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['city']])
                </td>
            </tr>
            @if($data->get("country") == 1)
            <tr class="invalid-form">
                <th><label for="blockNumber">番地・建物名・部屋番号など</label></th>
                <td>
                    {{Form::text('blockNumber', $data->get("blockNumber"), ["class" => (!empty($errors->has('blockNumber')) ? "invalid-control width100" : "width100"), "id"=>"blockNumber", "placeholder" => '例）恵比寿西2-2-8 えびす第２ビル　2F',"maxlength" =>56])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['blockNumber']])
                    <p class="notice--red">
                        掲載企業には、市区町村までしか表示されません。<br>
                        番地・建物名・部屋番号は表示されないのでご安心ください。
                    </p>
                </td>
            </tr>
            @endif
            <tr class="invalid-form">
                <th class="required"><label for="phoneNumber">電話番号</label></th>
                <td>
                    {{Form::tel('phoneNumber', $data->get("phoneNumber"), ["class" => (!empty($errors->has('phoneNumber')) ? "invalid-control width100" : "width100"), "id"=>"phoneNumber", "placeholder" => '例）0364449999',"maxlength" =>15])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['phoneNumber']])
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
