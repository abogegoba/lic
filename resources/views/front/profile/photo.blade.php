@extends('front.common.root')

@section('title','写真・ハッシュタグ│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('script')
    @include('front.common.photo')
@stop

@section('vue')
    <script src="{{asset('js/photo_vue.js')}}"></script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（写真・ハッシュタグ）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content" id="photo" data-upload-url="{{route("front.profile.photo.edit.upload-photo")}}">
        {{Form::open(['url'=>route('front.profile.photo.edit.update')])}}
        <table v-cloak class="form__table">
            <tr class="invalid-form">
                <th>
                    <label for="photo1">証明写真</label>
                    <input type="checkbox" class="photo-sample__input" id="photo-sample__modal">
                    <label class="photo-sample__open" for="photo-sample__modal">？</label>
                    <div class="photo-sample">
                        <div class="photo-sample__inner">
                            <label class="photo-sample__close" for="photo-sample__modal">×</label>
                            <img src="{{asset('img/mypage/profile/profile_sample.jpg')}}" alt="参考写真">
                            <div class="photo-sample__text">
                                ＜参考写真＞
                                <span class="photo-sample__text-sub">※40×30mmの写真をアップロードしてください</span>
                            </div>
                        </div>
                    </div>
                </th>
                <td>
                    <div class="flex photo">
                        <picture id="existingPic">
                            <img v-if="idPhoto.url" v-bind:src="idPhoto.url" alt="証明写真">
                            <img v-else src="{{asset('img/mypage/profile/img_self.jpg')}}" alt="証明写真">
                        </picture>
                        <input type="file" id="js-id-photo" class="width100" data-data="{{$data->toJsonIdPhoto()}}">
                        {{--<input type="file" id="js-id-photo" class="width100" v-bind:class="{'invalid-control':idPhotoErrors.photo}" v-on:change="uploadIdPhoto" data-data="{{$data->toJsonIdPhoto()}}">--}}
                        <label for="js-id-photo" class="css-select-btn">写真を選択</label>
                        <button type="button" class="button remove css-delete-btn" v-if="idPhoto.url" v-on:click="deletePhoto">写真を削除する</button>
                        {{Form::hidden('idPhotoName',null,["v-bind:value" => "idPhoto.name","id"=>"idPhotoName"])}}
                        {{Form::hidden('idPhotoPath',null,["v-bind:value" => "idPhoto.path","id"=>"idPhotoPath"])}}
                    </div>
                    @include('front.common.vue_input_error', ['target' => 'idPhotoErrors.photo'])
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['idPhoto','idPhotoName','idPhotoPath']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="photo2">プライベート写真</label></th>
                <td>
                    <div class="flex photo">
                        <picture id="existingPic2">
                            <img v-if="privatePhoto.url" v-bind:src="privatePhoto.url" alt="プライベート写真">
                            <img v-else src="{{asset('img/mypage/profile/img_self.jpg')}}" alt="プライベート写真">
                        </picture>
                        <input type="file" id="js-private-photo" class="width100" data-data="{{$data->toJsonPrivatePhoto()}}">
                        {{--<input type="file" id="js-private-photo" class="width100" v-bind:class="{'invalid-control':privatePhotoErrors.photo}" v-on:change="uploadPrivatePhoto"
                               data-data="{{$data->toJsonPrivatePhoto()}}">--}}
                        <label for="js-private-photo" class="css-select-btn">写真を選択</label>
                        <button type="button" class="button remove css-delete-btn" v-if="privatePhoto.url" v-on:click="deletePrivatePhoto">写真を削除する</button>
                        {{Form::hidden('privatePhotoName',null,["v-bind:value" => "privatePhoto.name","id"=>"privatePhotoName"])}}
                        {{Form::hidden('privatePhotoPath',null,["v-bind:value" => "privatePhoto.path","id"=>"privatePhotoPath"])}}
                    </div>
                    @include('front.common.vue_input_error', ['target' => 'privatePhotoErrors.photo'])
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['privatePhoto','privatePhotoName','privatePhotoPath']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="hashTag">ハッシュタグ（最大16文字）</label></th>
                <td>
                    <div class="flex--ctr">
                        #{{Form::text('hashTag', $data->get("hashTag"), ["class" => (!empty($errors->has('hashTag')) ? "invalid-control width100" : "width100"), "id"=>"hashTag", "placeholder"=>"例）元甲子園球児", "maxlength" =>16])}}
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['hashTag']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="red">ハッシュタグカラー</label></th>
                <td>
                    <div class="flex color">
                        @foreach($data->get('hashTagColorClassList') as $key => $hashTagColor)
                            <div class="radio__color">
                                {{Form::radio('hashTagColor', $key , ($data->get("hashTagColor") === $key) || ($key === 1 && empty($data->get("hashTagColor"))? "checked='checked'":''), ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"hashTag$key"])}}
                                <label for="hashTag{{$key}}"><span
                                            class="{{$data->get('hashTagColorClassList')[$key]}}">{{$data->get('hashTagColorCodeList')[$key]}}</span></label>
                            </div>
                        @endforeach
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['hashTagColor']])
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="{{route("front.profile")}}">
            <input type="submit" value="保存する" class="save js-btn-submit">
        </div>
        {{Form::close()}}
    </div>
    @include('front.common.indicator')
@stop
