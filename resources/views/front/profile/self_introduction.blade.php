@extends('front.common.root')

@section('title','自己PR -2-│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（自己紹介）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        {{Form::open(['url'=>route('front.profile.self-introduction.edit.store')])}}
        <table class="form__table">
            @foreach($data->get("selfIntroductions") as $displayNumber => $selfIntroductions)
                <tr class="invalid-form">
                    <th>
                        @if($displayNumber === 10)
                            <label for="selfIntroduction__flee__title">※自由にタイトルを入力してください。</label>
                            {{Form::text('selfIntroduction10Title', $data->get("selfIntroduction10Title"), ["class" => (!empty($errors->has('selfIntroduction10Title')) ? "invalid-control width100" : "width100"), "id"=>"selfIntroduction10Title", "maxlength" =>24])}}
                            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['selfIntroduction10Title']])
                        @else
                            <label for="selfIntroduction{{$displayNumber}}">{{$selfIntroductions['title']}}</label>
                        @endif
                    </th>
                    <td>
                        @if($displayNumber === 10)
                            {{Form::textarea('selfIntroductions['.$displayNumber.']' , $selfIntroductions['content'], ["class" => (!empty($errors->has('selfIntroductions')) || !empty($errors->has('selfIntroductions.'.$displayNumber)) ? "invalid-control width100" : "width100"), "placeholder" => "※自由に本文を入力してください。400文字以内で作成してください。","id"=>"selfIntroduction".$displayNumber,"cols"=>"30", "rows"=>"10", "maxlength" =>400])}}
                            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['selfIntroductions','selfIntroductions.'.$displayNumber]])
                        @else
                            {{Form::textarea('selfIntroductions['.$displayNumber.']' , $selfIntroductions['content'], ["class" => (!empty($errors->has('selfIntroductions')) || !empty($errors->has('selfIntroductions.'.$displayNumber)) ? "invalid-control width100" : "width100"), "placeholder" => "※内容は具体的にご記載ください。400文字以内で作成してください。","id"=>"selfIntroduction".$displayNumber,"cols"=>"30", "rows"=>"10", "maxlength" =>400])}}
                            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['selfIntroductions','selfIntroductions.'.$displayNumber]])
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="{{route("front.profile")}}">
            <input type="submit" value="保存する" class="save">
        </div>
        {{Form::close()}}
    </div>
@stop
