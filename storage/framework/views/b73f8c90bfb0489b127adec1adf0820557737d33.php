<?php $__env->startSection('title','企業変更'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/cropper.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
    <script>
        $(function () {
            <?php if(session('success') === 'create'): ?>
            $("#create-complete").show();
            setTimeout(function () {
                $("#create-complete").fadeOut(1500);
            }, 2000);
            <?php elseif(session('success') === 'edit'): ?>
            $("#edit-complete").show();
            setTimeout(function () {
                $("#edit-complete").fadeOut(1500);
            }, 2000);
            <?php endif; ?>
            $('.js-zip').on('click', function () {
                AjaxZip3.zip2addr('zip', '', 'prefectures', 'city');
                return false;
            });
        });
    </script>
    <script src="<?php echo e(asset('js/cropper.min.js')); ?>"></script>
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
                        '    <div id="selectBox_'+index+'" class="mb-2" style="display: none;">\n' +
                        radio_button +
                        '        <label for="displayImage_'+index+'">一覧に表示</label>\n' +
                        '    </div>\n' +
                        '    <div id="existingCompanyImage_'+index+'" class="mb-2 company-image">\n' +
                        '        <img src="">\n' +
                        '    </div>\n' +
                        '    <div class="btn-col">\n' +
                        '        <input type="file" counter="'+index+'" id="js-companyImage_'+index+'" class="companyImg" style="display: none;">\n' +
                        '        <label for="js-companyImage_'+index+'" class="btn btn-primary">写真を選択</label>\n' +
                        '    </div>\n' +
                        '    <div class="btn-col">\n' +
                        '        <button id="companyImageRemove_'+index+'" type="button" counter="'+index+'" class="delete btn btn-secondary removeCompanyImage_'+index+'" style="display: none;">\n' +
                        '            <span>写真を削除</span>\n' +
                        '        </button>\n' +
                        '    </div>\n' +
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

            var img_src = $('#logoImg').attr('src');
            if (typeof img_src === typeof undefined) {
                $('#logoImg').hide();
                //$('#deleteLogo').hide();
                $('#defaultLogo').show();
            }
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                        url: '<?php echo route('admin.upload'); ?>',
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
                                $('#logoImg').attr('src',url);
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

        $('#deleteLogo').click(function () {
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: '<?php echo route('admin.company.delete_logo',['companyId'=>$data->get('companyId')]); ?>',
                data: {company_id : "<?php echo $data->get('companyId'); ?>"},
                processData: false,
                contentType: false,
                cache: false,
                success: (data) => {

                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                },
                complete: function (response) {
                    var json_response = jQuery.parseJSON( response.responseText );
                    var path = json_response.path;
                    var url = json_response.url;
                    var name = json_response.name;

                    $('#logoImg').attr('src',url);
                    $('#uploadedLogoName').val(name);
                    $('#uploadedLogoPath').val(path);

                }
            });
        })

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vue'); ?>
    <script src="<?php echo e(asset('js/company/edit_vue.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="content-title" id="company-edit" data-upload-url="<?php echo e(route('admin.upload')); ?>">企業変更</h1>

    <div style="margin-bottom: 2em;">
        <a href="<?php echo e(route('admin.company.reload')); ?>">< 企業一覧に戻る</a>
    </div>

    <?php if(session('success') === 'edit'): ?>
        
        <?php echo $__env->make('admin.common.edit_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <?php if(session('success') === 'create'): ?>
        
        <?php echo $__env->make('admin.common.create_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <div style="margin-top: 2em;">
        <?php echo e(Form::open(['url'=>route('admin.company.edit', ['companyId'=>$data->get('companyId')])])); ?>

        <strong>基本情報</strong>
        <table class="table table-form mb-5">
            <colgroup>
                <col class="w-20">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th>
                    企業ID
                </th>
                <td>
                    <?php echo e($data->get('companyId')); ?>

                </td>
            </tr>

            <tr>
                <th class="required-icon">
                    会社名
                </th>
                <td class="<?php echo e(!empty($errors->has('name')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('name', $data->get("name"), ["class" => "form-control invalid-control", "placeholder" => "例）株式会社infit", 'maxlength' => 56])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    会社名（かな）
                </th>
                <td class="<?php echo e(!empty($errors->has('nameKana')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('nameKana', $data->get("nameKana"), ["class" => "form-control invalid-control", "placeholder" => "例）かぶしきがいしゃいんふぃっと", 'maxlength' => 56])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'nameKana'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    本社所在地
                </th>
                <td>
                    <div class="custom-control-inline <?php echo e(!empty($errors->has('zip')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::tel('zip', $data->get("zip"), ["id"=>"zip", "class" => "form-control invalid-control", "placeholder" => "例）1500021", 'maxlength' => 7])); ?>

                    </div>
                    <div class="btn-col">
                        <button type="button" class="btn btn-primary js-zip">
                            <span>住所を検索</span>
                        </button>
                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'zip'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="mb-2 w-25 <?php echo e(!empty($errors->has('prefectures')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::select('prefectures', $data->get("prefectureList"), $data->get("prefectures"), ["id"=>"prefectures", "class" => "form-control invalid-control", "placeholder" => "都道府県"])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'prefectures'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="mb-2 <?php echo e(!empty($errors->has('city')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::text('city', $data->get("city"), ["id"=>"city", "class" => "form-control invalid-control", "placeholder" => "例）渋谷区恵比寿西2-2-8", 'maxlength' => 56])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'city'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="<?php echo e(!empty($errors->has('room')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::text('room', $data->get("room"), ["id"=>"room", "class" => "form-control invalid-control", "placeholder" => "例）えびす第２ビル　2F", 'maxlength' => 56])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'room'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    業種
                </th>
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
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'industryCondition.0'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    事業内容
                </th>
                <td>
                    <div class="<?php echo e(!empty($errors->has('descriptionOfBusiness')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::textarea('descriptionOfBusiness', $data->get("descriptionOfBusiness"), ["class" => "form-control invalid-control", "placeholder" => "例）次世代型就活サイト【LinkT】の企画・開発・運営"])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'descriptionOfBusiness'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    設立
                </th>
                <td class="<?php echo e(!empty($errors->has('establishmentDate')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('establishmentDate', $data->get("establishmentDate"), ["class" => "form-control invalid-control", "placeholder" => "例）2019年3月5日", 'maxlength' => 24])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'establishmentDate'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    資本金
                </th>
                <td class="<?php echo e(!empty($errors->has('capital')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('capital', $data->get("capital"), ["class" => "form-control invalid-control", "placeholder" => "例）10,000,000円"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'capital'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    従業員
                </th>
                <td class="<?php echo e(!empty($errors->has('payrollNumber')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('payrollNumber', $data->get("payrollNumber"), ["class" => "form-control invalid-control", "placeholder" => "例）100人"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'payrollNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    売上高
                </th>
                <td class="<?php echo e(!empty($errors->has('sales')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('sales', $data->get("sales"), ["class" => "form-control invalid-control", "placeholder" => "例）10,000,000円"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'sales'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    代表者
                </th>
                <td class="<?php echo e(!empty($errors->has('representativePerson')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('representativePerson', $data->get("representativePerson"), ["class" => "form-control invalid-control", "placeholder" => "例）代表取締役　後藤剛志",'maxlength' => 24])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'representativePerson'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    役員構成
                </th>
                <td class="<?php echo e(!empty($errors->has('exectiveOfficers')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::textarea('exectiveOfficers', $data->get("exectiveOfficers"), ["class" => "form-control invalid-control", "placeholder" => "例）取締役　中山勢二","rows"=>"7"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'exectiveOfficers'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    事業所
                </th>
                <td class="<?php echo e(!empty($errors->has('establishment')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::textarea('establishment', $data->get("establishment"), ["class" => "form-control invalid-control", "placeholder" => "例）東京都渋谷区恵比寿西2-2-8　えびす第2ビル2F","rows"=>"4"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'establishment'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    関連会社
                </th>
                <td class="<?php echo e(!empty($errors->has('affiliatedCompany')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::textarea('affiliatedCompany', $data->get("affiliatedCompany"), ["class" => "form-control invalid-control", "placeholder" => "例）株式会社infit's", "rows"=>"4"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'affiliatedCompany'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    登録・資格
                </th>
                <td class="<?php echo e(!empty($errors->has('qualification')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::textarea('qualification', $data->get("qualification"), ["class" => "form-control invalid-control", "placeholder" => "例）秘書検定1級", "rows"=>"4"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'qualification'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    ホームページURL
                </th>
                <td class="<?php echo e(!empty($errors->has('homePageUrl')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('homePageUrl', $data->get("homePageUrl"), ["class" => "form-control invalid-control","placeholder" => "例）https://linkt.jp","maxlength" => 255])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'homePageUrl'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    採用ホームページ
                </th>
                <td class="<?php echo e(!empty($errors->has('recruitmentUrl')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('recruitmentUrl', $data->get("recruitmentUrl"), ["class" => "form-control invalid-control","placeholder" => "例）https://linkt.jp"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentUrl'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    主要取引先
                </th>
                <td class="<?php echo e(!empty($errors->has('mainClient')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::textarea('mainClient', $data->get("mainClient"), ["class" => "form-control invalid-control", "rows"=>"4", "placeholder" => "例）株式会社電通"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'mainClient'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr v-cloak>
                
                <th>
                    企業ロゴ
                </th>
                <td class="invalid-form">
                    
                    <div id="existingLogo" class="mb-2 logo">
                        <img id="logoImg"  v-bind:src="logo.url" alt="企業ロゴ">
                    </div>
                    <?php echo e(Form::hidden('uploadedLogoName',null,["v-bind:value" => "logo.name","id"=>"uploadedLogoName"])); ?>

                    <?php echo e(Form::hidden('uploadedLogoPath',null,["v-bind:value" => "logo.path","id"=>"uploadedLogoPath"])); ?>

                    <div class="btn-col">
                        <input type="file" id="logo" data-data="<?php echo e($data->toJsonLogo()); ?>" style="display: none">
                        
                        <label for="logo" class="btn btn-primary">写真を選択</label>
                    </div>
                    <div class="btn-col  btn-row-sm">
                        <button type="button" class="btn btn-secondary"  id="deleteLogo">
                            <span>写真を削除</span>
                        </button>
                    </div>
                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'logoErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'logo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'uploadedLogoName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'uploadedLogoPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <td class="<?php echo e(!empty($errors->has('picName')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::text('picName', $data->get("picName"), ["class" => "form-control invalid-control", 'placeholder'=>'例）後藤　剛志', "maxlength" => 24])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'picName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    連絡先電話番号
                </th>
                <td class="<?php echo e(!empty($errors->has('picPhoneNumber')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::tel('picPhoneNumber', $data->get("picPhoneNumber"), ["class" => "form-control invalid-control", 'placeholder'=>'例）0364449999', "maxlength" => 15])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'picPhoneNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    緊急連絡先電話番号
                </th>
                <td class="<?php echo e(!empty($errors->has('picEmergencyPhoneNumber')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::tel('picEmergencyPhoneNumber', $data->get("picEmergencyPhoneNumber"), ["class" => "form-control invalid-control", 'placeholder'=>'例）0364449999', "maxlength" => 15])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'picEmergencyPhoneNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    連絡先メールアドレス
                </th>
                <td class="<?php echo e(!empty($errors->has('picMailAddress')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::email('picMailAddress', $data->get("picMailAddress"), ["class" => "form-control invalid-control", 'placeholder'=>'例）example@linkt.jp', "maxlength" => 255])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'picMailAddress'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <td class="invalid-form" id="company-image">
                    <additional id="file-company-image" data="<?php echo e($data->toJsonCompanyImages($errors)); ?>" :max="3" ref="companyImage" :initial-add="true">
                        
                        <template slot="field" slot-scope="component">
                            <div v-for="(file, index) in component.data" class="company_file file" v-bind:id="'selectFile_' + index" v-bind:counter="index" :key="index">
                                <div v-bind:id="'selectBox_' + index" class="mb-2 <?php echo e(!empty($errors->has('displayImage')) ? 'invalid-form' : ''); ?>" v-if="file.url">
                                    <input v-bind:id="'displayImage_'+index" name="displayImage" type="radio" v-bind:value="index" v-bind:checked="file.checked">
                                    <label v-bind:for="'displayImage_' + index" v-if="file.url">一覧に表示</label>
                                </div>
                                <div v-bind:id="'existingCompanyImage_' + index" class="mb-2 company-image">
                                    <img v-bind:src="file.url">
                                </div>
                                <div class="btn-col">
                                    <input type="file" class="companyImg" v-bind:counter="index" v-bind:counter="index" v-bind:id="'js-companyImage_' + index" style="display: none">
                                    <label v-bind:for="'js-companyImage_' + index" class="btn btn-primary">写真を選択</label>
                                </div>
                                <div class="btn-col">
                                    <button v-bind:id="'companyImageRemove_' + index" type="button" v-bind:class="'delete btn btn-secondary removeCompanyImage_' + index" v-bind:counter="index" v-if="file.url">
                                        <span>写真を削除</span>
                                    </button>
                                </div>
                                
                                <input v-bind:id="'companyImageNames_'+index" name="companyImageNames[]" type="hidden" v-bind:value="file.name">
                                <input v-bind:id="'companyImagePaths_'+index" name="companyImagePaths[]" type="hidden" v-bind:value="file.path">
                                <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'file.fileError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </template>
                    </additional>
                    <div>
                        <button type="button" id="addClientImageButton" class="btn btn-primary w-25" >
                            <span>写真を追加</span>
                        </button>
                    </div>
                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'companyImageErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'displayImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'companyImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'companyImageNames'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'companyImagePaths'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    企業紹介文
                </th>
                <td class="<?php echo e(!empty($errors->has('introductorySentence')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::textarea('introductorySentence', $data->get("introductorySentence"), ["class" => "form-control invalid-control", 'placeholder'=>'例）当社は、企業と学生の1:1のマッチングを可能にする次世代型就活サイトLinkTの運営会社です。',"rows"=>"7"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'introductorySentence'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <input type="file" id="prVideo" v-on:change="uploadPrVideo" data-data="<?php echo e($data->toJsonPrVideo()); ?>" v-bind:class="{'invalid-control':prVideoErrors.uploadVideo}"
                               style="display: none">
                        <label for="prVideo" class="btn btn-primary">動画を選択</label>
                    </div>
                    <div class="btn-col">
                        <button type="button" class="btn btn-secondary" v-if="prVideo.url" v-on:click="deletePrVideo">
                            <span>動画を削除</span>
                        </button>
                    </div>
                    <?php echo e(Form::hidden('prVideoName',null,["v-bind:value" => "prVideo.name"])); ?>

                    <?php echo e(Form::hidden('prVideoPath',null,["v-bind:value" => "prVideo.path"])); ?>

                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'prVideoErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <input type="file" id="video5s" v-on:change="uploadVideo5s" data-data="<?php echo e($data->toJsonVideo5s()); ?>" v-bind:class="{'invalid-control':video5sErrors.uploadVideo}"
                               style="display: none">
                        <label for="video5s" class="btn btn-primary">動画を選択</label>
                    </div>
                    <div class="btn-col" v-if="video5s.url">
                        <button type="button" class="btn btn-secondary" v-on:click="deleteVideo5s">
                            <span>動画を削除</span>
                        </button>
                    </div>
                    <?php echo e(Form::hidden('video5sName',null,["v-bind:value" => "video5s.name"])); ?>

                    <?php echo e(Form::hidden('video5sPath',null,["v-bind:value" => "video5s.path"])); ?>

                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video5sErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video5s'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="mb-2 video-thumbs" v-if="video5sThumb.url">
                        <img v-bind:src="video5sThumb.url" alt="5秒動画サムネイル画像">
                    </div>
                    <div class="btn-col">
                        <input type="file" id="video5sThumb" v-on:change="changeVideo5sThumb" data-data="<?php echo e($data->toJsonVideo5sThumb()); ?>"
                               v-bind:class="{'invalid-control':video5sThumbErrors.uploadImage}"
                               style="display: none">
                        <label for="video5sThumb" class="btn btn-primary">サムネイル画像を選択</label>
                    </div>
                    <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                    <div class="btn-col" v-if="video5sThumb.url">
                        <button type="button" class="btn btn-secondary" v-on:click="deleteVideo5sThumb">
                            <span>サムネイル画像を削除</span>
                        </button>
                    </div>
                    <?php echo e(Form::hidden('video5sThumbName',null,["v-bind:value" => "video5sThumb.name"])); ?>

                    <?php echo e(Form::hidden('video5sThumbPath',null,["v-bind:value" => "video5sThumb.path"])); ?>

                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video5sThumbErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sThumb'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sThumbName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sThumbPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div v-if="video5s.url">
                        <p>タイトル (最大9文字)</p>
                        <div class="mb-2 <?php echo e(!empty($errors->has('video5sTitle')) ? 'invalid-form' : ''); ?>">
                            <?php echo e(Form::text('video5sTitle', $data->get("video5s.title"), ["class" => (!empty($errors->has('video5sTitle')) ? "form-control invalid-control w-75" : "w-75"), "id"=>"video5sTitle", 'placeholder'=>'タイトル', "maxlength" => 9])); ?>

                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video5sTitle'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <input type="file" id="video10s" v-on:change="uploadVideo10s" data-data="<?php echo e($data->toJsonVideo10s()); ?>" v-bind:class="{'invalid-control':video10sErrors.uploadVideo}"
                               style="display: none">
                        <label for="video10s" class="btn btn-primary">動画を選択</label>
                    </div>
                    <div class="btn-col" v-if="video10s.url">
                        <button type="button" class="btn btn-secondary" v-on:click="deleteVideo10s">
                            <span>動画を削除</span>
                        </button>
                    </div>
                    <?php echo e(Form::hidden('video10sName',null,["v-bind:value" => "video10s.name"])); ?>

                    <?php echo e(Form::hidden('video10sPath',null,["v-bind:value" => "video10s.path"])); ?>

                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video10sErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video10s'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="mb-2 video-thumbs" v-if="video10sThumb.url">
                        <img v-bind:src="video10sThumb.url" alt="10秒動画サムネイル画像">
                    </div>
                    <div class="btn-col">
                        <input type="file" id="video10sThumb" v-on:change="changeVideo10sThumb" data-data="<?php echo e($data->toJsonVideo10sThumb()); ?>"
                               v-bind:class="{'invalid-control':video10sThumbErrors.uploadImage}" style="display: none">
                        <label for="video10sThumb" class="btn btn-primary">サムネイル画像を選択</label>
                    </div>
                    <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                    <div class="btn-col" v-if="video10sThumb.url">
                        <button type="button" class="btn btn-secondary" v-on:click="deleteVideo10sThumb">
                            <span>サムネイル画像を削除</span>
                        </button>
                    </div>
                    <?php echo e(Form::hidden('video10sThumbName',null,["v-bind:value" => "video10sThumb.name"])); ?>

                    <?php echo e(Form::hidden('video10sThumbPath',null,["v-bind:value" => "video10sThumb.path"])); ?>

                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video10sThumbErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sThumb'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sThumbName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sThumbPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div v-if="video10s.url">
                        <p>タイトル (最大9文字)</p>
                        <div class="mb-2 <?php echo e(!empty($errors->has('video10sTitle')) ? 'invalid-form' : ''); ?>">
                            <?php echo e(Form::text('video10sTitle', $data->get("video10s.title"), ["class" => (!empty($errors->has('video10sTitle')) ? "form-control invalid-control w-75" : "w-75"), "id"=>"video10sTitle", 'placeholder'=>'タイトル', "maxlength" => 9])); ?>

                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video10sTitle'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <input type="file" id="video15s" v-on:change="uploadVideo15s" data-data="<?php echo e($data->toJsonVideo15s()); ?>" v-bind:class="{'invalid-control':video15sErrors.uploadVideo}"
                               style="display: none">
                        <label for="video15s" class="btn btn-primary">動画を選択</label>
                    </div>
                    <div class="btn-col" v-if="video15s.url">
                        <button type="button" class="btn btn-secondary" v-on:click="deleteVideo15s">
                            <span>動画を削除</span>
                        </button>
                    </div>
                    <?php echo e(Form::hidden('video15sName',null,["v-bind:value" => "video15s.name"])); ?>

                    <?php echo e(Form::hidden('video15sPath',null,["v-bind:value" => "video15s.path"])); ?>

                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video15sErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video15s'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="mb-2 video-thumbs" v-if="video15sThumb.url">
                        <img v-bind:src="video15sThumb.url" alt="15秒動画サムネイル画像">
                    </div>
                    <div class="btn-col">
                        <input type="file" id="video15sThumb" v-on:change="changeVideo15sThumb" data-data="<?php echo e($data->toJsonVideo15sThumb()); ?>"
                               v-bind:class="{'invalid-control':video15sThumbErrors.uploadImage}" style="display: none">
                        <label for="video15sThumb" class="btn btn-primary">サムネイル画像を選択</label>
                    </div>
                    <p style="color: red">※サムネイル画像なしの場合、時計ロゴが表示されます</p>
                    <div class="btn-col" v-if="video15sThumb.url">
                        <button type="button" class="btn btn-secondary" v-on:click="deleteVideo15sThumb">
                            <span>サムネイル画像を削除</span>
                        </button>
                    </div>
                    <?php echo e(Form::hidden('video15sThumbName',null,["v-bind:value" => "video15sThumb.name"])); ?>

                    <?php echo e(Form::hidden('video15sThumbPath',null,["v-bind:value" => "video15sThumb.path"])); ?>

                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video15sThumbErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sThumb'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sThumbName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sThumbPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div v-if="video15s.url">
                        <p>タイトル (最大9文字)</p>
                        <div class="mb-2 <?php echo e(!empty($errors->has('video15sTitle')) ? 'invalid-form' : ''); ?>">
                            <?php echo e(Form::text('video15sTitle', $data->get("video15s.title"), ["class" => (!empty($errors->has('video15sTitle')) ? "form-control invalid-control w-75" : "w-75"), "id"=>"video15sTitle", 'placeholder'=>'タイトル', "maxlength" => 9])); ?>

                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'video15sTitle'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    当社の紹介<br>（最大6つ）
                </th>
                <td>
                    <additional id="file-feature" data="<?php echo e($data->toJsonFeature($errors)); ?>" :max="6" ref="feature" :initial-add="true">
                        <template slot="field" slot-scope="component">
                            <div v-for="(file, index) in component.data" class="file">
                                <div class="mb-5 invalid-form">
                                    <p>動画・画像</p>
                                    <div class="mb-2 video" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::MOVIE_CONTENT); ?>">
                                        <video controls="" muted="" poster="" v-bind:src="file.url" class="js-feature-video-pre">
                                            <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                        </video>
                                    </div>
                                    <div class="mb-2 video-thumbs" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::IMAGE_CONTENT); ?>">
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
                                    <div class="btn-col" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::MOVIE_CONTENT); ?>">
                                        <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                            <span>動画を削除</span>
                                        </button>
                                    </div>
                                    <div class="btn-col" v-if="file.url && file.type === <?php echo e(\App\Domain\Entities\CompanyUploadedFile::IMAGE_CONTENT); ?>">
                                        <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                            <span>画像を削除</span>
                                        </button>
                                    </div>
                                    <?php echo e(Form::hidden('featureNames[]',null,["v-bind:value" => "file.name"])); ?>

                                    <?php echo e(Form::hidden('featurePaths[]',null,["v-bind:value" => "file.path"])); ?>

                                    <?php echo e(Form::hidden('featureTypes[]',null,["v-bind:value" => "file.type"])); ?>

                                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'featureErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'featureErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'file.fileError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'feature'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'featureNames'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'featurePaths'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <p>タイトル (最大24文字)</p>
                                    <div class="mb-2">
                                        <?php echo e(Form::text('featureTitles[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':file.titleError}", "v-bind:id" => "'feature-title_' + index", "placeholder"=>"例）業界最大手の企業", "v-bind:value"=>"file.title", "v-on:input"=>"setFeatureTitle", "maxlength" => 24])); ?>

                                    </div>
                                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'file.titleError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <p>説明文</p>
                                    <div class="mb-2">
                                        <?php echo e(Form::textarea('featureDescriptions[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':file.descriptionError}", "v-bind:id" => "'feature-description_' + index", "placeholder"=>"例）当社は業界の中で日本最大手の企業です。","rows"=>"10", "v-bind:value"=>"file.description", "v-on:input"=>"setFeatureDescription"])); ?>

                                    </div>
                                    <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'file.descriptionError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                    <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('hashtag')) ? 'invalid-form' : ''); ?>">
                        <div class="input-group-prepend">
                            <div class="input-group-text input-group-transparent pl-0"><h3>#</h3></div>
                        </div>
                        <?php echo e(Form::text('hashtag', $data->get("hashtag"), ["class" => "form-control invalid-control w-75", 'placeholder'=>'例）イケメン多数', "maxlength" => 16])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'hashtag'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                
                    ハッシュタグカラー
                </th>
                <td class="<?php echo e(!empty($errors->has('hashtag')) ? 'invalid-form' : ''); ?>">
                    <div class="custom-control-inline color">
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_RED, (empty($data->get("hashTagColor"))|| $data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_RED)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"red"])); ?>

                            <label for="red"><span class="tag--red">&nbsp;</span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_BLUE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_BLUE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"blue"])); ?>

                            <label for="blue"><span class="tag--blue">&nbsp;</span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_GREEN, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_GREEN)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"green"])); ?>

                            <label for="green"><span class="tag--green">&nbsp;</span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_ORANGE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_ORANGE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"orange"])); ?>

                            <label for="orange"><span class="tag--orange">&nbsp;</span></label>
                        </div>
                        <div class="radio__color">
                            <?php echo e(Form::radio('hashTagColor', \App\Domain\Entities\Tag::TAG_COLLAR_PURPLE, ($data->get("hashTagColor") === \App\Domain\Entities\Tag::TAG_COLLAR_PURPLE)? "checked='checked'":'', ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"purple"])); ?>

                            <label for="purple"><span class="tag--purple">&nbsp;</span></label>
                        </div>
                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'hashTagColor'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th>
                    募集タグ
                </th>
                <td class="<?php echo e(!empty($errors->has('recruitmentTargetYear')) || !empty($errors->has('recruitmentTargetThisYear')) || !empty($errors->has('recruitmentTargetIntern')) ? 'invalid-form' : ''); ?>">
                    <div class="recruitment-tags">
                        <?php echo e(Form::checkbox('recruitmentTargetYear', 1, ($data->get("recruitmentTargetYear") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetYear"])); ?>

                        <label for="recruitmentTargetYear"><?php echo e(\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::THIS_YEAR]); ?></label>
                        <?php echo e(Form::checkbox('recruitmentTargetThisYear', 1, ($data->get("recruitmentTargetThisYear") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetThisYear"])); ?>

                        <label for="recruitmentTargetThisYear"><?php echo e(\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::NEXT_YEAR]); ?></label>
                        <?php echo e(Form::checkbox('recruitmentTargetIntern', 1, ($data->get("recruitmentTargetIntern") === true) ? "checked='checked'" : '', ["id"=>"recruitmentTargetIntern"])); ?>

                        <label for="recruitmentTargetIntern"><?php echo e(\App\Domain\Entities\Tag::RECRUIT_TAG_LIST[\App\Domain\Entities\Tag::INTERN]); ?></label>
                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentTargetYear'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentTargetThisYear'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentTargetIntern'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                    <div class="<?php echo e(!empty($errors->has('managementMemo')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::textarea('managementMemo', $data->get("managementMemo"), ["class" => "form-control invalid-control"])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'managementMemo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    登録アカウント
                </th>
                <td>
                    <?php if(!empty($data->get('accountList'))): ?>
                        <?php $__currentLoopData = $data->get('accountList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p>氏名</p>
                            <div class="row">
                                <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('lastName')) ? 'invalid-form' : ''); ?>">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text input-group-transparent pl-0">姓</div>
                                    </div>
                                    <?php echo e(Form::text('lastName', $account->get('lastName'), ["class" => "form-control invalid-control", "placeholder" => "例）陸", 'maxlength' => 16])); ?>

                                </div>
                                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('firstName')) ? 'invalid-form' : ''); ?>">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text input-group-transparent pl-0">名</div>
                                    </div>
                                    <?php echo e(Form::text('firstName', $account->get('firstName'), ["class" => "form-control invalid-control", "placeholder" => "例）太郎", 'maxlength' => 16])); ?>

                                </div>
                            </div>
                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'lastName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'firstName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <br>
                            <p>氏名かな</p>
                            <div class="row">
                                <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('lastNameKana')) ? 'invalid-form' : ''); ?>">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text input-group-transparent pl-0">姓</div>
                                    </div>
                                    <?php echo e(Form::text('lastNameKana', $account->get('lastNameKana'), ["class" => "form-control invalid-control", "placeholder" => "例）りく", 'maxlength' => 16])); ?>

                                </div>
                                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('firstNameKana')) ? 'invalid-form' : ''); ?>">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text input-group-transparent pl-0">名</div>
                                    </div>
                                    <?php echo e(Form::text('firstNameKana', $account->get('firstNameKana'), ["class" => "form-control invalid-control", "placeholder" => "例）たろう", 'maxlength' => 16])); ?>

                                </div>
                            </div>
                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'lastNameKana'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'firstNameKana'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <br>
                            <p>メールアドレス</p>
                            <div class="<?php echo e(!empty($errors->has('mailAddress')) ? 'invalid-form' : ''); ?>">
                                <?php echo e(Form::email('mailAddress', $account->get('mailaddress'), ["class" => "form-control invalid-control", 'placeholder'=>'例）example@linkt.jp', "maxlength" => 255])); ?>

                                <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'mailAddress'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php if(!empty($errors) && !empty($errors->get("business_exception")['business.duplication.mail_address'])): ?>
                                    <?php echo $__env->make('admin.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
                            </div>
                            <br>
                            <p>パスワード</p>
                            <div class="<?php echo e(!empty($errors->has('password')) ? 'invalid-form' : ''); ?>">
                                <?php echo e(Form::text('password', $account->get('password'), ["class" => "form-control invalid-control", "maxlength" => 14])); ?>

                                <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div style="margin-top: 2em;">
                                <?php echo e($account->get('lastLoginDatetime')); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    ステータス
                </th>
                <td class="<?php echo e(!empty($errors->has('status')) ? 'invalid-form' : ''); ?>">
                    <div class="custom-control-inline">
                        <div>
                            <?php echo e(Form::radio('status', \App\Domain\Entities\Company::STATUS_VISIBLE, (empty($data->get("status"))|| $data->get("status") === \App\Domain\Entities\Company::STATUS_VISIBLE)? "checked='checked'":'', ["class" =>  "invalid-control", "id"=>"visible"])); ?>

                            <label for="visible"><span>表示</span></label>
                        </div>
                        <div class="mx-3">
                            <?php echo e(Form::radio('status', \App\Domain\Entities\Company::STATUS_INVISIBLE, (empty($data->get("status"))|| $data->get("status") === \App\Domain\Entities\Company::STATUS_INVISIBLE)? "checked='checked'":'', ["class" =>  "invalid-control", "id"=>"invisible"])); ?>

                            <label for="invisible"><span>非表示</span></label>
                        </div>
                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'status'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr>
                <th class="required-icon">
                    求人枠
                </th>
                <td>
                    <div class="<?php echo e(!empty($errors->has('jobApplicationAvailableNumber')) ? 'invalid-form' : ''); ?>">
                        <?php $company = app('\App\Domain\Entities\Company'); ?>
                        <?php echo e(Form::select('jobApplicationAvailableNumber',  \App\Domain\Entities\Company::JOB_APPLICATION_AVAILABLE_NUMBERS, $data->get("jobApplicationAvailableNumber"), ["class" => "form-control invalid-control"])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'jobApplicationAvailableNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="btn-row btn-row" style="margin-bottom: 2em;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-secondary btn-lg js-btn-link" data-href="<?php echo e(route("admin.company.reload")); ?>">
                    <i class="iconfont iconfont-times-circle icon-lg" aria-hidden="true"></i>
                    <span>キャンセルする</span>
                </button>
            </div>
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-edit">
                    <i class="fas fa-plus-circle icon icon-lg"></i>
                    <span>変更する</span>
                </button>
            </div>
        </div>

        <a href="<?php echo e(route('admin.company.reload')); ?>">< 企業一覧に戻る</a>
    <?php echo e(Form::close()); ?>

    
    <?php echo $__env->make('admin.common.modals.edit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>