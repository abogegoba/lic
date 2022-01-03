@extends('admin.errors.common')

@section('title','404')

@section('screen.title')
    <p>
        <i class="fas fa-exclamation-triangle icon text-secondary"></i>
        <em class="text-danger">404</em>
        File not found.
    </p>
@stop

@section('screen.body')
    <p>
        お探しのページは見つかりません。<br>
        一時的にアクセスできない状態か、移動もしくは削除されてしまった可能性があります。
    </p>
@stop

@section('btn.row')
    <div class="btn-col btn-row-sm">
        <a href="{{route('admin.company.list')}}" class="btn btn-lg btn-primary">
            トップページに戻る
        </a>
    </div>
@stop
