<?php $__env->startSection('title','基本情報の編集│企業編集｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/company-edit/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/company-edit/cropper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/company-edit/bootstrap_custom.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
    <script>
        $(function () {
            $('#zip + .js-zip').on('click', function () {
                AjaxZip3.zip2addr('zip', '', 'prefectures', 'city');
                return false;
            });
        });

        $(function () {
            <?php if(session('success') === 'edit'): ?>
            $('#edit-complete').show();
            setTimeout(function () {
                $('#edit-complete').fadeOut(1500);
            }, 2000);
            <?php endif; ?>
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/company/cropper.min.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            if($('.company_file').length >= 3){
                $("#addClientImageButton").hide();
            }

            $("#addClientImageButton").click(function() {
                var div_count = $('.company_file').length;
                if(div_count < 4){
                    if(div_count == 0){
                        var index = 0;
                        var radio_button = '        <input id="displayImage_'+index+'" name="displayImage" type="radio" value="'+index+'" checked>\n' ;
                    }else{
                        var index = Number($('.company_file').last().attr('counter')) + 1;
                        var radio_button = '        <input id="displayImage_'+index+'" name="displayImage" type="radio" value="'+index+'">\n';
                    }
                    // Selecting last id
                    var html = '<div id="selectFile_'+index+'" counter="'+index+'" class="company_file file">\n' +
                        '    <div id="selectBox_'+index+'" style="display: none">\n' +
                        radio_button +
                        '        <label for="displayImage_'+index+'">一覧に表示</label>\n' +
                        '    </div>\n' +
                        '    <div id="existingCompanyImage_'+index+'" class="company-image">\n' +
                        '      <img src="">\n' +
                        '  \t</div>\n' +
                        '    <input type="file" counter="'+index+'" id="js-companyImage_'+index+'" class="companyImg" style="display: none;">\n' +
                        '    <label for="js-companyImage_'+index+'">写真を選択</label>\n' +
                        '    <button id="companyImageRemove_'+index+'" type="button" counter="'+index+'" class="delete removeCompanyImage_'+index+'" style="display:none;">写真を削除</button>\n' +
                        '    <input id="companyImageNames_'+index+'" name="companyImageNames[]" type="hidden" value="">\n' +
                        '    <input id="companyImagePaths_'+index+'" name="companyImagePaths[]" type="hidden" value="">\n' +
                        '</div>';
                    // Create clone
                    $( "#company-image>.additional" ).append( html );

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
                //var result = document.getElementById('logoPreview');
                var existingPic = document.getElementById('existingLogo');
            }else if(uploadImageType == 'companyImage_'+uploadImageTypeIndex){
                //var result = document.getElementById('companyImagePreview_0');
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
                        url: '<?php echo route('client.company-edit.basic-information.upload'); ?>',
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
                            //result.innerHTML = '';
                            //result.appendChild(croppedImg);
                            //existingPic.style.display = "none";
                            //result.style.display = "block";
                            var json_response = jQuery.parseJSON( response.responseText );
                            var path = json_response.path;
                            var url = json_response.url;
                            if(uploadImageType == 'uploadedLogo'){
                                $('#existingLogo img').attr('src',url);
                                $('#uploadedLogoPath').val(path);
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

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vue'); ?>
    <script src="<?php echo e(asset('js/company/basic_information_edit_vue.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li>企業編集</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content" id="edit-client" data-upload-url="<?php echo e(route('client.company-edit.basic-information.upload')); ?>">
        <div class="alert" id="edit-complete"  style="display: none">変更しました</div>
        <h2 class="main__content__headline">企業編集</h2>

        <div class="form__controls" style="margin-bottom: 1em;">
            <button class="preview js-btn-target-blank" data-href="<?php echo e(route('client.company-edit.basic-information.preview')); ?>">登録内容でプレビュー</button>
        </div>
        <section class="switchTab">
            <ul>
                <li class="active"><a href="<?php echo e(route('client.company-edit.basic-information')); ?>">基本情報</a></li>
                <li><a href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">求人一覧</a></li>
            </ul>
        </section>
        <?php echo e(Form::open(['url'=>route('client.company-edit.basic-information.store') ,'id' =>'form'])); ?>

        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="name">会社名</label></th>
                <td>
                    <?php echo e(Form::text('name', $data->get("name"), ["class" => (!empty($errors->has('name')) ? "invalid-control" : ""), "id"=>"name","placeholder" => "例）株式会社infit", "maxlength" => 56])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['name']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="nameKana">会社名（かな）</label></th>
                <td>
                    <?php echo e(Form::text('nameKana', $data->get("nameKana"), ["class" => (!empty($errors->has('nameKana')) ? "invalid-control" : ""), "id"=>"nameKana","placeholder" => "例）かぶしきがいしゃいんふぃっと", "maxlength" => 56])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['nameKana']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="zip">本社所在地</label></th>
                <td>
                    <div class="address">
                        <div>
                            〒<?php echo e(Form::tel('zip', $data->get("zip"), ["class" => (!empty($errors->has('zip')) ? "invalid-control" : ""), "id"=>"zip", "placeholder" => "例）1500021", "maxlength" => 7])); ?>

                            <button type="button" class="button zip js-zip">住所を検索</button>
                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['zip']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('prefectures', $data->get("prefectureList"), $data->get("prefectures"), ["class" => (!empty($errors->has('prefectures')) ? "invalid-control" : ""), "id"=>"prefectures", "placeholder" => "都道府県"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['prefectures']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div>
                            <label for="city">市区町村</label>
                            <?php echo e(Form::text('city', $data->get("city"), ["class" => (!empty($errors->has('city')) ? "invalid-control width100" : "width100"), "id"=>"city", "maxlength" =>56, "placeholder" => "例）渋谷区恵比寿西2-2-8"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['city']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div>
                            <label for="room">建物名・階数など</label>
                            <?php echo e(Form::text('room', $data->get("room"), ["class" => (!empty($errors->has('room')) ? "invalid-control width100" : "width100"), "id"=>"room", "maxlength" =>56, "placeholder" => "例）えびす第2ビル2F"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['room']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="industryCondition">業種</label></th>
                <td>
                    <div class="<?php echo e(!empty($errors->has('industryCondition.0')) ? 'invalid-form' : ''); ?>">
                        <select multiple class="form-control invalid-control select2-multiple" name="industryCondition[]">
                            <?php $__currentLoopData = $data->get("businessTypeList"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $businessTypeKey => $businessTypeVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(old('industryCondition') && empty($errors->has('industryCondition.0'))): ?>
                                    <?php if(in_array($businessTypeKey, old('industryCondition'))): ?>
                                        <option selected value="<?php echo e($businessTypeKey); ?>"><?php echo e($businessTypeVal); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo e($businessTypeKey); ?>"><?php echo e($businessTypeVal); ?></option>
                                    <?php endif; ?>
                                <?php elseif(in_array($businessTypeKey, $data->get("industryCondition")->toArray())): ?>
                                    <option selected value="<?php echo e($businessTypeKey); ?>"><?php echo e($businessTypeVal); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($businessTypeKey); ?>"><?php echo e($businessTypeVal); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['industryCondition.0']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="job-descriptionOfBusiness">事業内容</label></th>
                <td>
                    <?php echo e(Form::textarea('descriptionOfBusiness', $data->get("descriptionOfBusiness"), ["class" => (!empty($errors->has('descriptionOfBusiness')) ? "invalid-control width100" : "width100"), "id"=>"descriptionOfBusiness", "placeholder" => "例）次世代型就活サイト【LinkT】の企画・開発・運営"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['descriptionOfBusiness']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="establishmentDate">設立</label></th>
                <td>
                    <?php echo e(Form::text('establishmentDate', $data->get("establishmentDate"), ["class" => (!empty($errors->has('establishmentDate')) ? "invalid-control width100" : "width100"), "id"=>"establishmentDate", "placeholder" => "例）2019年3月5日", "maxlength" => 24])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['establishmentDate']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="capital"></label>資本金</th>
                <td>
                    <?php echo e(Form::text('capital', $data->get("capital"), ["class" => (!empty($errors->has('capital')) ? "invalid-control width100" : "width100"), "id"=>"capital", "placeholder" => "例）10,000,000円"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['capital']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="payrollNumber">従業員</label></th>
                <td>
                    <?php echo e(Form::text('payrollNumber', $data->get("payrollNumber"), ["class" => (!empty($errors->has('payrollNumber')) ? "invalid-control width100" : "width100"), "id"=>"payrollNumber", "placeholder" => "例）100人"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['payrollNumber']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="sales">売上高</label></th>
                <td>
                    <?php echo e(Form::text('sales', $data->get("sales"), ["class" => (!empty($errors->has('sales')) ? "invalid-control width100" : "width100"), "id"=>"sales", "placeholder" => "例）10,000,000円"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['sales']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="representativePerson">代表者</label></th>
                <td>
                    <?php echo e(Form::text('representativePerson', $data->get("representativePerson"), ["class" => (!empty($errors->has('representativePerson')) ? "invalid-control width100" : "width100"), "id"=>"representativePerson", "placeholder" => "例）代表取締役　後藤剛志","maxlength" => 24])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['representativePerson']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="exectiveOfficers">役員構成</label></th>
                <td>
                    <?php echo e(Form::textarea('exectiveOfficers', $data->get("exectiveOfficers"), ["class" => (!empty($errors->has('exectiveOfficers')) ? "invalid-control width100" : "width100"), "id"=>"exectiveOfficers", "rows"=>"7", "placeholder" => "例）取締役　中山勢二"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['exectiveOfficers']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="establishment">事業所</label></th>
                <td>
                    <?php echo e(Form::textarea('establishment', $data->get("establishment"), ["class" => (!empty($errors->has('establishment')) ? "invalid-control width100" : "width100"), "id"=>"establishment","rows"=>"4", "placeholder" => "例）東京都渋谷区恵比寿西2-2-8　えびす第2ビル2F"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['establishment']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="affiliatedCompany">関連会社</label></th>
                <td>
                    <?php echo e(Form::textarea('affiliatedCompany', $data->get("affiliatedCompany"), ["class" => (!empty($errors->has('affiliatedCompany')) ? "invalid-control width100" : "width100"), "id"=>"affiliatedCompany","rows"=>"4", "placeholder" => "例）株式会社電通"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['affiliatedCompany']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="qualification">登録・資格</label></th>
                <td>
                    <?php echo e(Form::textarea('qualification', $data->get("qualification"), ["class" => (!empty($errors->has('qualification')) ? "invalid-control width100" : "width100"), "id"=>"qualification","rows"=>"4", "placeholder" => "例）基本情報技術者"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['qualification']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                
                <th><label for="homePageUrl">ホームページURL</label></th>
                <td>
                    <?php echo e(Form::text('homePageUrl', $data->get("homePageUrl"), ["class" => (!empty($errors->has('homePageUrl')) ? "invalid-control width100" : "width100"), "id"=>"homePageUrl","placeholder" => "例）https://linkt.jp", "maxlength" => 255])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['homePageUrl']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="recruitmentUrl">採用ホームページ</label></th>
                <td>
                    <?php echo e(Form::text('recruitmentUrl', $data->get("recruitmentUrl"), ["class" => (!empty($errors->has('recruitmentUrl')) ? "invalid-control width100" : "width100"), "id"=>"recruitmentUrl","placeholder" => "例）https://linkt.jp", "maxlength" => 255])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['recruitmentUrl']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="mainClient">主要取引先</label></th>
                <td>
                    <?php echo e(Form::textarea('mainClient', $data->get("mainClient"), ["class" => (!empty($errors->has('mainClient')) ? "invalid-control width100" : "width100"), "id"=>"mainClient","rows"=>"4", "placeholder" => "例）株式会社長崎放送"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['mainClient']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            
            <tr v-cloak class="invalid-form">
                <th class="required"><label for="logo">企業ロゴ</label></th>
                <td>
                    <div class="logo">
                        <picture id="existingLogo">
                            <img id="logoImg" v-if="logo.url" v-bind:src="logo.url" alt="企業ロゴ">
                        </picture>
                        
                        <input type="file" id="logo" data-data="<?php echo e($data->toJsonLogo()); ?>">
                        
                        <label for="logo">写真を選択</label>
                        <?php echo e(Form::hidden('uploadedLogoName',null,["v-bind:value" => "logo.name","id"=>"uploadedLogoName"])); ?>

                        <?php echo e(Form::hidden('uploadedLogoPath',null,["v-bind:value" => "logo.path","id"=>"uploadedLogoPath"])); ?>

                        <button type="button" class="delete" v-if="logo.url" v-on:click="deleteLogo">写真を削除</button>
                    </div>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'logoErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['logo', 'uploadedLogoName', 'uploadedLogoPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
        </table>

        <h2 class="main__content__headline">連絡先</h2>
        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="picName">担当者名</label></th>
                <td>
                    <?php echo e(Form::text('picName', $data->get("picName"), ["class" => (!empty($errors->has('picName')) ? "invalid-control width100" : "width100"), 'id'=>"picName",'placeholder'=>'例）後藤剛志', "maxlength" => 24])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['picName']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="picPhoneNumber">連絡先電話番号</label></th>
                <td>
                    <?php echo e(Form::tel('picPhoneNumber', $data->get("picPhoneNumber"), ["class" => (!empty($errors->has('picPhoneNumber')) ? "invalid-control width100" : "width100"), 'id'=>"picPhoneNumber",'placeholder'=>'例）0364449999', "maxlength" => 15])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['picPhoneNumber']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="picEmergencyPhoneNumber">緊急連絡先電話番号</label></th>
                <td>
                    <?php echo e(Form::tel('picEmergencyPhoneNumber', $data->get("picEmergencyPhoneNumber"), ["class" => (!empty($errors->has('picEmergencyPhoneNumber')) ? "invalid-control width100" : "width100"), 'id'=>"picEmergencyPhoneNumber",'placeholder'=>'例）0364449999', "maxlength" => 15])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['picEmergencyPhoneNumber']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="picMailAddress">連絡先メールアドレス</label></th>
                <td>
                    <?php echo e(Form::email('picMailAddress', $data->get("picMailAddress"), ["class" => (!empty($errors->has('picMailAddress')) ? "invalid-control width100" : "width100"), "id"=>"picMailAddress", "maxlength" =>255,'placeholder'=>'例）example@linkt.jp'])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['picMailAddress']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
        </table>

        <h2 class="main__content__headline">企業PR</h2>
        <table class="form__table">
            <tr class="invalid-form company-image">
                <th class="required">
                    <label for="image">企業画像（最大3枚）</label>
                </th>
                
                <td v-cloak id="company-image" >
                    <additional id="file-company-image" data="<?php echo e($data->toJsonCompanyImages($errors)); ?>" :max="3" ref="companyImage" :initial-add="true">
                        <template slot="field" slot-scope="component">
                            <div v-for="(file, index) in component.data" class="company_file file" v-bind:id="'selectFile_'+index" v-bind:counter="index" :key="index">
                                <div v-bind:id="'selectBox_'+index" v-if="file.url" <?php echo e(!empty($errors->has('displayImage')) ? 'invalid-form' : ''); ?>>
                                    <input v-bind:id="'displayImage_'+index" name="displayImage" type="radio" v-bind:value="index" v-bind:checked="file.checked">
                                    <label v-bind:for="'displayImage_'+index">一覧に表示</label>
                                </div>
                                <div v-bind:id="'existingCompanyImage_'+index" class="company-image">
                                    <img v-bind:src="file.url">
                                </div>
                                <input type="file" class="companyImg" v-bind:counter="index" v-bind:id="'js-companyImage_'+index" style="display: none;">
                                <label v-bind:for="'js-companyImage_'+index">写真を選択</label>
                                <button v-bind:id="'companyImageRemove_'+index" type="button" v-bind:class="'delete removeCompanyImage_'+index" v-bind:counter="index" v-if="file.url">写真を削除</button>
                                <input v-bind:id="'companyImageNames_'+index" name="companyImageNames[]" type="hidden" v-bind:value="file.name">
                                <input v-bind:id="'companyImagePaths_'+index" name="companyImagePaths[]" type="hidden" v-bind:value="file.path">
                            </div>

                        </template>
                    </additional>
                    <button type="button" id="addClientImageButton" class="add" >写真を追加</button>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'companyImageErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['displayImage']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['companyImage', 'companyImageNames', 'companyImagePaths']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="introductorySentence">企業紹介文</label></th>
                <td>
                    <?php echo e(Form::textarea('introductorySentence', $data->get("introductorySentence"), ["class" => (!empty($errors->has('introductorySentence')) ? "invalid-control width100" : "width100"), "id"=>"introductorySentence","rows"=>"7", "placeholder" => "例）当社は、企業と学生の1:1のマッチングを可能にする次世代型就活サイトLinkTの運営会社です。"])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['introductorySentence']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="prVideo">PR動画（自動再生）</label></th>
                <td>
                    <div v-cloak class="video">
                        <video controls="" muted="" poster="" playsinline="" v-if="prVideo.url">
                            <source v-bind:src="prVideo.url" class="js-pr-video-pre">
                            <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                        </video>
                        <input type="file" id="prVideo" v-on:change="uploadPrVideo" data-data="<?php echo e($data->toJsonPrVideo()); ?>" v-bind:class="{'invalid-control':prVideoErrors.uploadVideo}">
                        <label for="prVideo">動画を選択</label>
                        <?php echo e(Form::hidden('prVideoName',null,["v-bind:value" => "prVideo.name"])); ?>

                        <?php echo e(Form::hidden('prVideoPath',null,["v-bind:value" => "prVideo.path"])); ?>

                        <button type="button" class="delete" v-if="prVideo.url" v-on:click="deletePrVideo">動画を削除</button>
                    </div>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'prVideoErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['prVideo', 'prVideoName', 'prVideoPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="video-5">5秒動画</label></th>
                <td class="video__sec">
                    <div v-cloak class="video">
                        <video controls="" muted="" poster="" playsinline="" v-if="video5s.url">
                            <source v-bind:src="video5s.url" class="js-video-5s-pre">
                            <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                        </video>
                        <input type="file" id="video5s" v-on:change="uploadVideo5s" data-data="<?php echo e($data->toJsonVideo5s()); ?>" v-bind:class="{'invalid-control':video5sErrors.uploadVideo}">
                        <label for="video5s">動画を選択</label>
                        <?php echo e(Form::hidden('video5sName',null,["v-bind:value" => "video5s.name"])); ?>

                        <?php echo e(Form::hidden('video5sPath',null,["v-bind:value" => "video5s.path"])); ?>

                        <button type="button" class="delete" v-if="video5s.url" v-on:click="deleteVideo5s">動画を削除</button>
                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'video5sErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video5s', 'video5sName', 'video5sPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <div v-cloak class="video-thumbs">
                        <img v-if="video5sThumb.url" v-bind:src="video5sThumb.url" alt="5秒動画サムネイル画像">
                        <input type="file" id="video5sThumb" v-on:change="changeVideo5sThumb" data-data="<?php echo e($data->toJsonVideo5sThumb()); ?>" v-bind:class="{'invalid-control':video5sThumbErrors.uploadImage}">
                        <label for="video5sThumb">サムネイル画像を選択</label>
                        <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                        <?php echo e(Form::hidden('video5sThumbName',null,["v-bind:value" => "video5sThumb.name"])); ?>

                        <?php echo e(Form::hidden('video5sThumbPath',null,["v-bind:value" => "video5sThumb.path"])); ?>

                        <button type="button" class="delete" v-on:click="deleteVideo5sThumb" v-if="video5sThumb.url">画像を削除</button>
                    </div>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'video5sThumbErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video5sThumb', 'video5sThumbName', 'video5sThumbPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div v-if="video5s.url">
                        <h3>タイトル (最大9文字)</h3>
                        <?php echo e(Form::text('video5sTitle', $data->get("video5s.title"), ["class" => (!empty($errors->has('video5sTitle')) ? "invalid-control width100" : "width100"), "id"=>"video5sTitle", "placeholder"=>"タイトル", "maxlength" =>9])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video5sTitle']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="video-10">10秒動画</label></th>
                <td class="video__sec">
                    <div v-cloak class="video">
                        <video controls="" muted="" poster="" playsinline="" v-if="video10s.url">
                            <source v-bind:src="video10s.url" class="js-video-10s-pre">
                            <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                        </video>
                        <input type="file" id="video10s" v-on:change="uploadVideo10s" data-data="<?php echo e($data->toJsonVideo10s()); ?>" v-bind:class="{'invalid-control':video10sErrors.uploadVideo}">
                        <label for="video10s">動画を選択</label>
                        <?php echo e(Form::hidden('video10sName',null,["v-bind:value" => "video10s.name"])); ?>

                        <?php echo e(Form::hidden('video10sPath',null,["v-bind:value" => "video10s.path"])); ?>

                        <button type="button" class="delete" v-if="video10s.url" v-on:click="deleteVideo10s">動画を削除</button>
                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'video10sErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video10s', 'video10sName', 'video10sPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <div v-cloak class="video-thumbs">
                        <img v-if="video10sThumb.url" v-bind:src="video10sThumb.url" alt="10秒動画サムネイル画像">
                        <input type="file" id="video10sThumb" v-on:change="changeVideo10sThumb" data-data="<?php echo e($data->toJsonVideo10sThumb()); ?>" v-bind:class="{'invalid-control':video10sThumbErrors.uploadImage}">
                        <label for="video10sThumb">サムネイル画像を選択</label>
                        <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                        <?php echo e(Form::hidden('video10sThumbName',null,["v-bind:value" => "video10sThumb.name"])); ?>

                        <?php echo e(Form::hidden('video10sThumbPath',null,["v-bind:value" => "video10sThumb.path"])); ?>

                        <button type="button" class="delete" v-on:click="deleteVideo10sThumb" v-if="video10sThumb.url">画像を削除</button>
                    </div>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'video10sThumbErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video10sThumb', 'video10sThumbName', 'video10sThumbPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div v-if="video10s.url">
                        <h3>タイトル (最大9文字)</h3>
                        <?php echo e(Form::text('video10sTitle', $data->get("video10s.title"), ["class" => (!empty($errors->has('video10sTitle')) ? "invalid-control width100" : "width100"), "id"=>"video10sTitle", "placeholder"=>"タイトル", "maxlength" =>9])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video10sTitle']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="video-15">15秒動画</label></th>
                <td class="video__sec">
                    <div v-cloak class="video">
                        <video controls="" muted="" poster="" playsinline="" v-if="video15s.url">
                            <source v-bind:src="video15s.url" class="js-video-15s-pre">
                            <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                        </video>
                        <input type="file" id="video15s" v-on:change="uploadVideo15s" data-data="<?php echo e($data->toJsonVideo15s()); ?>"  v-bind:class="{'invalid-control':video15sErrors.uploadVideo}">
                        <label for="video15s">動画を選択</label>
                        <?php echo e(Form::hidden('video15sName',null,["v-bind:value" => "video15s.name"])); ?>

                        <?php echo e(Form::hidden('video15sPath',null,["v-bind:value" => "video15s.path"])); ?>

                        <button type="button" class="delete" v-if="video15s.url" v-on:click="deleteVideo15s">動画を削除</button>
                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'video15sErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video15s', 'video15sName', 'video15sPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <div v-cloak class="video-thumbs">
                        <img v-if="video15sThumb.url" v-bind:src="video15sThumb.url" alt="15秒動画サムネイル画像">
                        <input type="file" id="video15sThumb" v-on:change="changeVideo15sThumb" data-data="<?php echo e($data->toJsonVideo15sThumb()); ?>"  v-bind:class="{'invalid-control':video15sThumbErrors.uploadImage}">
                        <label for="video15sThumb">サムネイル画像を選択</label>
                        <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                        <?php echo e(Form::hidden('video15sThumbName',null,["v-bind:value" => "video15sThumb.name"])); ?>

                        <?php echo e(Form::hidden('video15sThumbPath',null,["v-bind:value" => "video15sThumb.path"])); ?>

                        <button type="button" class="delete" v-on:click="deleteVideo15sThumb" v-if="video15sThumb.url">画像を削除</button>
                    </div>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'video15sThumbErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video15sThumb', 'video15sThumbName', 'video15sThumbPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div v-if="video15s.url">
                        <h3>タイトル (最大9文字)</h3>
                        <?php echo e(Form::text('video15sTitle', $data->get("video15s.title"), ["class" => (!empty($errors->has('video15sTitle')) ? "invalid-control width100" : "width100"), "id"=>"video15sTitle", "placeholder"=>"タイトル", "maxlength" =>9])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['video15sTitle']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="feature">当社の紹介（最大6つ）</label></th>
                <td v-cloak>
                    <div class="feature">
                        <h3>動画・画像</h3>
                        <additional id="file-feature" data="<?php echo e($data->toJsonFeature($errors)); ?>" :max="6" ref="feature" :initial-add="true">
                            <template slot="field" slot-scope="component">
                                <div v-for="(file, index) in component.data" class="file">
                                    <div>
                                        <video controls="" muted="" poster="" playsinline="" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::MOVIE_CONTENT); ?>">
                                            <source v-bind:src="file.url" class="js-feature-video-pre">
                                            <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                        </video>
                                        <img v-bind:src="file.url" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::IMAGE_CONTENT); ?>" >
                                        <input v-bind:id="'js-feature-video_' + index" type="file" v-on:change="uploadFeatureVideo" v-bind:class="{'invalid-control':featureErrors.uploadVideo}">
                                        <input v-bind:id="'js-feature-image_' + index" type="file" v-on:change="uploadFeatureImage" v-bind:class="{'invalid-control':featureErrors.uploadImage}">
                                        <label v-bind:for="'js-feature-video_' + index">動画を選択</label>
                                        <label v-bind:for="'js-feature-image_' + index" class="red-label">画像を選択</label>
                                        <button type="button" class="delete" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::MOVIE_CONTENT); ?>" v-on:click="component.remove(index)">動画を削除</button>
                                        <button type="button" class="delete" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::IMAGE_CONTENT); ?>" v-on:click="component.remove(index)">画像を削除</button>
                                        <?php echo e(Form::hidden('featureNames[]',null,["v-bind:value" => "file.name"])); ?>

                                        <?php echo e(Form::hidden('featurePaths[]',null,["v-bind:value" => "file.path"])); ?>

                                        <?php echo e(Form::hidden('featureTypes[]',null,["v-bind:value" => "file.type"])); ?>

                                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'featureErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'featureErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'file.fileError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['feature', 'featureNames', 'featurePaths']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                    <div>
                                        <h3>タイトル (最大24文字)</h3>
                                        <?php echo e(Form::text('featureTitles[]', '', ["class" => "width100", "v-bind:class" => "{'invalid-control':file.titleError}", "v-bind:id" => "'feature-title_' + index", "placeholder"=>"紹介動画のタイトルをご記載ください。", "v-bind:value"=>"file.title", "v-on:input"=>"setFeatureTitle", "maxlength" =>24])); ?>

                                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'file.titleError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                    <div>
                                        <h3>説明文</h3>
                                        <?php echo e(Form::textarea('featureDescriptions[]', '', ["class" => "width100", "v-bind:class" => "{'invalid-control':file.descriptionError}", "v-bind:id" => "'feature-description_' + index", "placeholder" => "紹介動画の説明文をご記載ください。","rows"=>"10", "v-bind:value"=>"file.description", "v-on:input"=>"setFeatureDescription"])); ?>

                                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'file.descriptionError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                                <button type="button" class="add" v-if="component.addable" v-on:click="component.add()">動画・画像を追加</button>
                            </template>
                        </additional>
                    </div>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="hashtag">ハッシュタグ（最大16文字）</label></th>
                <td>
                    <div class="flex--ctr">
                        #<?php echo e(Form::text('hashtag', $data->get("hashtag"), ["class" => (!empty($errors->has('hashtag')) ? "invalid-control width100" : "width100"), "id"=>"hashtag", "placeholder"=>"例）イケメン多数", "maxlength" =>16])); ?>

                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['hashtag']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="red">ハッシュタグカラー</label></th>
                <td>
                    <div class="flex color">
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_RED, (empty($data->get("hashTagColor"))|| $data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_RED)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"red"])); ?>

                            <label for="red"><span class="tag--red"><?php echo e(\App\Domain\Entities\Tag::TAG_COLLAR_CODE_LIST[\App\Domain\Entities\Tag::TAG_COLLAR_RED]); ?></span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_BLUE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_BLUE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"blue"])); ?>

                            <label for="blue"><span class="tag--blue"><?php echo e(\App\Domain\Entities\Tag::TAG_COLLAR_CODE_LIST[\App\Domain\Entities\Tag::TAG_COLLAR_BLUE]); ?></span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_GREEN, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_GREEN)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"green"])); ?>

                            <label for="green"><span class="tag--green"><?php echo e(\App\Domain\Entities\Tag::TAG_COLLAR_CODE_LIST[\App\Domain\Entities\Tag::TAG_COLLAR_GREEN]); ?></span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_ORANGE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_ORANGE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"orange"])); ?>

                            <label for="orange"><span class="tag--orange"><?php echo e(\App\Domain\Entities\Tag::TAG_COLLAR_CODE_LIST[\App\Domain\Entities\Tag::TAG_COLLAR_ORANGE]); ?></span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_PURPLE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_PURPLE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"purple"])); ?>

                            <label for="purple"><span class="tag--purple"><?php echo e(\App\Domain\Entities\Tag::TAG_COLLAR_CODE_LIST[\App\Domain\Entities\Tag::TAG_COLLAR_PURPLE]); ?></span></label>
                        </div>
                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['hashTagColor']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th>募集タグ</th>
                <td>
                    <div class="flex recruit">
                        <?php echo e(Form::checkbox('recruitmentTargetYear', 1, ($data->get("recruitmentTargetYear") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetYear"])); ?>

                        <label for="recruitmentTargetYear"><?php echo e(\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::THIS_YEAR]); ?></label>
                        <?php echo e(Form::checkbox('recruitmentTargetThisYear', 1, ($data->get("recruitmentTargetThisYear") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetThisYear"])); ?>

                        <label for="recruitmentTargetThisYear"><?php echo e(\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::NEXT_YEAR]); ?></label>
                        <?php echo e(Form::checkbox('recruitmentTargetIntern', 1, ($data->get("recruitmentTargetIntern") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetIntern"])); ?>

                        <label for="recruitmentTargetIntern"><?php echo e(\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::INTERN]); ?></label>
                    </div>
                </td>
            </tr>
        </table>

        <h2 class="main__content__headline">登録アカウント</h2>
        <p>※アカウントの変更依頼は<a href="<?php echo e(route('client.contact')); ?>">お問合せフォーム</a>からお願いします。</p>
        <div class="account">
            <?php if(!empty($data->get('accountList'))): ?>
                <?php $__currentLoopData = $data->get('accountList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <div><?php echo e($account->get('name')); ?></div>
                        <div><?php echo e($account->get('mailaddress')); ?></div>
                        <footer><?php echo e($account->get('lastLoginDatetime')); ?></footer>
                    </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <div class="form__controls">
            <input type="button" value="登録内容でプレビュー" class="preview js-btn-target-blank" data-href="<?php echo e(route('client.company-edit.basic-information.preview')); ?>">
            <input type="button" value="変更する" class="save js-btn-submit">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
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
                    <button id="cropImage" type="button" class="button" pic_type="" data-dismiss="modal">トリミング</button>
                </div>
            </div>
        </div>
    </div>
    <div id="loader" style="display: none;">
        <div class="loading-overlay">
            <div class="loading">
                <div class="loading-icon mb-5">
                    <img src="<?php echo e(asset('img/icon_loading.png')); ?>" alt="">
                </div>
                <span>アップロード中...</span>
            </div>
        </div>
    </div>
    <?php echo $__env->make('client.common.indicator', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>