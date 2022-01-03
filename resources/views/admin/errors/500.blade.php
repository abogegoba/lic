@extends('admin.errors.common')

@section('title','500')

@section('screen.title')
    <p>
        <i class="fas fa-exclamation-triangle icon text-secondary"></i>
        <em class="text-danger">500</em>
        エラーが発生しました
    </p>
@stop

@section('screen.body')
    <p>
        ご迷惑をおかけして申し訳ありません。<br>
        しばらく時間をおいてから再度アクセスしてください。
    </p>
@stop

@section('btn.row')
    <div class="btn-col btn-row-sm">
        <a href="{{route('admin.company.list')}}" class="btn btn-lg btn-primary">
            トップページに戻る
        </a>
    </div>
@stop
