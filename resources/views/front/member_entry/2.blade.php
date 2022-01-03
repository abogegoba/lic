@extends('front.common.root')

@section('title','現住所・連絡先入力│会員登録｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/entry/common.css')}}">
@stop

@section('js')
    <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
    <script>
        $(function () {
            $('#zipCode + .js-zipCode').on('click', function () {
                AjaxZip3.zip2addr('zipCode', '', 'prefecture', 'city');
                return false;
            });
        });　 　
    </script>
@stop

@section('content')
    <header id="main__hdr">
        <img src="{{asset('img/entry/icon_title_entry02.png')}}" alt="現住所・連絡先入力">
        <div>
            <h1>現住所・連絡先入力</h1>
            <p>ご住所と日中の連絡先をご入力ください。</p>
        </div>
    </header>
    <div id="main__content">
        {{Form::open(['url'=>route('front.member-entry.two-next')])}}
        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="zipCode">郵便番号</label></th>
                <td>
                    {{Form::tel('zipCode', $data->get("zipCode"), ["class" => (!empty($errors->has('zipCode')) ? "invalid-control" : ""), "id"=>"zipCode", "placeholder" => '例）1500021',"maxlength" =>7])}}
                    <button class="button zip js-zipCode">住所を検索</button>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['zipCode']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="prefecture">都道府県</label></th>
                <td>
                    <div class="selectBox__wrapper width100">
                    {{Form::select('prefecture', $data->get("prefectureList"),  $data->get("prefecture"), ["class" => (!empty($errors->has('prefecture')) ? "invalid-control" : ""), "id"=>"prefecture", "placeholder" => '選択してください'])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['prefecture']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="city">市区町村</label></th>
                <td>
                    {{Form::text('city', $data->get("city"), ["class" => (!empty($errors->has('city')) ? "invalid-control width100" : "width100"), "id"=>"city", "placeholder" => '例）渋谷区',"maxlength" =>56])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['city']])
                    <input type="hidden" name="country" value="1">
                </td>
            </tr>
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
            <tr class="invalid-form">
                <th class="required"><label for="phoneNumber">電話番号</label></th>
                <td>
                    {{Form::tel('phoneNumber', $data->get("phoneNumber"), ["class" => (!empty($errors->has('phoneNumber')) ? "invalid-control width100" : "width100"), "id"=>"phoneNumber", "placeholder" => '例）0364449999',"maxlength" =>15])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['phoneNumber']])
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="form__controls__prev js-btn-link" data-href="{{route('front.member-entry.revise-one')}}">
            <input type="submit" value="次に進む" class="form__controls__next">
        </div>
        {{Form::close()}}
    </div>
@stop
