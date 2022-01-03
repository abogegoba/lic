@extends('admin.common.root')

@section('title','企業登録')
@section('css')
    <link rel="stylesheet" href="{{asset('css/cropper.min.css')}}">
@stop
@section('js')
    <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
    <script>
        $(function () {
            $('.js-zip').on('click', function () {
                AjaxZip3.zip2addr('zip', '', 'prefectures', 'city');
                return false;
            });
        });
    </script>
    <script src="{{asset('js/cropper.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#deleteLogo').hide();
            $("#addClientImageButton").click(function() {
                var div_count = $('.company_file').length;
                if(div_count < 4){
                    if(div_count == 0){
                        var index = 0;
                        var radio_button = '                                    <input id="displayImage_'+index+'" name="displayImage" type="radio" value="1" checked>\n' ;
                    }else{
                        var index = Number($('.company_file').last().attr('counter')) + 1;
                        var radio_button = '                                    <input id="displayImage_'+index+'" name="displayImage" type="radio" value="1">\n';
                    }
                    // Selecting last id
                    var html = '<div class="company_file" id="selectFile_'+index+'" class="file" counter="'+index+'">\n' +
                        '                                <div id="selectBox_'+index+'" class="mb-2" style="display: none;">\n' +
                        radio_button +
                        '                                    <label for="displayImage_'+index+'">一覧に表示</label>\n' +
                        '                                </div>\n' +
                        '                                <div id="existingCompanyImage_'+index+'" class="mb-2 company-image">\n' +
                        '                                    <img src="">\n' +
                        '                                </div>\n' +
                        '                                <div class="btn-col">\n' +
                        '                                    <input type="file" class="companyImg" counter="'+index+'" id="js-companyImage_'+index+'" style="display: none;">\n' +
                        '                                    <label for="js-companyImage_'+index+'" class="btn btn-primary">写真を選択</label>\n' +
                        '                                </div>\n' +
                        '                                <div class="btn-col">\n' +
                        '                                    <button id="companyImageRemove_'+index+'" type="button" class="delete removeCompanyImage_0 btn btn-primary" counter="'+index+'" style="display: none;">写真を削除</button>\n' +
                        '                                </div>\n' +
                        '                                <input id="companyImageNames_'+index+'" name="companyImageNames[]" type="hidden" value="">\n' +
                        '                                <input id="companyImagePaths_'+index+'" name="companyImagePaths[]" type="hidden" value="">\n' +
                        '                            </div>';
                    // Create clone
                    $( "#corporate_image" ).append( html );

                    if($('.company_file').length >= 3){
                        $("#addClientImageButton").hide();
                    }
                }
            });

            $("#logo").change(function() {
                var p_id = 'uploadedLogoName';
                $('#cropImage').attr("pic_type","uploadedLogo");
                readURL(this,p_id);
            });


            $('.additional').on('change','.companyImg', function(){
                var index = $(this).attr('counter');
                var p_id = 'companyImageNames_'+index;
                $('#cropImage').attr("pic_type","companyImage_"+index);
                readURL(this,p_id);
            });

            $('.additional').on('click','.delete', function(){
                var index = $(this).attr('counter');
                $('#selectFile_'+index).remove();
                if($('.company_file').length < 3){
                    $("#addClientImageButton").show();
                }
            });
            $('.select2-multiple').select2({width: 'resolve'});
        });

        function readURL(input,p_id) {
            if (input.files && input.files[0]) {
                $('#'+p_id).val(input.files[0].name);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);

                $('#imgModal').modal('show');
                // 参考: https://qiita.com/_Keitaro_/items/57b1c5dd36b7bed08ad8
                $(input).val('');
            }
        }

        window.addEventListener('DOMContentLoaded', function () {
            var image = document.getElementById('blah');
            var button = document.getElementById('cropImage');
            var croppable = false;
            var cropBoxData;
            var canvasData;
            var cropper;

            $('#imgModal').on('shown.bs.modal', function () {
                var uploadImageType = button.getAttribute('pic_type');
                var res = uploadImageType.split("_");
                var uploadImageTypeIndex = res[1];
                cropper = new Cropper(image, {
                    autoCropArea: 1,
                    aspectRatio: 16 / 9,
                    //viewMode: 1,
                    ready: function () {
                        //Should set crop box data first here
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                        croppable = true;
                    }
                });

                button.onclick = function () {

                    var croppedCanvas;
                    var croppedImg;

                    if (!croppable) {
                        return;
                    }
                    // Crop
                    croppedCanvas = cropper.getCroppedCanvas();
                    // Show
                    croppedImg = document.createElement('img');
                    croppedImg.src = croppedCanvas.toDataURL()
                    //Usage example:
                    dataURLtoFile(croppedImg,croppedImg.src,uploadImageType,uploadImageTypeIndex);
                };
            }).on('hidden.bs.modal', function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });
        });

        function dataURLtoFile(croppedImg,dataurl,uploadImageType,uploadImageTypeIndex) {
            var arr = dataurl.split(',');
            var mime = arr[0].match(/:(.*?);/)[1];
            var temp_extention = mime.split('/');
            var file_ext = temp_extention[1];
            var filename = 'cropped_image.'+file_ext;

            if(uploadImageType == 'uploadedLogo'){
                var existingPic = document.getElementById('existingLogo');
            }else if(uploadImageType == 'companyImage_'+uploadImageTypeIndex){
                var existingPic = document.getElementById('existingCompanyImage_'+uploadImageTypeIndex);
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch(dataurl)
                .then(res => res.blob())
                .then(blob => {
                    const file = new File([blob], filename, {
                        type: 'image/png'
                    });
                    var fd = new FormData();
                    fd.append("uploadImage", file);
                    $("#loader").show();
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: '{!! route('admin.upload') !!}',
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: (data) => {
                            $("#loader").hide();
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                        },
                        complete: function (response) {
                            var json_response = jQuery.parseJSON( response.responseText );
                            var path = json_response.path;
                            var url = json_response.url;
                            if(uploadImageType == 'uploadedLogo'){
                                $('#existingLogo img').attr('src',url);
                                $('#existingLogo').show();
                                $('#existingLogo img').show();
                                $('#uploadedLogoPath').val(path);
                                $('#deleteLogo').show();
                            }else if(uploadImageType == 'companyImage_'+uploadImageTypeIndex){
                                $('#existingCompanyImage_'+uploadImageTypeIndex+' img').attr('src',url);
                                $('#companyImagePaths_'+uploadImageTypeIndex).val(path);
                                $( "#selectBox_"+uploadImageTypeIndex ).show();
                                $( "#companyImageRemove_"+uploadImageTypeIndex ).show();
                            }

                        }
                    });
                });
        }

        $('#deleteLogo').click(function () {
            $('#existingLogo img').hide();
            $('#deleteLogo').hide();
        })

    </script>
