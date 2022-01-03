<strong>基本情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    @if(!empty($data->has('memberId')))
        <tr>
            <th>
                ID
            </th>
            <td>
                {{$data->get('memberId')}}
            </td>
        </tr>
    @endif
    <tr>
        <th class="required-icon">
            氏名
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 {{!empty($errors->has('lastName')) ? 'invalid-form' : ''}}">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">姓</div>
                    </div>
                    {{Form::text('lastName', $data->get("lastName"), ["class" => "form-control invalid-control", "placeholder" => "例）陸", 'maxlength' => 16])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('firstName')) ? 'invalid-form' : ''}}">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">名</div>
                    </div>
                    {{Form::text('firstName', $data->get("firstName"), ["class" => "form-control invalid-control", "placeholder" => "例）太郎", 'maxlength' => 16])}}
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'lastName'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'firstName'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            氏名かな
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 {{!empty($errors->has('lastNameKana')) ? 'invalid-form' : ''}}">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">姓</div>
                    </div>
                    {{Form::text('lastNameKana', $data->get("lastNameKana"), ["class" => "form-control invalid-control", "placeholder" => "例）りく", 'maxlength' => 16])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('firstNameKana')) ? 'invalid-form' : ''}}">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">名</div>
                    </div>
                    {{Form::text('firstNameKana', $data->get("firstNameKana"), ["class" => "form-control invalid-control", "placeholder" => "例）たろう", 'maxlength' => 16])}}
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'lastNameKana'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'firstNameKana'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            生年月日
        </th>
        <td>
            <div class="input-group date-calendar-wrap w-25 {{!empty($errors->has('birthday')) ? 'invalid-form' : ''}}">
                {{Form::text('birthday',$data->getWithFormat("birthday","Y/m/d"),["id" => "birthday","class"=>"form-control invalid-control js-datepicker border-right-0","data-default-blank"=>"true","placeholder"=>"例）1999/10/01"])}}
                <div class="input-group-append invalid-control">
                    <button type="button" class="btn js-datepicker-focus">
                        <i aria-hidden="true" class="iconfont iconfont-calendar"></i>
                    </button>
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'birthday'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            住所
        </th>
        <td>
            <div class="mb-2">
                <div class="custom-control-inline {{!empty($errors->has('zipCode')) ? 'invalid-form' : ''}}">
                    {{Form::tel('zipCode', $data->get("zipCode"), ["id"=>"zipCode", "class" => "form-control invalid-control", "placeholder" => "例）1500021", 'maxlength' => 7])}}
                </div>
                <div class="btn-col">
                    <button type="button" class="btn btn-primary js-zip">
                        <span>住所を検索</span>
                    </button>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'zipCode'])
            </div>
            <div class="mb-2 w-25 {{!empty($errors->has('prefecture')) ? 'invalid-form' : ''}}">
                {{Form::select('prefecture', $data->get("prefectureList"), $data->get("prefecture"), ["id"=>"prefecture", "class" => "form-control invalid-control", "placeholder" => "都道府県"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'prefecture'])
            </div>
            <div class="mb-2 {{!empty($errors->has('city')) ? 'invalid-form' : ''}}">
                {{Form::text('city', $data->get("city"), ["id"=>"city", "class" => "form-control invalid-control", "placeholder" => "例）渋谷区恵比寿西", 'maxlength' => 56])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'city'])
            </div>
            <div class="{{!empty($errors->has('blockNumber')) ? 'invalid-form' : ''}}">
                {{Form::text('blockNumber', $data->get("blockNumber"), ["id"=>"blockNumber", "class" => "form-control invalid-control", "placeholder" => "例）2-2-8 えびす第２ビル　2F", 'maxlength' => 56])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'blockNumber'])
            </div>
            <input type="hidden" name="country" value="1">
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            連絡先電話番号
        </th>
        <td class="{{!empty($errors->has('phoneNumber')) ? 'invalid-form' : ''}}">
            {{Form::tel('phoneNumber', $data->get("phoneNumber"), ["class" => "form-control invalid-control", 'placeholder'=>'例）0364449999', "maxlength" => 15])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'phoneNumber'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            学校種別
        </th>
        <td class="{{!empty($errors->has('schoolType')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline">
                @foreach($data->get("schoolTypeList") as $id => $schoolType)
                    <div class="mx-2">
                        {{Form::radio('schoolType', $id, ($data->get("schoolType") === $id ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"school_".$id])}}
                        <label for="school_{{$id}}"><span>{{$schoolType}}</span></label>
                    </div>
                @endforeach
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'schoolType'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            学校名
        </th>
        <td class="{{!empty($errors->has('schoolName')) ? 'invalid-form' : ''}}">
            {{Form::text('schoolName', $data->get("schoolName"), ["class" => "form-control invalid-control", 'placeholder'=>'例）東京大学','maxlength' => 24])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'schoolName'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            学部・学科名
        </th>
        <td class="{{!empty($errors->has('departmentName')) ? 'invalid-form' : ''}}">
            {{Form::text('departmentName', $data->get("departmentName"), ["class" => "form-control invalid-control", 'placeholder'=>'例）経済学部経済学科','maxlength' => 24])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'departmentName'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            学部系統
        </th>
        <td>
            {{Form::select('facultyType',  $data->get("facultyTypeList"), $data->get("facultyType"), ["class" => "form-control invalid-control"])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'facultyType'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            卒業年月
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-6 col-xl-2 {{!empty($errors->has('graduationPeriodYear')) ? 'invalid-form' : ''}}">
                    {{Form::select('graduationPeriodYear',  $data->get("yearList"), $data->get("graduationPeriodYear"), ["class" => "form-control invalid-control", 'placeholder'=>'選択してください'])}}
                </div>
                <div class="input-group col-sm-6 col-xl-2 mt-2 mt-sm-0 {{!empty($errors->has('graduationPeriodMonth')) ? 'invalid-form' : ''}}">
                    {{Form::select('graduationPeriodMonth',  $data->get("monthList"), $data->get("graduationPeriodMonth"), ["class" => "form-control invalid-control", 'placeholder'=>'選択してください'])}}
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'graduationPeriodYear'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'graduationPeriodMonth'])
            @if(!empty($errors) && !empty($errors->get("business_exception")['business.cant_store_graduation_period']))
                @include('admin.common.business_error', ['errors'=>$errors, 'target'=>'cant_store_graduation_period'])
            @endif
        </td>
    </tr>
    <tr>
        <th>
            プライベート写真
        </th>
        {{--<td v-cloak class="invalid-form">
            <div class="mb-2">
                <img v-if="privatePhoto.url" v-bind:src="privatePhoto.url" alt="プライベート写真">
                <img v-else src="{{asset('img/member/img_self.jpg')}}" alt="プライベート写真">
            </div>
            <div class="btn-col">
                <input type="file" id="js-private-photo" class="width100" v-bind:class="{'invalid-control':privatePhotoErrors.photo}" v-on:change="uploadPrivatePhoto"
                       data-data="{{$data->toJsonPrivatePhoto()}}" style="display: none">
                <label for="js-private-photo" class="btn btn-primary">写真を選択</label>
                {{Form::hidden('privatePhotoName',null,["v-bind:value" => "privatePhoto.name"])}}
                {{Form::hidden('privatePhotoPath',null,["v-bind:value" => "privatePhoto.path"])}}
            </div>
            <div class="btn-col">
                <button type="button" class="btn btn-secondary" v-on:click="removePrivatePhoto">
                    <span>写真を削除</span>
                </button>
            </div>
            @include('admin.common.vue_input_error', ['target' => 'privatePhotoErrors.photo'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhoto'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhotoName'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhotoPath'])
        </td>--}}
        <td v-cloak class="invalid-form">
            <div id="existingPrivatePhoto" class="logo mb-2">
                <img v-if="privatePhoto.url" v-bind:src="privatePhoto.url" alt="プライベート写真">
                <img v-else src="{{asset('img/member/img_self.jpg')}}" alt="プライベート写真">
            </div>
            <div class="btn-col">
                <input type="file" id="js-private-photo" class="width100" data-data="{{$data->toJsonPrivatePhoto()}}" style="display: none">
                {{--<input type="file" id="js-private-photo" class="width100" v-bind:class="{'invalid-control':privatePhotoErrors.photo}" v-on:change="uploadPrivatePhoto"
                       data-data="{{$data->toJsonPrivatePhoto()}}" style="display: none">--}}
                <label for="js-private-photo" class="btn btn-primary">写真を選択</label>
                {{Form::hidden('privatePhotoName',null,["v-bind:value" => "privatePhoto.name","id"=>"privatePhotoName"])}}
                {{Form::hidden('privatePhotoPath',null,["v-bind:value" => "privatePhoto.path","id"=>"privatePhotoPath"])}}
            </div>
            <div class="btn-col">
                <button type="button" class="btn btn-secondary" v-on:click="removePrivatePhoto">
                    <span>写真を削除</span>
                </button>
            </div>
            @include('admin.common.vue_input_error', ['target' => 'privatePhotoErrors.photo'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhoto'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhotoName'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhotoPath'])
        </td>
    </tr>
    <tr>
        <th>
            証明写真
        </th>
        {{--<td v-cloak class="invalid-form">
            <div class="mb-2">
                <img v-if="idPhoto.url" v-bind:src="idPhoto.url" alt="証明写真">
                <img v-else src="{{asset('img/member/img_self.jpg')}}" alt="証明写真">
            </div>
            <div class="btn-col">
                <input type="file" id="js-id-photo" v-bind:class="{'invalid-control':idPhotoErrors.photo}" v-on:change="uploadIdPhoto" data-data="{{$data->toJsonIdPhoto()}}" style="display: none">
                <label for="js-id-photo" class="btn btn-primary">写真を選択</label>
                {{Form::hidden('idPhotoName',null,["v-bind:value" => "idPhoto.name"])}}
                {{Form::hidden('idPhotoPath',null,["v-bind:value" => "idPhoto.path"])}}
            </div>
            <div class="btn-col">
                <button type="button" class="btn btn-secondary" v-on:click="removeIdPhoto">
                    <span>写真を削除</span>
                </button>
            </div>
            @include('admin.common.vue_input_error', ['target' => 'idPhotoErrors.photo'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhoto'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhotoName'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhotoPath'])
        </td>--}}
        <td v-cloak class="invalid-form">
            <div id="existingIdPhoto" class="logo mb-2">
                <img v-if="idPhoto.url" v-bind:src="idPhoto.url" alt="証明写真">
                <img v-else src="{{asset('img/member/img_self.jpg')}}" alt="証明写真">
            </div>
            <div class="btn-col">
                <input type="file" id="js-id-photo" data-data="{{$data->toJsonIdPhoto()}}" style="display: none">
                {{--<input type="file" id="js-id-photo" v-bind:class="{'invalid-control':idPhotoErrors.photo}" v-on:change="uploadIdPhoto" data-data="{{$data->toJsonIdPhoto()}}" style="display: none">--}}
                <label for="js-id-photo" class="btn btn-primary">写真を選択</label>
                {{Form::hidden('idPhotoName',null,["v-bind:value" => "idPhoto.name","id"=>"idPhotoName"])}}
                {{Form::hidden('idPhotoPath',null,["v-bind:value" => "idPhoto.path","id"=>"idPhotoPath"])}}
            </div>
            <div class="btn-col">
                <button type="button" class="btn btn-secondary" v-on:click="removeIdPhoto">
                    <span>写真を削除</span>
                </button>
            </div>
            @include('admin.common.vue_input_error', ['target' => 'idPhotoErrors.photo'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhoto'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhotoName'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhotoPath'])
        </td>
    </tr>
    <tr>
        {{--<th class="required-icon">--}}
        <th>
            ハッシュタグ<br>（最大16文字）
        </th>
        <td class="{{!empty($errors->has('hashTag')) ? 'invalid-form' : ''}}">
            <div class="input-group col-sm-6 col-xl-4">
                <div class="input-group-prepend">
                    <div class="input-group-text input-group-transparent pl-0"><h3>#</h3></div>
                </div>
                {{Form::text('hashTag', $data->get("hashTag"), ["class" => "form-control invalid-control w-75", 'placeholder'=>'例）イケメン多数', "maxlength" => 16])}}
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'hashTag'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
        {{--<th>--}}
            ハッシュタグカラー
        </th>
        <td class="{{!empty($errors->has('hashTagColor')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline color">
                @foreach($data->get('hashTagColorClassList') as $id => $hashTagColor)
                    <div class="radio__color">
                        @if($id == 1)
                        {{Form::radio('hashTagColor', $id , (empty($data->get("hashTagColor")) || $data->get("hashTagColor") === $id ? "checked='checked'":''), ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"hashTag_$id"])}}
                        @else
                        {{Form::radio('hashTagColor', $id , ($data->get("hashTagColor") === $id ? "checked='checked'":''), ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"hashTag_$id"])}}
                        @endif
                        <label for="hashTag_{{$id}}">
                            <span class="{{$hashTagColor}}">&nbsp;</span>
                        </label>
                    </div>
                @endforeach
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'hashTagColor'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            メールアドレス
        </th>
        <td class="{{!empty($errors->has('mailAddress')) ? 'invalid-form' : ''}}">
            {{Form::email('mailAddress', $data->get("mailAddress"), ["class" => "form-control invalid-control", 'placeholder'=>'例）example@linkt.jp', "maxlength" => 255])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'mailAddress'])
            @if(!empty($errors) && !empty($errors->get("business_exception")['business.duplication.mail_address']))
                @include('admin.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'])
            @endif
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            パスワード
        </th>
        <td class="{{!empty($errors->has('password')) ? 'invalid-form' : ''}}">
            {{Form::text('password', $data->get("password"), ["class" => "form-control invalid-control", "maxlength" => 14])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'password'])
        </td>
    </tr>
    </tbody>
</table>
<strong>PR</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th>
            PR動画・画像（最大3つ）
        </th>
        <td class="invalid-form">
            <additional id="video" data="{{$data->toJsonPrVideos($errors)}}" :max="3" ref="prVideo">
                <template slot="field" slot-scope="component">
                    <div v-for="(video, index) in component.data" class="file">
                        <div class="mb-5 invalid-form">
                            <div class="mb-2 video" v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::MOVIE_CONTENT }}">
                                <video controls="" muted="" poster="" v-bind:src="video.url">
                                    <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                </video>
                            </div>
                            <div class="mb-2 video-thumbs" v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::IMAGE_CONTENT }}">
                                <img v-bind:src="video.url">
                            </div>
                            <div class="btn-col">
                                <input v-bind:id="'js-pr-video_' + index" type="file" v-on:change="uploadPrVideo" v-bind:class="{'invalid-control':prVideoErrors.uploadVideo}"
                                       style="display: none">
                                <label v-bind:for="'js-pr-video_' + index" class="btn btn-primary">動画を選択</label>
                            </div>
                            <div class="btn-col">
                                <input v-bind:id="'js-pr-image_' + index" type="file" v-on:change="uploadPrImage" v-bind:class="{'invalid-control':prVideoErrors.uploadImage}"
                                       style="display: none">
                                <label v-bind:for="'js-pr-image_' + index" class="btn btn-primary">画像を選択</label>
                            </div>
                            <div class="btn-col" v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::MOVIE_CONTENT }}">
                                <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                    <span>動画を削除</span>
                                </button>
                            </div>
                            <div class="btn-col" v-if="video.url && video.type == {{ \App\Domain\Entities\UploadedFile::IMAGE_CONTENT }}">
                                <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                    <span>画像を削除</span>
                                </button>
                            </div>
                            {{Form::hidden('prVideoNames[]',null,["v-bind:value" => "video.name"])}}
                            {{Form::hidden('prVideoPaths[]',null,["v-bind:value" => "video.path"])}}
                            {{Form::hidden('prVideoTypes[]',null,["v-bind:value" => "video.type"])}}
                            @include('admin.common.vue_input_error', ['target' => 'video.videoError'])
                            @include('admin.common.vue_input_error', ['target' => 'prVideoErrors.uploadVideo'])
                            @include('admin.common.vue_input_error', ['target' => 'prVideoErrors.uploadImage'])
                            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoNames'])
                            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoPaths'])
                            <p>タイトル (最大24文字)</p>
                            <div class="mb-2">
                                {{Form::text('prVideoTitles[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':video.titleError}", "v-bind:id" => "'js-pr-title_' + index", "placeholder"=>"例）業界最大手の企業", "v-bind:value"=>"video.title", "v-on:input"=>"setPrTitle", "maxlength" => 24])}}
                            </div>
                            @include('admin.common.vue_input_error', ['target' => 'video.titleError'])
                            <p>説明文</p>
                            <div class="mb-2">
                                {{Form::textarea('prVideoDescriptions[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':video.descriptionError}", "v-bind:id" => "'js-pr-description_' + index", "placeholder"=>"例）当社は業界の中で日本最大手の企業です。","rows"=>"10", "v-bind:value"=>"video.description", "v-on:input"=>"setPrDescription", "maxlength" => 400])}}
                            </div>
                            @include('admin.common.vue_input_error', ['target' => 'video.descriptionError'])
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary w-50" v-if="component.addable" v-on:click="component.add()"><span v-if="component.data.length > 0">次の</span>ファイルを選択する</button>
                    </div>
                </template>
            </additional>
        </td>
    </tr>
    <tr>
        <th>
            自己PR文
        </th>
        <td class="{{!empty($errors->has('introduction')) ? 'invalid-form' : ''}}">
            {{Form::textarea('introduction', $data->get('introduction'), ["class" => "form-control", 'placeholder'=>'自己PR文をご記載ください。',"rows"=>"10", "maxlength" => 400])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'introduction'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            体育会所属経験
        </th>
        <td class="{{!empty($errors->has('affiliationExperience')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline">
                @foreach($data->get('affiliationExperienceLabelList') as $id => $affiliationExperienceLabel)
                    <div class="mx-2">
                        {{Form::radio('affiliationExperience',$id, ($data->get("affiliationExperience") == $id ? "checked='checked'":''), ["class" => (!empty($errors->has('affiliationExperience')) ? "invalid-control" : ""), "id"=>"affiliationExperience_$id"])}}
                        <label for="affiliationExperience_{{$id}}">{{$affiliationExperienceLabel}}</label>
                    </div>
                @endforeach
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'affiliationExperience'])
        </td>
    </tr>
    <tr>
        {{--<th class="required-icon">--}}
        <th>
            インスタフォロワー数
        </th>
        <td class="{{!empty($errors->has('instagramFollowerNumber')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline">
                @foreach($data->get('instagramFollowerNumberLabelList') as $id => $instagramFollowerNumberLabel)
                    <div class="mx-2">
                        {{Form::radio('instagramFollowerNumber',$id, ($data->get("instagramFollowerNumber") === $id ? "checked='checked'":''), ["class" => (!empty($errors->has('instagramFollowerNumber')) ? "invalid-control" : ""), "id"=>"instagramFollowerNumber_$id"])}}
                        <label for="instagramFollowerNumber_{{$id}}">{{$instagramFollowerNumberLabel}}</label>
                    </div>
                @endforeach
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'instagramFollowerNumber'])
        </td>
    </tr>
    </tbody>
</table>
<strong>自己紹介</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    @foreach($data->get("selfIntroductions") as $displayNumber => $selfIntroductions)
        <tr>
            <th>
                @if($displayNumber === 10)
                    自由入力
                @else
                    {{$selfIntroductions['title']}}
                @endif
            </th>
            <td class="invalid-form">
                @if($displayNumber === 10)
                    <div class="mb-2">
                        {{Form::text('selfIntroduction10Title', $data->get("selfIntroduction10Title"), ["class" => (!empty($errors->has('selfIntroduction10Title')) ? "form-control invalid-control" : "form-control"), "id"=>"selfIntroduction10Title", "maxlength" =>24, "placeholder"=>"自由にタイトルを入力してください"])}}
                        @include('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroduction10Title'])
                    </div>
                    <div class="mb-2">
                        {{Form::textarea('selfIntroductions['.$displayNumber.']' , $selfIntroductions['content'], ["class" => (!empty($errors->has('selfIntroductions')) || !empty($errors->has('selfIntroductions.'.$displayNumber)) ? "form-control invalid-control" : "form-control"), "id"=>"selfIntroduction".$displayNumber,"rows"=>"10", "maxlength" =>400, 'placeholder'=>'※自由に本文を入力してください。400文字以内で作成してください。',])}}
                        @include('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions'])
                        @include('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions.'.$displayNumber])
                    </div>
                @else
                    {{Form::textarea('selfIntroductions['.$displayNumber.']' , $selfIntroductions['content'], ["class" => (!empty($errors->has('selfIntroductions')) || !empty($errors->has('selfIntroductions.'.$displayNumber)) ? "form-control invalid-control" : "form-control"), "id"=>"selfIntroduction".$displayNumber,"rows"=>"10", "maxlength" =>400, 'placeholder'=>'※内容は具体的にご記載ください。400文字以内で作成してください。',])}}
                    @include('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions'])
                    @include('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions.'.$displayNumber])
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<strong>志望情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th class="required-icon">
            志望業種（最大３つ）
        </th>
        <td class="invalid-form">
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 {{!empty($errors->has('industry1')) ? 'invalid-form' : ''}}">
                    {{Form::select('industry1', $data->get("businessTypeList"), $data->get("industry1"), ["class" => (!empty($errors->has('industry1')) ? "form-control invalid-control" : "form-control"), "id"=>"industry1","placeholder" => "選択してください"])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('industry2')) ? 'invalid-form' : ''}}">
                    {{Form::select('industry2', $data->get("businessTypeList"), $data->get("industry2"), ["class" => (!empty($errors->has('industry2')) ? "form-control invalid-control" : "form-control"), "id"=>"industry2","placeholder" => "選択してください"])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('industry3')) ? 'invalid-form' : ''}}">
                    {{Form::select('industry3', $data->get("businessTypeList"), $data->get("industry3"), ["class" => (!empty($errors->has('industry3')) ? "form-control invalid-control" : "form-control"), "id"=>"industry3","placeholder" => "選択してください"])}}
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'industry1'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'industry2'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'industry3'])
        </td>
    </tr>
    <tr>
        {{--<th class="required-icon">--}}
        <th>
            志望職種（最大３つ）
        </th>
        <td class="invalid-form">
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 {{!empty($errors->has('jobType1')) ? 'invalid-form' : ''}}">
                    {{Form::select('jobType1', $data->get("jobTypeList"), $data->get("jobType1"), ["class" => (!empty($errors->has('jobType1')) ? "form-control invalid-control" : "form-control"), "id"=>"jobType1","placeholder" => "選択してください"])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('jobType2')) ? 'invalid-form' : ''}}">
                    {{Form::select('jobType2', $data->get("jobTypeList"), $data->get("jobType2"), ["class" => (!empty($errors->has('jobType2')) ? "form-control invalid-control" : "form-control"), "id"=>"jobType2","placeholder" => "選択してください"])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('jobType3')) ? 'invalid-form' : ''}}">
                    {{Form::select('jobType3', $data->get("jobTypeList"), $data->get("jobType3"), ["class" => (!empty($errors->has('jobType3')) ? "form-control invalid-control" : "form-control"), "id"=>"jobType3","placeholder" => "選択してください"])}}
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType1'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType2'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType3'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            志望勤務地（最大３つ）
        </th>
        <td class="invalid-form">
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 {{!empty($errors->has('location1')) ? 'invalid-form' : ''}}">
                    {{Form::select('location1', $data->get("prefectureList"), $data->get("location1"), ["class" => (!empty($errors->has('location1')) ? "form-control invalid-control" : "form-control"), "id"=>"location1","placeholder" => "選択してください"])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('location2')) ? 'invalid-form' : ''}}">
                    {{Form::select('location2', $data->get("prefectureList"), $data->get("location2"), ["class" => (!empty($errors->has('location2')) ? "form-control invalid-control" : "form-control"), "id"=>"location2","placeholder" => "選択してください"])}}
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('location3')) ? 'invalid-form' : ''}}">
                    {{Form::select('location3', $data->get("prefectureList"), $data->get("location3"), ["class" => (!empty($errors->has('location3')) ? "form-control invalid-control" : "form-control"), "id"=>"location3","placeholder" => "選択してください"])}}
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'location1'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'location2'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'location3'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            インターン希望
        </th>
        <td class="{{!empty($errors->has('internNeeded')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline">
                <div class="mx-2">
                    {{Form::radio('internNeeded', 1, ($data->get("internNeeded")) == 1 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"internNeeded_true"])}}
                    <label for="internNeeded_true"><span>有り</span></label>
                </div>
                <div class="mx-2">
                    {{Form::radio('internNeeded', 0, ($data->get("internNeeded")) == 0 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"internNeeded_false"])}}
                    <label for="internNeeded_false"><span>無し</span></label>
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'internNeeded'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            就活イベントやその他就職活動に関 する情報取得について
        </th>
        <td class="{{!empty($errors->has('recruitInfoNeeded')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline">
                <div class="mx-2">
                    {{Form::radio('recruitInfoNeeded', 1, ($data->get("recruitInfoNeeded")) == 1 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"recruitInfoNeeded_true"])}}
                    <label for="recruitInfoNeeded_true"><span>有り</span></label>
                </div>
                <div class="mx-2">
                    {{Form::radio('recruitInfoNeeded', 0, ($data->get("recruitInfoNeeded")) == 0 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"recruitInfoNeeded_false"])}}
                    <label for="recruitInfoNeeded_false"><span>無し</span></label>
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitInfoNeeded'])
        </td>
    </tr>
    </tbody>
