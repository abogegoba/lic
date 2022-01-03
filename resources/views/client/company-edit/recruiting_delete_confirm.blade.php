@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','求人削除確認　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/company-edit/common_custom.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.company-edit.recruiting.list')}}">企業編集</li>
            <li>求人削除確認</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('client.common.mypage_menu')
    <div class="main__content" id="edit-delete">
        <h2 class="main__content__headline">求人削除確認</h2>
        {{Form::open(['url'=>route('client.company-edit.recruiting.delete.execute',["jobApplicationsId" => $data->get("selectedJobApplicationsId")]), 'class'=>("cancelForm")])}}
         <p>以下の求人を削除します。よろしいですか？</p>
            <p>※1度削除した求人は復元することはできません。</p>
            <dl>
                <dt>{{$data->get('title')}}{{$data->get('jobConditions')}}</dt>
                <dd>{{$data->get('jobTypeName')}}</dd>
            </dl>
            <div class="form__controls">
                <input type="button" value="戻る" class="prev js-btn-link" data-href="{{route('client.company-edit.recruiting.list')}}">
                <input type="submit" value="削除する" class="delete">
            </div>
        {{Form::close()}}
    </div>
@stop