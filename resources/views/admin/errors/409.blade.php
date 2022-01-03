@extends('admin.errors.common')

@section('title','409')

@section('screen.title')
    <p>
        <i class="fas fa-exclamation-triangle icon text-secondary"></i>
        @foreach($errors as $error)
            {{$error}} <br>
        @endforeach
    </p>
@stop

@section('screen.body')
    <p>
        ご迷惑おかけして申し訳ありません。<br>
        再度やりなおしてください。
    </p>
@stop

@section('btn.row')
    @if($backUrl !== route('admin.top'))
        <div class="btn-col btn-row-sm">
            <button onclick="location.href='{{$backUrl}}'" type="button" class="btn btn-lg btn-secondary js-btn-submit">
                戻る
            </button>
        </div>
    @else
        <div class="btn-col btn-row-sm">
            <button onclick="location.href='{{route('admin.company.list')}}'" type="button" class="btn btn-lg btn-secondary js-btn-submit">
                戻る
            </button>
        </div>
    @endif
    <div class="btn-col btn-row-sm">
        <a href="{{route('admin.company.list')}}" class="btn btn-lg btn-primary">
            トップページに戻る
        </a>
    </div>
@stop