</table>
<strong>語学・資格</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th>
            TOEIC
        </th>
        <td class="{{!empty($errors->has('toeicScore')) ? 'invalid-form' : ''}}">
            {{Form::tel('toeicScore', $data->get("toeicScore"), ["class" => "form-control invalid-control w-25", 'placeholder'=>'例）456点', "maxlength" => 3])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'toeicScore'])
        </td>
    </tr>
    <tr>
        <th>
            TOEFL
        </th>
        <td class="{{!empty($errors->has('toeflScore')) ? 'invalid-form' : ''}}">
            {{Form::tel('toeflScore', $data->get("toeflScore"), ["class" => "form-control invalid-control w-25", 'placeholder'=>'例）123点', "maxlength" => 3])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'toeflScore'])
        </td>
    </tr>
    <tr>
        <th>
            保有資格・検定など
        </th>
        <td class="invalid-form">
            <additional v-cloak id="licences" data="{{$data->toJsonQualifications($errors)}}" :max="10" class="licences-container" :initial-add="true">
                <template slot="field" slot-scope="component" class="licences-wrap">
                    <div v-for="(certificationList, index) in component.data" class="row mb-2">
                        <div class="input-group col-sm-6 col-xl-8 {{!empty($errors->has('year')) ? 'invalid-form' : ''}}">
                            {{Form::text('certificationList[]', null, ["v-model"=>"certificationList.certification", "class" => "form-control","v-bind:class"=>"[certificationList.certificationListErrors||certificationList.certificationListsErrors? 'invalid-control':'']", "id"=>"certificationList","placeholder"=>"例）秘書検定1級", "maxlength" =>32])}}
                        </div>
                        <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-secondary" v-if="index !== 0" v-on:click="component.remove(index)">
                                <span>削除</span>
                            </button>
                        </div>
                        @include('admin.common.vue_input_error', ['target' => 'certificationList.certificationListErrors'])
                        @include('admin.common.vue_input_error', ['target' => 'certificationList.certificationListsErrors'])
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary w-50" v-if="component.addable" v-on:click="component.add">
                            <span>最終行に追加する</span>
                        </button>
                    </div>
                </template>
            </additional>
        </td>
    </tr>
    </tbody>
