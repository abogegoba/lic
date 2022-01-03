@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','求人変更　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/company-edit/common_custom.css')}}">
@stop

@section('js')
    <script>
        $(function () {
            @if(session('success') === 'create')
            $('#create-complete').show();
            setTimeout(function () {
                $('#create-complete').fadeOut(1500);
            }, 2000);
            @elseif(session('success') === 'edit')
            $('#edit-complete').show();
            setTimeout(function () {
                $('#edit-complete').fadeOut(1500);
            }, 2000);
            @else
            $('#create-complete').remove();
            @endif
        });
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.company-edit.recruiting.list')}}">企業編集</a></li>
            <li>求人変更</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('client.common.mypage_menu')
    <div class="main__content" id="edit-entry">
        <div class="alert" id="create-complete" hidden>登録しました</div>
        <div class="alert" id="edit-complete" hidden>変更しました</div>

        <h2 class="main__content__headline">求人変更</h2>
        {{Form::open(['url'=>route('client.company-edit.recruiting.edit.execute',["jobApplicationsId" => $data->get("selectedJobApplicationsId")])])}}
            @include('client.company-edit.parts.input_recruiting')
            <div class="form__controls">
                <button class="prev js-btn-link" data-href="{{route('client.company-edit.recruiting.list')}}">戻る</button>
                <input type="submit" value="変更する" class="save">
            </div>
        {{Form::close()}}
    </div>
@stop