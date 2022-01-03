@extends('front.common.root')

@section('title','自己PR│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('vue')
    <script src="{{asset('js/mypage/pr/pr_vue.js')}}"></script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（PR）</li>
        </ul>
    </nav>
@stop

@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        {{Form::open(['url'=>route('front.profile.pr.edit.update')])}}
        <table class="form__table">
            <tr class="invalid-form">
                <th><label>PR動画・画像（最大3つ）</label></th>
                <td v-cloak id="pr-video" data-upload-url="{{route("front.profile.pr.edit.upload-video")}}">
                    <additional id="video" data="{{$data->toJsonPrVideos($errors)}}" :max="3" ref="prVideo">
                        <template slot="field" slot-scope="component">
                            <div v-for="(video, index) in component.data" class="video">

                                <div class="video-content invalid-form">
                                    <video controlsList="nodownload" controls="controls" v-bind:src="video.url" v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::MOVIE_CONTENT }}">
                                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                    <img v-bind:src="video.url" v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::IMAGE_CONTENT }}">
                                    <input type="file" v-bind:id="'js-pr-video_' + index" v-on:change="uploadPrVideo" v-bind:class="{'invalid-control':errors.uploadVideo}"> <label
                                            v-bind:for="'js-pr-video_' + index" class="add">動画を選択</label>
                                    <input type="file" v-bind:id="'js-pr-image_' + index" v-on:change="uploadPrImage" v-bind:class="{'invalid-control':errors.uploadImage}"> <label
                                            v-bind:for="'js-pr-image_' + index" class="add">画像を選択</label>
                                    <button type="button" class="button remove" v-on:click="component.remove(index)"
                                            v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::MOVIE_CONTENT }}">動画を削除
                                    </button>
                                    <button type="button" class="button remove" v-on:click="component.remove(index)"
                                            v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::IMAGE_CONTENT }}">画像を削除
                                    </button>
                                </div>
                                {{Form::hidden('prVideoNames[]',null,["v-bind:value" => "video.name"])}}
                                {{Form::hidden('prVideoPaths[]',null,["v-bind:value" => "video.path"])}}
                                {{Form::hidden('prVideoTypes[]',null,["v-bind:value" => "video.type"])}}
                                @include('front.common.vue_input_error', ['target' => 'video.videoError'])
                                @include('front.common.vue_input_error', ['target' => 'errors.uploadImage'])
                                @include('front.common.vue_input_error', ['target' => 'errors.uploadVideo'])
                                @include('front.common.input_error', ['errors' => $errors, 'target' => ['prVideoNames','prVideoPaths']])
                                <div class="video__form">
                                    <h3 class="video__form__headline">タイトル (最大24文字)</h3>
                                    {{Form::text('prVideoTitles[]',null,["v-bind:id" => "'js-pr-title_' + index", "v-bind:value" => "video.title", "v-on:input"=>"setPrTitle", "class" => "width100","placeholder" => "PR動画のタイトルをご記載ください。","v-bind:class" => "{'invalid-control':video.titleError}", "maxlength" =>24])}}
                                    @include('front.common.vue_input_error', ['target' => 'video.titleError'])
                                </div>
                                <div class="video_form">
                                    <h3 class="video__form__headline">説明文</h3>
                                    {{Form::textarea('prVideoDescriptions[]',null,["v-bind:id" => "'js-pr-description_' + index", "v-bind:value" => "video.description", "v-on:input"=>"setPrDescription", "class" => "width100","placeholder" => "PR動画の説明文をご記載ください。","v-bind:class" => "{'invalid-control':video.descriptionError}", "maxlength" =>400])}}
                                    @include('front.common.vue_input_error', ['target' => 'video.descriptionError'])
                                </div>
                            </div>
                            <div class="video">
                                <button type="button" class="button add" v-if="component.addable" v-on:click="component.add()">
                                    <template v-if="component.data.length > 0">次の</template>
                                    ファイルを選択する
                                </button>
                            </div>
                        </template>
                    </additional>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="introduction">自己PR文</label></th>
                <td>
                    {{Form::textarea('introduction', $data->get("introduction"), ["class" => (!empty($errors->has('introduction')) ? "invalid-control width100" : "width100"), "id"=>"introduction","cols"=>"30", "rows"=>"10", "placeholder" => "自己PR文をご記載ください。","maxlength" =>400])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['introduction']])
                </td>
            </tr>
            @if($data->get("country") == 1)
            <tr class="invalid-form">
                <th><label for="athletic">体育会系所属経験{{$data->get("affiliationExperience")}}</label></th>
                <td>
                    <div class="flex">
                        @foreach($data->get('affiliationExperienceLabelList') as $key => $affiliationExperienceLabel)
                            {{Form::radio('affiliationExperience',$key, ($data->get("affiliationExperience") == $key) || ($key == 2 && empty($data->get("affiliationExperience"))? "checked='checked'":''), ["class" => (!empty($errors->has('affiliationExperience')) ? "invalid-control" : ""), "id"=>"affiliationExperience$key"])}}
                            <label for="affiliationExperience{{$key}}">{{$affiliationExperienceLabel}}</label>
                        @endforeach
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['affiliationExperience']])
                </td>
            </tr>
            @endif
            <tr class="invalid-form">
                <th><label for="instagramFollowerNumber1">インスタフォロワー数</label></th>
                <td>
                    <div class="flex instagram">
                        @foreach($data->get('instagramFollowerNumberLabelList') as $key => $instagramFollowerNumberLabel)
                            {{Form::radio('instagramFollowerNumber',$key, ($data->get("instagramFollowerNumber") === $key) || ($key === 5 && empty($data->get("instagramFollowerNumber"))? "checked='checked'":''), ["class" => (!empty($errors->has('instagramFollowerNumber')) ? "invalid-control" : ""), "id"=>"instagramFollowerNumber$key"])}}
                            <label for="instagramFollowerNumber{{$key}}">{{$instagramFollowerNumberLabel}}</label>
                        @endforeach
                    </div>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['instagramFollowerNumber']])
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