</table>
<strong>学歴・経歴</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th>
            学歴・経歴
        </th>
        <td class="invalid-form">
            <additional v-cloak id="careers" data="{{$data->toJsonCareers($errors)}}" :max="20" :initial-add="true">
                <template slot="field" slot-scope="component">
                    <div v-for="(career,index) in component.data" class="career mb-2">
                        <div class="row mb-2">
                            <div class="input-group col-sm-6 col-xl-2">
                                {{Form::select('careerPeriodYears[]', $data->get("yearList"), null, ["v-model"=>"career.periodYear","class" => "form-control","v-bind:class"=>"[career.periodYearErrors||career.periodYearsErrors? 'invalid-control':'']","placeholder" => "選択してください"])}}
                            </div>
                            <div class="input-group col-sm-6 col-xl-2 mt-2 mt-sm-0">
                                {{Form::select('careerPeriodMonths[]', $data->get("monthList"), null, ["v-model"=>"career.periodMonth", "class" => "form-control","v-bind:class"=>"[career.periodMonthErrors||career.periodMonthsErrors? 'invalid-control':'']","placeholder" => "選択してください"])}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="input-group col-sm-6 col-xl-8">
                                {{Form::text('careerNames[]', null, ["v-model"=>"career.name", "class" => "form-control","v-bind:class"=>"[career.nameErrors||career.namesErrors? 'invalid-control':'']","placeholder"=>"例）明治大学付属明治高等学校　卒業", "maxlength" =>32])}}
                            </div>
                            <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0">
                                <button type="button" class="btn btn-secondary" v-if="index !== 0" v-on:click="component.remove(index)">
                                    <span>削除</span>
                                </button>
                            </div>
                        </div>
                        @include('admin.common.vue_input_error', ['target' => 'career.periodYearErrors'])
                        @include('admin.common.vue_input_error', ['target' => 'career.periodYearsErrors'])
                        @include('admin.common.vue_input_error', ['target' => 'career.periodMonthErrors'])
                        @include('admin.common.vue_input_error', ['target' => 'career.periodMonthsErrors'])
                        @include('admin.common.vue_input_error', ['target' => 'career.nameErrors'])
                        @include('admin.common.vue_input_error', ['target' => 'career.namesErrors'])
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary w-50" v-if="component.addable" v-on:click="component.add()">
                            <span>最終行に追加する</span>
                        </button>
                    </div>
                </template>
            </additional>
        </td>
    </tr>
    </tbody>
</table>
<strong>管理情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th>
            メモ
        </th>
        <td>
            <div class="{{!empty($errors->has('managementMemo')) ? 'invalid-form' : ''}}">
                {{Form::textarea('managementMemo', $data->get("managementMemo"), ["class" => "form-control invalid-control", "maxlength" => 4000])}}
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'managementMemo'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            ステータス
        </th>
        <td class="{{!empty($errors->has('status')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline">
                @foreach($data->get('statusList') as $id => $status)
                    <div class="mx-2">
                        {{Form::radio('status', $id, ($data->get("status") === $id ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"status_".$id])}}
                        <label for="status_{{$id}}"><span>{{$status}}</span></label>
                    </div>
                @endforeach
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'status'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            メール送信
        </th>
        <td class="{{!empty($errors->has('sendMail')) ? 'invalid-form' : ''}}">
            <div class="custom-control-inline">
                <div class="mx-2">
                    {{Form::radio('sendMail', 1, ($data->get("sendMail") == 1 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail_1"])}}
                    <label for="send-mail_1"><span>送信する</span></label>
                </div>
                <div class="mx-2">
                    {{Form::radio('sendMail', 0, ($data->get("sendMail") == 0 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail_0"])}}
                    <label for="send-mail_0"><span>送信しない</span></label>
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'sendMail'])
        </td>
    </tr>
    </tbody>
</table>
