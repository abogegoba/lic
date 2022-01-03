@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','求人登録　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/company-edit/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.company-edit.recruiting.list')}}">企業編集</a></li>
            <li>求人登録</li>
        </ul>
    </nav>
@stop

@section('js')
    <script src="{{ asset('js/common_custom.js') }}"></script>
    <script>
        $(function () {
            $(document).on('click', '.js-btn-submit', function () {
                var btn = $(this);
                setTimeout(function () {
                    btn.prop("disabled", false);
                }, 6000);
            });
        });
    </script>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <div class="main__content" id="edit-entry">
        <h2 class="main__content__headline">求人登録</h2>
        {{Form::open(['url'=>route('client.company-edit.recruiting.create.execute')])}}

            @include('client.company-edit.parts.input_recruiting')
            <div class="form__controls">
                <button class="prev js-btn-link" data-href="{{route('client.company-edit.recruiting.list')}}">戻る</button>
                <input type="submit" value="登録する" class="save js-btn-submit">
            </div>
        {{Form::close()}}
    </div>
@stop