@stop

@section('vue')
    <script src="{{asset('js/company/edit_vue.js')}}"></script>
@stop

@section('content')
    <h1 class="content-title" id="company-edit" data-upload-url="{{route('admin.upload')}}">企業登録</h1>

    <a href="{{route('admin.company.reload')}}">< 企業一覧に戻る</a>

    @if(session('success') === 'edit')
        変更完了モーダル
        @include('admin.common.edit_complete')
    @endif

    <div style="margin-top: 2em;">
    {{Form::open(['url'=>route('admin.company.create')])}}
    <strong>基本情報</strong>
    <table class="table table-form mb-5">
        <colgroup>
            <col class="w-20">
            <col>
        </colgroup>
        <tbody>

        <tr>
            {{--<th class="required-icon">--}}
            <th>
                会社名
            </th>
            <td class="{{!empty($errors->has('name')) ? 'invalid-form' : ''}}">
                {{Form::text('name', $data->get("name"), ["class" => "form-control invalid-control", "placeholder" => "例）株式会社infit", 'maxlength' => 56])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'name'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                会社名（かな）
            </th>
            <td class="{{!empty($errors->has('nameKana')) ? 'invalid-form' : ''}}">
                {{Form::text('nameKana', $data->get("nameKana"), ["class" => "form-control invalid-control", "placeholder" => "例）かぶしきがいしゃいんふぃっと", 'maxlength' => 56])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'nameKana'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                本社所在地
            </th>
            <td>
                <div class="custom-control-inline {{!empty($errors->has('zip')) ? 'invalid-form' : ''}}">
                    {{Form::tel('zip', $data->get("zip"), ["id"=>"zip", "class" => "form-control invalid-control", "placeholder" => "例）1500021", 'maxlength' => 7])}}
                </div>
                <div class="btn-col">
                    <button type="button" class="btn btn-primary js-zip">
                        <span>住所を検索</span>
                    </button>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'zip'])
                <div class="mb-2 w-25 {{!empty($errors->has('prefectures')) ? 'invalid-form' : ''}}">
                    {{Form::select('prefectures', $data->get("prefectureList"), $data->get("prefectures"), ["id"=>"prefectures", "class" => "form-control invalid-control", "placeholder" => "都道府県"])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'prefectures'])
                <div class="mb-2 {{!empty($errors->has('city')) ? 'invalid-form' : ''}}">
                    {{Form::text('city', $data->get("city"), ["id"=>"city", "class" => "form-control invalid-control", "placeholder" => "例）渋谷区恵比寿西2-2-8", 'maxlength' => 56])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'city'])
                <div class="{{!empty($errors->has('room')) ? 'invalid-form' : ''}}">
                    {{Form::text('room', $data->get("room"), ["id"=>"room", "class" => "form-control invalid-control", "placeholder" => "例）えびす第２ビル　2F", 'maxlength' => 56])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'room'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                業種
            </th>
            <td>
                <div class="{{!empty($errors->has('industryCondition.0')) ? 'invalid-form' : ''}}">
                    <select multiple class="form-control invalid-control select2-multiple" name="industryCondition[]">
                        @foreach($data->get("businessTypeList") as $businessTypeKey => $businessTypeVal)
                            @if(!empty($errors->has('industryCondition.0')))
                                <option value="{{$businessTypeKey}}">{{$businessTypeVal}}</option>
                            @elseif(in_array($businessTypeKey, old('industryCondition') ?: []))
                                <option selected value="{{$businessTypeKey}}">{{$businessTypeVal}}</option>
                            @else
                                <option value="{{$businessTypeKey}}">{{$businessTypeVal}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'industryCondition.0'])
            </td>
        </tr>
        <tr>
            <th>
                事業内容
            </th>
            <td>
                <div class="{{!empty($errors->has('descriptionOfBusiness')) ? 'invalid-form' : ''}}">
                    {{Form::textarea('descriptionOfBusiness', $data->get("descriptionOfBusiness"), ["class" => "form-control invalid-control", "placeholder" => "例）次世代型就活サイト【LinkT】の企画・開発・運営"])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'descriptionOfBusiness'])
            </td>
        </tr>
        <tr>
            <th>
                設立
            </th>
            <td class="{{!empty($errors->has('establishmentDate')) ? 'invalid-form' : ''}}">
                {{Form::text('establishmentDate', $data->get("establishmentDate"), ["class" => "form-control invalid-control", "placeholder" => "例）2019年3月5日", 'maxlength' => 24])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'establishmentDate'])
            </td>
        </tr>
        <tr>
            <th>
                資本金
            </th>
            <td class="{{!empty($errors->has('capital')) ? 'invalid-form' : ''}}">
                {{Form::text('capital', $data->get("capital"), ["class" => "form-control invalid-control", "placeholder" => "例）10,000,000円"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'capital'])
            </td>
        </tr>
        <tr>
            <th>
                従業員
            </th>
            <td class="{{!empty($errors->has('payrollNumber')) ? 'invalid-form' : ''}}">
                {{Form::text('payrollNumber', $data->get("payrollNumber"), ["class" => "form-control invalid-control", "placeholder" => "例）100人"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'payrollNumber'])
            </td>
        </tr>
        <tr>
            <th>
                売上高
            </th>
            <td class="{{!empty($errors->has('sales')) ? 'invalid-form' : ''}}">
                {{Form::text('sales', $data->get("sales"), ["class" => "form-control invalid-control", "placeholder" => "例）10,000,000円"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'sales'])
            </td>
        </tr>
        <tr>
            <th>
                代表者
            </th>
            <td class="{{!empty($errors->has('representativePerson')) ? 'invalid-form' : ''}}">
                {{Form::text('representativePerson', $data->get("representativePerson"), ["class" => "form-control invalid-control", "placeholder" => "例）代表取締役　後藤剛志",'maxlength' => 24])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'representativePerson'])
            </td>
        </tr>
        <tr>
            <th>
                役員構成
            </th>
            <td class="{{!empty($errors->has('exectiveOfficers')) ? 'invalid-form' : ''}}">
                {{Form::textarea('exectiveOfficers', $data->get("exectiveOfficers"), ["class" => "form-control invalid-control", "placeholder" => "例）取締役　中山勢二","rows"=>"7"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'exectiveOfficers'])
            </td>
        </tr>
        <tr>
            <th>
                事業所
            </th>
            <td class="{{!empty($errors->has('establishment')) ? 'invalid-form' : ''}}">
                {{Form::textarea('establishment', $data->get("establishment"), ["class" => "form-control invalid-control", "placeholder" => "例）東京都渋谷区恵比寿西2-2-8　えびす第2ビル2F","rows"=>"4"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'establishment'])
            </td>
        </tr>
        <tr>
            <th>
                関連会社
            </th>
            <td class="{{!empty($errors->has('affiliatedCompany')) ? 'invalid-form' : ''}}">
                {{Form::textarea('affiliatedCompany', $data->get("affiliatedCompany"), ["class" => "form-control invalid-control", "placeholder" => "例）株式会社infit's", "rows"=>"4"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'affiliatedCompany'])
            </td>
        </tr>
        <tr>
            <th>
                登録・資格
            </th>
            <td class="{{!empty($errors->has('qualification')) ? 'invalid-form' : ''}}">
                {{Form::textarea('qualification', $data->get("qualification"), ["class" => "form-control invalid-control", "placeholder" => "例）秘書検定1級", "rows"=>"4"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'qualification'])
            </td>
        </tr>
        <tr>
            <th>
                ホームページURL
            </th>
            <td class="{{!empty($errors->has('homePageUrl')) ? 'invalid-form' : ''}}">
                {{Form::text('homePageUrl', $data->get("homePageUrl"), ["class" => "form-control invalid-control","placeholder" => "例）https://linkt.jp",  "maxlength" => 255])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'homePageUrl'])
            </td>
        </tr>
        <tr>
            <th>
                採用ホームページ
            </th>
            <td class="{{!empty($errors->has('recruitmentUrl')) ? 'invalid-form' : ''}}">
                {{Form::text('recruitmentUrl', $data->get("recruitmentUrl"), ["class" => "form-control invalid-control","placeholder" => "例）https://linkt.jp",  "maxlength" => 255])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentUrl'])
            </td>
        </tr>
        <tr>
            <th>
                主要取引先
            </th>
            <td class="{{!empty($errors->has('mainClient')) ? 'invalid-form' : ''}}">
                {{Form::textarea('mainClient', $data->get("mainClient"), ["class" => "form-control invalid-control", "rows"=>"4", "placeholder" => "例）株式会社電通"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'mainClient'])
            </td>
        </tr>
        <tr v-cloak>
            <th>
                企業ロゴ
            </th>
            <td class="invalid-form">
                {{--<div class="mb-2 logo">
                    <img v-if="logo.url" v-bind:src="logo.url" alt="企業ロゴ">
                </div>
                {{Form::hidden('uploadedLogoName',null,["v-bind:value" => "logo.name"])}}
                {{Form::hidden('uploadedLogoPath',null,["v-bind:value" => "logo.path"])}}
                <div class="btn-col">
                    <input type="file" id="logo" id="logo" v-bind:class="{'invalid-control':logoErrors.uploadImage}"
                           v-on:change="changeLogo" data-data="{{$data->toJsonLogo()}}" style="display: none">
                    <label for="logo" class="btn btn-primary">写真を選択</label>
                </div>
                <div class="btn-col  btn-row-sm">
                    <button type="button" class="btn btn-secondary" v-if="logo.url" v-on:click="deleteLogo">
                        <span>写真を削除</span>
                    </button>
                </div>
                @include('admin.common.vue_input_error', ['target' => 'logoErrors.uploadImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'logo'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'uploadedLogoName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'uploadedLogoPath'])--}}
                <div id="existingLogo" class="mb-2 logo" style="display: none;">
                    <img {{--v-if="logo.url"--}} v-bind:src="logo.url" alt="企業ロゴ">
                </div>
                {{Form::hidden('uploadedLogoName',null,["v-bind:value" => "logo.name","id"=>"uploadedLogoName"])}}
                {{Form::hidden('uploadedLogoPath',null,["v-bind:value" => "logo.path","id"=>"uploadedLogoPath"])}}
                <div class="btn-col">
                    <input type="file" id="logo" data-data="{{$data->toJsonLogo()}}" style="display: none">
                    {{--<input type="file" id="logo" id="logo" v-bind:class="{'invalid-control':logoErrors.uploadImage}"
                           v-on:change="changeLogo" data-data="{{$data->toJsonLogo()}}" style="display: none">--}}
                    <label for="logo" class="btn btn-primary">写真を選択</label>
                </div>
                <div class="btn-col  btn-row-sm">
                    <button type="button" class="btn btn-secondary" {{--v-if="logo.url" v-on:click="deleteLogo"--}} id="deleteLogo">
                        <span>写真を削除</span>
                    </button>
                </div>
                @include('admin.common.vue_input_error', ['target' => 'logoErrors.uploadImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'logo'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'uploadedLogoName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'uploadedLogoPath'])
            </td>
        </tr>
        </tbody>
    </table>

    <strong>連絡先</strong>
    <table class="table table-form mb-5">
        <colgroup>
            <col class="w-20">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th class="required-icon">
                担当者名
            </th>
            <td class="{{!empty($errors->has('picName')) ? 'invalid-form' : ''}}">
                {{Form::text('picName', $data->get("picName"), ["class" => "form-control invalid-control", 'placeholder'=>'例）後藤　剛志', "maxlength" => 24])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'picName'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                連絡先電話番号
            </th>
            <td class="{{!empty($errors->has('picPhoneNumber')) ? 'invalid-form' : ''}}">
                {{Form::tel('picPhoneNumber', $data->get("picPhoneNumber"), ["class" => "form-control invalid-control", 'placeholder'=>'例）0364449999', "maxlength" => 15])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'picPhoneNumber'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                緊急連絡先電話番号
            </th>
            <td class="{{!empty($errors->has('picEmergencyPhoneNumber')) ? 'invalid-form' : ''}}">
                {{Form::tel('picEmergencyPhoneNumber', $data->get("picEmergencyPhoneNumber"), ["class" => "form-control invalid-control", 'placeholder'=>'例）0364449999', "maxlength" => 15])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'picEmergencyPhoneNumber'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                連絡先メールアドレス
            </th>
            <td class="{{!empty($errors->has('picMailAddress')) ? 'invalid-form' : ''}}">
                {{Form::email('picMailAddress', $data->get("picMailAddress"), ["class" => "form-control invalid-control", 'placeholder'=>'例）example@linkt.jp', "maxlength" => 255])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'picMailAddress'])
            </td>
        </tr>
        </tbody>
    </table>

    <strong>企業PR</strong>
    <table class="table table-form mb-5">
        <colgroup>
            <col class="w-20">
            <col>
        </colgroup>
        <tbody>
        <tr v-cloak>
            <th>
                企業画像（最大3枚）
            </th>
            <td class="invalid-form">
                <additional id="file-company-image" data="{{$data->toJsonCompanyImages($errors)}}" :max="3" ref="companyImage" :initial-add="true">
                    <template slot="field" slot-scope="component">
                        {{--<div v-for="(file, index) in component.data" class="file" :key="index">
                            <div class="mb-2 {{!empty($errors->has('displayImage')) ? 'invalid-form' : ''}}">
                                {{Form::radio('displayImage',"index", '', ["v-if"=>"file.url", "v-bind:id"=>"'displayImage_' + index", "v-bind:value"=>"index", ":checked"=>"file.checked", "class"=>(!empty($errors->has('displayImage')) ? "invalid-control" : "")])}}
                                <label v-bind:for="'displayImage_' + index" v-if="file.url">一覧に表示</label>
                            </div>
                            <div class="mb-2 company-image" v-if="file.url">
                                <img v-bind:src="file.url">
                            </div>
                            <div class="btn-col">
                                <input type="file" v-bind:id="'js-companyImage_' + index" v-on:change="changeCompanyImage" v-bind:class="{'invalid-control':companyImageErrors.uploadImage}"
                                       style="display: none">
                                <label v-bind:for="'js-companyImage_' + index" class="btn btn-primary">写真を選択</label>
                            </div>
                            <div class="btn-col">
                                <button v-bind:id="'companyImageRemove_' + index" type="button" class="btn btn-secondary" v-if="file.url" v-on:click="component.remove(index)">
                                    <span>写真を削除</span>
                                </button>
                            </div>
                            {{Form::hidden('companyImageNames[]',null,["v-bind:value" => "file.name"])}}
                            {{Form::hidden('companyImagePaths[]',null,["v-bind:value" => "file.path"])}}
                            @include('admin.common.vue_input_error', ['target' => 'file.fileError'])
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary w-25" v-if="component.addable" v-on:click="component.add()">
                                <span>写真を追加</span>
                            </button>
                        </div>--}}
                        <div id="corporate_image">
                            <div class="company_file" id="selectFile_0" class="file" counter="0">
                                <div id="selectBox_0" class="mb-2" style="display: none;">
                                    <input id="displayImage_0" name="displayImage" type="radio" value="0" checked>
                                    <label for="displayImage_0">一覧に表示</label>
                                </div>
                                <div id="existingCompanyImage_0" class="mb-2 company-image">
                                    <img src="">
                                </div>
                                <div class="btn-col">
                                    <input type="file" class="companyImg" counter="0" id="js-companyImage_0" style="display: none;">
                                    <label for="js-companyImage_0" class="btn btn-primary">写真を選択</label>
                                </div>
                                <div class="btn-col">
                                    <button id="companyImageRemove_0" type="button" class="delete removeCompanyImage_0 btn btn-primary" counter="0" style="display: none;">写真を削除</button>
                                </div>
                                <input id="companyImageNames_0" name="companyImageNames[]" type="hidden" value="">
                                <input id="companyImagePaths_0" name="companyImagePaths[]" type="hidden" value="">
                            </div>
                        </div>

                        <div>
                            <button id="addClientImageButton" type="button" class="btn btn-primary w-25" {{--v-if="component.addable" v-on:click="component.add()"--}}>
                                <span>写真を追加</span>
                            </button>
                        </div>
                    </template>
                </additional>
                @include('admin.common.vue_input_error', ['target' => 'companyImageErrors.uploadImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'displayImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'companyImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'companyImageNames'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'companyImagePaths'])
            </td>
        </tr>
        <tr>
            <th>
                企業紹介文
            </th>
            <td class="{{!empty($errors->has('introductorySentence')) ? 'invalid-form' : ''}}">
                {{Form::textarea('introductorySentence', $data->get("introductorySentence"), ["class" => "form-control invalid-control", 'placeholder'=>'例）当社は、企業と学生の1:1のマッチングを可能にする次世代型就活サイトLinkTの運営会社です。',"rows"=>"7"])}}
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'introductorySentence'])
            </td>
        </tr>
        <tr>
            <th>
                PR動画（自動再生）
            </th>
            <td class="invalid-form">
                <div class="mb-2 video" v-if="prVideo.url">
                    <video controls="" muted="" poster="" v-bind:src="prVideo.url" class="js-pr-video-pre">
                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                    </video>
                </div>
                <div class="btn-col">
                    <input type="file" id="prVideo" v-on:change="uploadPrVideo" data-data="{{$data->toJsonPrVideo()}}" v-bind:class="{'invalid-control':prVideoErrors.uploadVideo}"
                           style="display: none">
                    <label for="prVideo" class="btn btn-primary">動画を選択</label>
                </div>
                <div class="btn-col">
                    <button type="button" class="btn btn-secondary" v-if="prVideo.url" v-on:click="deletePrVideo">
                        <span>動画を削除</span>
                    </button>
                </div>
                {{Form::hidden('prVideoName',null,["v-bind:value" => "prVideo.name"])}}
                {{Form::hidden('prVideoPath',null,["v-bind:value" => "prVideo.path"])}}
                @include('admin.common.vue_input_error', ['target' => 'prVideoErrors.uploadVideo'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideo'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoPath'])
            </td>
        </tr>
        <tr v-cloak>
            <th>
                5秒動画
            </th>
            <td class="invalid-form">
                <div class="mb-2 video" v-if="video5s.url">
                    <video controls="" muted="" poster="" v-bind:src="video5s.url" class="js-video-5s-pre">
                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                    </video>
                </div>
                <div class="btn-col">
                    <input type="file" id="video5s" v-on:change="uploadVideo5s" data-data="{{$data->toJsonVideo5s()}}" v-bind:class="{'invalid-control':video5sErrors.uploadVideo}"
                           style="display: none">
                    <label for="video5s" class="btn btn-primary">動画を選択</label>
                </div>
                <div class="btn-col" v-if="video5s.url">
                    <button type="button" class="btn btn-secondary" v-on:click="deleteVideo5s">
                        <span>動画を削除</span>
                    </button>
                </div>
                {{Form::hidden('video5sName',null,["v-bind:value" => "video5s.name"])}}
                {{Form::hidden('video5sPath',null,["v-bind:value" => "video5s.path"])}}
                @include('admin.common.vue_input_error', ['target' => 'video5sErrors.uploadVideo'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video5s'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sPath'])
                <div class="mb-2 video-thumbs" v-if="video5sThumb.url">
                    <img v-bind:src="video5sThumb.url" alt="5秒動画サムネイル画像">
                </div>
                <div class="btn-col">
                    <input type="file" id="video5sThumb" v-on:change="changeVideo5sThumb" data-data="{{$data->toJsonVideo5sThumb()}}" v-bind:class="{'invalid-control':video5sThumbErrors.uploadImage}"
                           style="display: none">
                    <label for="video5sThumb" class="btn btn-primary">サムネイル画像を選択</label>
                </div>
                <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                <div class="btn-col" v-if="video5sThumb.url" >
                    <button type="button" class="btn btn-secondary" v-on:click="deleteVideo5sThumb">
                        <span>サムネイル画像を削除</span>
                    </button>
                </div>
                {{Form::hidden('video5sThumbName',null,["v-bind:value" => "video5sThumb.name"])}}
                {{Form::hidden('video5sThumbPath',null,["v-bind:value" => "video5sThumb.path"])}}
                @include('admin.common.vue_input_error', ['target' => 'video5sThumbErrors.uploadImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sThumb'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sThumbName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sThumbPath'])
                <div v-if="video5s.url">
                    <p>タイトル (最大9文字)</p>
                    <div class="mb-2 {{!empty($errors->has('video5sTitle')) ? 'invalid-form' : ''}}">
                        {{Form::text('video5sTitle', $data->get("video5s.title"), ["class" => (!empty($errors->has('video5sTitle')) ? "form-control invalid-control w-75" : "w-75"), "id"=>"video5sTitle", 'placeholder'=>'タイトル', "maxlength" => 9])}}
                        @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sTitle'])
                    </div>
                </div>
            </td>
        </tr>
        <tr v-cloak>
            <th>
                10秒動画
            </th>
            <td class="invalid-form">
                <div class="mb-2 video" v-if="video10s.url">
                    <video controls="" muted="" poster="" v-bind:src="video10s.url" class="js-video-10s-pre">
                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                    </video>
                </div>
                <div class="btn-col">
                    <input type="file" id="video10s" v-on:change="uploadVideo10s" data-data="{{$data->toJsonVideo10s()}}" v-bind:class="{'invalid-control':video10sErrors.uploadVideo}"
                           style="display: none">
                    <label for="video10s" class="btn btn-primary">動画を選択</label>
                </div>
                <div class="btn-col" v-if="video10s.url">
                    <button type="button" class="btn btn-secondary" v-on:click="deleteVideo10s">
                        <span>動画を削除</span>
                    </button>
                </div>
                {{Form::hidden('video10sName',null,["v-bind:value" => "video10s.name"])}}
                {{Form::hidden('video10sPath',null,["v-bind:value" => "video10s.path"])}}
                @include('admin.common.vue_input_error', ['target' => 'video10sErrors.uploadVideo'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video10s'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sPath'])
                <div class="mb-2 video-thumbs" v-if="video10sThumb.url">
                    <img v-bind:src="video10sThumb.url" alt="10秒動画サムネイル画像">
                </div>
                <div class="btn-col">
                    <input type="file" id="video10sThumb" v-on:change="changeVideo10sThumb" data-data="{{$data->toJsonVideo10sThumb()}}"
                           v-bind:class="{'invalid-control':video10sThumbErrors.uploadImage}" style="display: none">
                    <label for="video10sThumb" class="btn btn-primary">サムネイル画像を選択</label>
                </div>
                <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                <div class="btn-col" v-if="video10sThumb.url" >
                    <button type="button" class="btn btn-secondary" v-on:click="deleteVideo10sThumb">
                        <span>サムネイル画像を削除</span>
                    </button>
                </div>
                {{Form::hidden('video10sThumbName',null,["v-bind:value" => "video10sThumb.name"])}}
                {{Form::hidden('video10sThumbPath',null,["v-bind:value" => "video10sThumb.path"])}}
                @include('admin.common.vue_input_error', ['target' => 'video10sThumbErrors.uploadImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sThumb'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sThumbName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sThumbPath'])
                <div v-if="video10s.url">
                    <p>タイトル (最大9文字)</p>
                    <div class="mb-2 {{!empty($errors->has('video10sTitle')) ? 'invalid-form' : ''}}">
                        {{Form::text('video10sTitle', $data->get("video10s.title"), ["class" => (!empty($errors->has('video10sTitle')) ? "form-control invalid-control w-75" : "w-75"), "id"=>"video10sTitle", 'placeholder'=>'タイトル', "maxlength" => 9])}}
                        @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sTitle'])
                    </div>
                </div>
            </td>
        </tr>
        <tr v-cloak>
            <th>
                15秒動画
            </th>
            <td class="invalid-form">
                <div class="mb-2 video" v-if="video15s.url">
                    <video controls="" muted="" poster="" v-bind:src="video15s.url" class="js-video-15s-pre">
                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                    </video>
                </div>
                <div class="btn-col">
                    <input type="file" id="video15s" v-on:change="uploadVideo15s" data-data="{{$data->toJsonVideo15s()}}" v-bind:class="{'invalid-control':video15sErrors.uploadVideo}"
                           style="display: none">
                    <label for="video15s" class="btn btn-primary">動画を選択</label>
                </div>
                <div class="btn-col" v-if="video15s.url">
                    <button type="button" class="btn btn-secondary" v-on:click="deleteVideo15s">
                        <span>動画を削除</span>
                    </button>
                </div>
                {{Form::hidden('video15sName',null,["v-bind:value" => "video15s.name"])}}
                {{Form::hidden('video15sPath',null,["v-bind:value" => "video15s.path"])}}
                @include('admin.common.vue_input_error', ['target' => 'video15sErrors.uploadVideo'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video15s'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sPath'])
                <div class="mb-2 video-thumbs" v-if="video15sThumb.url">
                    <img v-bind:src="video15sThumb.url" alt="15秒動画サムネイル画像">
                </div>
                <div class="btn-col">
                    <input type="file" id="video15sThumb" v-on:change="changeVideo15sThumb" data-data="{{$data->toJsonVideo15sThumb()}}"
                           v-bind:class="{'invalid-control':video15sThumbErrors.uploadImage}" style="display: none">
                    <label for="video15sThumb" class="btn btn-primary">サムネイル画像を選択</label>
                </div>
                <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                <div class="btn-col" v-if="video15sThumb.url" >
                    <button type="button" class="btn btn-secondary" v-on:click="deleteVideo15sThumb">
                        <span>サムネイル画像を削除</span>
                    </button>
                </div>
                {{Form::hidden('video15sThumbName',null,["v-bind:value" => "video15sThumb.name"])}}
                {{Form::hidden('video15sThumbPath',null,["v-bind:value" => "video15sThumb.path"])}}
                @include('admin.common.vue_input_error', ['target' => 'video15sThumbErrors.uploadImage'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sThumb'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sThumbName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sThumbPath'])
                <div v-if="video15s.url">
                    <p>タイトル (最大9文字)</p>
                    <div class="mb-2 {{!empty($errors->has('video15sTitle')) ? 'invalid-form' : ''}}">
                        {{Form::text('video15sTitle', $data->get("video15s.title"), ["class" => (!empty($errors->has('video15sTitle')) ? "form-control invalid-control w-75" : "w-75"), "id"=>"video15sTitle", 'placeholder'=>'タイトル', "maxlength" => 9])}}
                        @include('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sTitle'])
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                当社の紹介<br>（最大6つ）
            </th>
            <td>
                <additional id="file-feature" data="{{$data->toJsonFeature($errors)}}" :max="6" ref="feature" :initial-add="true">
                    <template slot="field" slot-scope="component">
                        <div v-for="(file, index) in component.data" class="file">
                            <div class="mb-5 invalid-form">
                                <p>動画・画像</p>
                                <div class="mb-2 video" v-if="file.url && file.type === {{ \App\Domain\Entities\CompanyUploadedFile::MOVIE_CONTENT }}">
                                    <video controls="" muted="" poster="" v-bind:src="file.url" class="js-feature-video-pre">
                                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                </div>
                                <div class="mb-2 video-thumbs" v-if="file.url && file.type === {{ \App\Domain\Entities\CompanyUploadedFile::IMAGE_CONTENT }}">
                                    <img v-bind:src="file.url">
                                </div>
                                <div class="btn-col">
                                    <input v-bind:id="'js-feature-video_' + index" type="file" v-on:change="uploadFeatureVideo" v-bind:class="{'invalid-control':featureErrors.uploadVideo}"
                                           style="display: none">
                                    <label v-bind:for="'js-feature-video_' + index" class="btn btn-primary">動画を選択</label>
                                </div>
                                <div class="btn-col">
                                    <input v-bind:id="'js-feature-image_' + index" type="file" v-on:change="uploadFeatureImage" v-bind:class="{'invalid-control':featureErrors.uploadImage}"
                                           style="display: none">
                                    <label v-bind:for="'js-feature-image_' + index" class="btn btn-primary">画像を選択</label>
                                </div>
                                <div class="btn-col" v-if="file.url && file.type === {{ \App\Domain\Entities\CompanyUploadedFile::MOVIE_CONTENT }}">
                                    <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                        <span>動画を削除</span>
                                    </button>
                                </div>
                                <div class="btn-col" v-if="file.url && file.type === {{ \App\Domain\Entities\CompanyUploadedFile::IMAGE_CONTENT }}">
                                    <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                        <span>画像を削除</span>
                                    </button>
                                </div>
                                {{Form::hidden('featureNames[]',null,["v-bind:value" => "file.name"])}}
                                {{Form::hidden('featurePaths[]',null,["v-bind:value" => "file.path"])}}
                                {{Form::hidden('featureTypes[]',null,["v-bind:value" => "file.type"])}}
                                @include('admin.common.vue_input_error', ['target' => 'featureErrors.uploadVideo'])
                                @include('admin.common.vue_input_error', ['target' => 'featureErrors.uploadImage'])
                                @include('admin.common.vue_input_error', ['target' => 'file.fileError'])
                                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'feature'])
                                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'featureNames'])
                                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'featurePaths'])
                                <p>タイトル (最大24文字)</p>
                                <div class="mb-2">
                                    {{Form::text('featureTitles[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':file.titleError}", "v-bind:id" => "'feature-title_' + index", "placeholder"=>"例）業界最大手の企業", "v-bind:value"=>"file.title", "v-on:input"=>"setFeatureTitle", "maxlength" => 24])}}
                                </div>
                                @include('admin.common.vue_input_error', ['target' => 'file.titleError'])
                                <p>説明文</p>
                                <div class="mb-2">
                                    {{Form::textarea('featureDescriptions[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':file.descriptionError}", "v-bind:id" => "'feature-description_' + index", "placeholder"=>"例）当社は業界の中で日本最大手の企業です。","rows"=>"10", "v-bind:value"=>"file.description", "v-on:input"=>"setFeatureDescription"])}}
                                </div>
                                @include('admin.common.vue_input_error', ['target' => 'file.descriptionError'])
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary w-50" v-if="component.addable" v-on:click="component.add()">
                                <span>動画・画像を追加</span>
                            </button>
                        </div>
                    </template>
                </additional>
            </td>
        </tr>
        <tr>
            <th>
                ハッシュタグ<br>（最大16文字）
            </th>
            <td>
                <div class="input-group col-sm-6 col-xl-4 {{!empty($errors->has('hashtag')) ? 'invalid-form' : ''}}">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0"><h3>#</h3></div>
                    </div>
                    {{Form::text('hashtag', $data->get("hashtag"), ["class" => "form-control invalid-control w-75", 'placeholder'=>'例）イケメン多数', "maxlength" => 16])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'hashtag'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
            {{--<th>--}}
                ハッシュタグカラー
            </th>
            <td class="{{!empty($errors->has('hashtag')) ? 'invalid-form' : ''}}">
                <div class="custom-control-inline color">
                    <div class="radio__color">
                        {{Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_RED, (empty($data->get("hashTagColor"))|| $data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_RED)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"red"])}}
                        <label for="red"><span class="tag--red">&nbsp;</span></label>
                    </div>
                    <div class="radio__color">
                        {{Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_BLUE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_BLUE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"blue"])}}
                        <label for="blue"><span class="tag--blue">&nbsp;</span></label>
                    </div>
                    <div class="radio__color">
                        {{Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_GREEN, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_GREEN)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"green"])}}
                        <label for="green"><span class="tag--green">&nbsp;</span></label>
                    </div>
                    <div class="radio__color">
                        {{Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_ORANGE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_ORANGE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"orange"])}}
                        <label for="orange"><span class="tag--orange">&nbsp;</span></label>
                    </div>
                    <div class="radio__color">
                        {{Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_PURPLE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_PURPLE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"purple"])}}
                        <label for="purple"><span class="tag--purple">&nbsp;</span></label>
                    </div>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'hashTagColor'])
            </td>
        </tr>
        <tr>
            <th>
                募集タグ
            </th>
            <td class="{{!empty($errors->has('recruitmentTargetYear')) || !empty($errors->has('recruitmentTargetThisYear')) || !empty($errors->has('recruitmentTargetIntern')) ? 'invalid-form' : ''}}">
                <div class="recruitment-tags">
                    {{Form::checkbox('recruitmentTargetYear', 1, ($data->get("recruitmentTargetYear") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetYear"])}}
                    <label for="recruitmentTargetYear">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::THIS_YEAR]}}</label>
                    {{Form::checkbox('recruitmentTargetThisYear', 1, ($data->get("recruitmentTargetThisYear") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetThisYear"])}}
                    <label for="recruitmentTargetThisYear">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::NEXT_YEAR]}}</label>
                    {{Form::checkbox('recruitmentTargetIntern', 1, ($data->get("recruitmentTargetIntern") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetIntern"])}}
                    <label for="recruitmentTargetIntern">{{\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::INTERN]}}</label>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentTargetYear'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentTargetThisYear'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentTargetIntern'])
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
                    {{Form::textarea('managementMemo', $data->get("managementMemo"), ["class" => "form-control invalid-control"])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'managementMemo'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                登録アカウント
            </th>
            <td>
                <p>氏名</p>
                <div class="row">
                    <div class="input-group col-sm-6 col-xl-4 {{!empty($errors->has('lastName')) ? 'invalid-form' : ''}}">
                        <div class="input-group-prepend">
                            <div class="input-group-text input-group-transparent pl-0">姓</div>
                        </div>
                        {{Form::text('lastName', '', ["class" => "form-control invalid-control", "placeholder" => "例）陸", 'maxlength' => 16])}}
                    </div>
                    <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 {{!empty($errors->has('firstName')) ? 'invalid-form' : ''}}">
                        <div class="input-group-prepend">
                            <div class="input-group-text input-group-transparent pl-0">名</div>
                        </div>
                        {{Form::text('firstName', '', ["class" => "form-control invalid-control", "placeholder" => "例）太郎", 'maxlength' => 16])}}
                    </div>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'lastName'])
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'firstName'])
                <br>
                <p>氏名かな</p>
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
                <br>
                <p>メールアドレス</p>
                <div class="{{!empty($errors->has('mailAddress')) ? 'invalid-form' : ''}}">
                    {{Form::email('mailAddress', $data->get("mailAddress"), ["class" => "form-control invalid-control", 'placeholder'=>'例）example@linkt.jp', "maxlength" => 255])}}
                    @include('admin.common.input_error', ['errors' => $errors, 'target' => 'mailAddress'])
                    @if(!empty($errors) && !empty($errors->get("business_exception")['business.duplication.mail_address']))
                        @include('admin.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'])
                    @endif
                </div>
                <br>
                <p>パスワード</p>
                <div class="{{!empty($errors->has('password')) ? 'invalid-form' : ''}}">
                    {{Form::text('password', $data->get("password"), ["class" => "form-control invalid-control", "maxlength" => 14])}}
                    @include('admin.common.input_error', ['errors' => $errors, 'target' => 'password'])
                </div>
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                ステータス
            </th>
            <td class="{{!empty($errors->has('status')) ? 'invalid-form' : ''}}">
                <div class="custom-control-inline">
                    <div>
                        {{Form::radio('status', \App\Domain\Entities\Company::STATUS_VISIBLE, (empty($data->get("status"))|| $data->get("status") === \App\Domain\Entities\Company::STATUS_VISIBLE)? "checked='checked'":'', ["class" =>  "invalid-control", "id"=>"visible"])}}
                        <label for="visible"><span>表示</span></label>
                    </div>
                    <div class="mx-3">
                        {{Form::radio('status', \App\Domain\Entities\Company::STATUS_INVISIBLE, (empty($data->get("status"))|| $data->get("status") === \App\Domain\Entities\Company::STATUS_INVISIBLE)? "checked='checked'":'', ["class" =>  "invalid-control", "id"=>"invisible"])}}
                        <label for="invisible"><span>非表示</span></label>
                    </div>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'status'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                求人枠
            </th>
            <td>
                <div class="{{!empty($errors->has('jobApplicationAvailableNumber')) ? 'invalid-form' : ''}}">
                    {{Form::select('jobApplicationAvailableNumber',  \App\Domain\Entities\Company::JOB_APPLICATION_AVAILABLE_NUMBERS, $data->get("jobApplicationAvailableNumber"), ["class" => "form-control invalid-control"])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'jobApplicationAvailableNumber'])
            </td>
        </tr>
        </tbody>
    </table>

    <div class="btn-row btn-row">
        <div class="btn-col btn-row-sm">
            <button type="button" class="btn btn-secondary btn-lg js-btn-link" data-href="{{route("admin.company.reload")}}">
                <i class="iconfont iconfont-times-circle icon-lg" aria-hidden="true"></i>
                <span>キャンセルする</span>
            </button>
        </div>
        <div class="btn-col btn-row-sm">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-create">
                <i class="iconfont iconfont-plus-circle icon-lg" aria-hidden="true"></i>
                <span>登録する</span>
            </button>
        </div>
    </div>

    <a href="{{route('admin.company.reload')}}">< 企業一覧に戻る</a>
    {{Form::close()}}
{{--     モーダル読み込み--}}
    @include('admin.common.modals.create_modal')
    <!-- Modal -->
    <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="img-container">
                        <img id="blah" src="#" alt="your image" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cropImage" type="button" class="btn btn-info" pic_type="" data-dismiss="modal">トリミング</button>
                </div>
            </div>
        </div>
    </div>
@stop
