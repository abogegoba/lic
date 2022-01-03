
<strong>基本情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <?php if(!empty($data->has('memberId'))): ?>
        <tr>
            <th>
                ID
            </th>
            <td>
                <?php echo e($data->get('memberId')); ?>

            </td>
        </tr>
    <?php endif; ?>
    <tr>
        <th class="required-icon">
            氏名
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('lastName')) ? 'invalid-form' : ''); ?>">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">姓</div>
                    </div>
                    <?php echo e(Form::text('lastName', $data->get("lastName"), ["class" => "form-control invalid-control", "placeholder" => "例）陸", 'maxlength' => 16])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('firstName')) ? 'invalid-form' : ''); ?>">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">名</div>
                    </div>
                    <?php echo e(Form::text('firstName', $data->get("firstName"), ["class" => "form-control invalid-control", "placeholder" => "例）太郎", 'maxlength' => 16])); ?>

                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'lastName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'firstName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            <?php if($data->get("country") == 1): ?>
            氏名かな
            <?php else: ?>
            氏名カタカナ
            <?php endif; ?>
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('lastNameKana')) ? 'invalid-form' : ''); ?>">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">姓</div>
                    </div>
                    <?php echo e(Form::text('lastNameKana', $data->get("lastNameKana"), ["class" => "form-control invalid-control", "placeholder" => "例）りく", 'maxlength' => 16])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('firstNameKana')) ? 'invalid-form' : ''); ?>">
                    <div class="input-group-prepend">
                        <div class="input-group-text input-group-transparent pl-0">名</div>
                    </div>
                    <?php echo e(Form::text('firstNameKana', $data->get("firstNameKana"), ["class" => "form-control invalid-control", "placeholder" => "例）たろう", 'maxlength' => 16])); ?>

                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'lastNameKana'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'firstNameKana'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <?php if($data->get("country") > 1): ?>
    <tr>
        <th>
            English Name
        </th>
        <td>
            <div class="mb-2 <?php echo e(!empty($errors->has('englishName')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('englishName',$data->get("englishName"),["id" => "englishName","class"=>"form-control invalid-control","placeholder"=>"例）Riku Taro"])); ?>

                <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'englishName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <th class="required-icon">
            生年月日
        </th>
        <td>
            <div class="input-group date-calendar-wrap w-25 <?php echo e(!empty($errors->has('birthday')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('birthday',$data->getWithFormat("birthday","Y/m/d"),["id" => "birthday","class"=>"form-control invalid-control js-datepicker border-right-0","data-default-blank"=>"true","placeholder"=>"例）1999/10/01"])); ?>

                <div class="input-group-append invalid-control">
                    <button type="button" class="btn js-datepicker-focus">
                        <i aria-hidden="true" class="iconfont iconfont-calendar"></i>
                    </button>
                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'birthday'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            住所
        </th>
        <td>
            <?php if($data->get("country") == 1): ?>
                <div class="mb-2">
                    <div class="custom-control-inline <?php echo e(!empty($errors->has('zipCode')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::tel('zipCode', $data->get("zipCode"), ["id"=>"zipCode", "class" => "form-control invalid-control", "placeholder" => "例）1500021", 'maxlength' => 7])); ?>

                    </div>
                    <div class="btn-col">
                        <button type="button" class="btn btn-primary js-zip">
                            <span>住所を検索</span>
                        </button>
                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'zipCode'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="mb-2 w-25 <?php echo e(!empty($errors->has('prefecture')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('prefecture', $data->get("prefectureList"), $data->get("prefecture"), ["id"=>"prefecture", "class" => "form-control invalid-control", "placeholder" => "都道府県"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'prefecture'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            <?php else: ?>
                <div class="mb-2">
                    <?php echo e(Form::select('country',  $data->get("overseasList"), $data->get("country"), ["class" => "form-control invalid-control"])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'country'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="mb-2">
                    <div class="custom-control-inline <?php echo e(!empty($errors->has('zipCode')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::tel('zipCode', $data->get("zipCode"), ["id"=>"zipCode", "class" => "form-control invalid-control", "placeholder" => "例）100", 'maxlength' => 7])); ?>

                    </div>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'zipCode'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            <?php endif; ?>
            <div class="mb-2 <?php echo e(!empty($errors->has('city')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('city', $data->get("city"), ["id"=>"city", "class" => "form-control invalid-control", "placeholder" => "例）渋谷区恵比寿西", 'maxlength' => 56])); ?>

                <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'city'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php if($data->get("country") == 1): ?>
            <div class="<?php echo e(!empty($errors->has('blockNumber')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('blockNumber', $data->get("blockNumber"), ["id"=>"blockNumber", "class" => "form-control invalid-control", "placeholder" => "例）2-2-8 えびす第２ビル　2F", 'maxlength' => 56])); ?>

                <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'blockNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            連絡先電話番号
        </th>
        <td class="<?php echo e(!empty($errors->has('phoneNumber')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::tel('phoneNumber', $data->get("phoneNumber"), ["class" => "form-control invalid-control", 'placeholder'=>'例）0364449999', "maxlength" => 15])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'phoneNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            学校種別
        </th>
        <td class="<?php echo e(!empty($errors->has('schoolType')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline">
                <?php $__currentLoopData = $data->get("schoolTypeList"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $schoolType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mx-2">
                        <?php echo e(Form::radio('schoolType', $id, ($data->get("schoolType") === $id ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"school_".$id])); ?>

                        <label for="school_<?php echo e($id); ?>"><span><?php echo e($schoolType); ?></span></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'schoolType'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            学校名
        </th>
        <td class="<?php echo e(!empty($errors->has('schoolName')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::text('schoolName', $data->get("schoolName"), ["class" => "form-control invalid-control", 'placeholder'=>'例）東京大学','maxlength' => 24])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'schoolName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <?php if($data->get("country") == 1): ?>
        <tr>
            <th class="required-icon">
                学部・学科名
            </th>
            <td class="<?php echo e(!empty($errors->has('departmentName')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('departmentName', $data->get("departmentName"), ["class" => "form-control invalid-control", 'placeholder'=>'例）経済学部経済学科','maxlength' => 24])); ?>

                <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'departmentName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </td>
        </tr>
    <?php else: ?>
        <?php echo e(Form::hidden('departmentName', $data->get("departmentName"), ["class" => (!empty($errors->has('departmentName')) ? "invalid-control width100" : "width100"), "id"=>"departmentName", "placeholder" => "例）経済学部経済学科", "maxlength" =>72])); ?>

    <?php endif; ?>

    <tr>
        <th class="required-icon">
            <?php echo e($data->get("country") == 1?'学部系統':'学部名'); ?>

        </th>
        <td>
            <?php if($data->get("country") == 1): ?>
                <?php echo e(Form::select('facultyType',  $data->get("facultyTypeList"), $data->get("facultyType"), ["class" => "form-control invalid-control"])); ?>

            <?php else: ?>
                <?php echo e(Form::select('facultyType',  $data->get("overseasFacultyTypeList"), $data->get("facultyType"), ["class" => "form-control invalid-control"])); ?>

            <?php endif; ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'facultyType'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            卒業年月
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-6 col-xl-2 <?php echo e(!empty($errors->has('graduationPeriodYear')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('graduationPeriodYear',  $data->get("yearList"), $data->get("graduationPeriodYear"), ["class" => "form-control invalid-control", 'placeholder'=>'選択してください'])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-2 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('graduationPeriodMonth')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('graduationPeriodMonth',  $data->get("monthList"), $data->get("graduationPeriodMonth"), ["class" => "form-control invalid-control", 'placeholder'=>'選択してください'])); ?>

                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'graduationPeriodYear'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'graduationPeriodMonth'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(!empty($errors) && !empty($errors->get("business_exception")['business.cant_store_graduation_period'])): ?>
                <?php echo $__env->make('admin.common.business_error', ['errors'=>$errors, 'target'=>'cant_store_graduation_period'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>
            プライベート写真
        </th>
        
        <td v-cloak class="invalid-form">
            <div id="existingPrivatePhoto" class="logo mb-2">
                <img v-if="privatePhoto.url" v-bind:src="privatePhoto.url" alt="プライベート写真">
                <img v-else src="<?php echo e(asset('img/member/img_self.jpg')); ?>" alt="プライベート写真">
            </div>
            <div class="btn-col">
                <input type="file" id="js-private-photo" class="width100" data-data="<?php echo e($data->toJsonPrivatePhoto()); ?>" style="display: none">
                
                <label for="js-private-photo" class="btn btn-primary">写真を選択</label>
                <?php echo e(Form::hidden('privatePhotoName',null,["v-bind:value" => "privatePhoto.name","id"=>"privatePhotoName"])); ?>

                <?php echo e(Form::hidden('privatePhotoPath',null,["v-bind:value" => "privatePhoto.path","id"=>"privatePhotoPath"])); ?>

            </div>
            <div class="btn-col">
                <button type="button" class="btn btn-secondary" v-on:click="removePrivatePhoto">
                    <span>写真を削除</span>
                </button>
            </div>
            <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'privatePhotoErrors.photo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhoto'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhotoName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'privatePhotoPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th>
            証明写真
        </th>
        
        <td v-cloak class="invalid-form">
            <div id="existingIdPhoto" class="logo mb-2">
                <img v-if="idPhoto.url" v-bind:src="idPhoto.url" alt="証明写真">
                <img v-else src="<?php echo e(asset('img/member/img_self.jpg')); ?>" alt="証明写真">
            </div>
            <div class="btn-col">
                <input type="file" id="js-id-photo" data-data="<?php echo e($data->toJsonIdPhoto()); ?>" style="display: none">
                
                <label for="js-id-photo" class="btn btn-primary">写真を選択</label>
                <?php echo e(Form::hidden('idPhotoName',null,["v-bind:value" => "idPhoto.name","id"=>"idPhotoName"])); ?>

                <?php echo e(Form::hidden('idPhotoPath',null,["v-bind:value" => "idPhoto.path","id"=>"idPhotoPath"])); ?>

            </div>
            <div class="btn-col">
                <button type="button" class="btn btn-secondary" v-on:click="removeIdPhoto">
                    <span>写真を削除</span>
                </button>
            </div>
            <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'idPhotoErrors.photo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhoto'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhotoName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'idPhotoPath'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        
        <th>
            ハッシュタグ<br>（最大16文字）
        </th>
        <td class="<?php echo e(!empty($errors->has('hashTag')) ? 'invalid-form' : ''); ?>">
            <div class="input-group col-sm-6 col-xl-4">
                <div class="input-group-prepend">
                    <div class="input-group-text input-group-transparent pl-0"><h3>#</h3></div>
                </div>
                <?php echo e(Form::text('hashTag', $data->get("hashTag"), ["class" => "form-control invalid-control w-75", 'placeholder'=>'例）イケメン多数', "maxlength" => 16])); ?>

            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'hashTag'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        
        <th>
            ハッシュタグカラー
        </th>
        <td class="<?php echo e(!empty($errors->has('hashTagColor')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline color">
                <?php $__currentLoopData = $data->get('hashTagColorClassList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $hashTagColor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="radio__color">
                        <?php echo e(Form::radio('hashTagColor', $id , ($data->get("hashTagColor") === $id ? "checked='checked'":''), ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"hashTag_$id"])); ?>

                        <label for="hashTag_<?php echo e($id); ?>">
                            <span class="<?php echo e($hashTagColor); ?>">&nbsp;</span>
                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'hashTagColor'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            メールアドレス
        </th>
        <td class="<?php echo e(!empty($errors->has('mailAddress')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::email('mailAddress', $data->get("mailAddress"), ["class" => "form-control invalid-control", 'placeholder'=>'例）example@linkt.jp', "maxlength" => 255])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'mailAddress'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(!empty($errors) && !empty($errors->get("business_exception")['business.duplication.mail_address'])): ?>
                <?php echo $__env->make('admin.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            パスワード
        </th>
        <td class="<?php echo e(!empty($errors->has('password')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::text('password', $data->get("password"), ["class" => "form-control invalid-control", "maxlength" => 14])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
            <additional id="video" data="<?php echo e($data->toJsonPrVideos($errors)); ?>" :max="3" ref="prVideo">
                <template slot="field" slot-scope="component">
                    <div v-for="(video, index) in component.data" class="file">
                        <div class="mb-5 invalid-form">
                            <div class="mb-2 video" v-if="video.url && video.type == <?php echo e(\App\Domain\Entities\UploadedFile::MOVIE_CONTENT); ?>">
                                <video controls="" muted="" poster="" v-bind:src="video.url">
                                    <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                </video>
                            </div>
                            <div class="mb-2 video-thumbs" v-if="video.url && video.type == <?php echo e(\App\Domain\Entities\UploadedFile::IMAGE_CONTENT); ?>">
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
                            <div class="btn-col" v-if="video.url && video.type == <?php echo e(\App\Domain\Entities\UploadedFile::MOVIE_CONTENT); ?>">
                                <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                    <span>動画を削除</span>
                                </button>
                            </div>
                            <div class="btn-col" v-if="video.url && video.type == <?php echo e(\App\Domain\Entities\UploadedFile::IMAGE_CONTENT); ?>">
                                <button type="button" class="btn btn-secondary" v-on:click="component.remove(index)">
                                    <span>画像を削除</span>
                                </button>
                            </div>
                            <?php echo e(Form::hidden('prVideoNames[]',null,["v-bind:value" => "video.name"])); ?>

                            <?php echo e(Form::hidden('prVideoPaths[]',null,["v-bind:value" => "video.path"])); ?>

                            <?php echo e(Form::hidden('prVideoTypes[]',null,["v-bind:value" => "video.type"])); ?>

                            <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video.videoError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'prVideoErrors.uploadVideo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'prVideoErrors.uploadImage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoNames'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'prVideoPaths'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <p>タイトル (最大24文字)</p>
                            <div class="mb-2">
                                <?php echo e(Form::text('prVideoTitles[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':video.titleError}", "v-bind:id" => "'js-pr-title_' + index", "placeholder"=>"例）業界最大手の企業", "v-bind:value"=>"video.title", "v-on:input"=>"setPrTitle", "maxlength" => 24])); ?>

                            </div>
                            <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video.titleError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <p>説明文</p>
                            <div class="mb-2">
                                <?php echo e(Form::textarea('prVideoDescriptions[]', '', ["class" => "form-control", "v-bind:class" => "{'invalid-control':video.descriptionError}", "v-bind:id" => "'js-pr-description_' + index", "placeholder"=>"例）当社は業界の中で日本最大手の企業です。","rows"=>"10", "v-bind:value"=>"video.description", "v-on:input"=>"setPrDescription", "maxlength" => 400])); ?>

                            </div>
                            <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'video.descriptionError'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
        <td class="<?php echo e(!empty($errors->has('introduction')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('introduction', $data->get('introduction'), ["class" => "form-control", 'placeholder'=>'自己PR文をご記載ください。',"rows"=>"10", "maxlength" => 400])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'introduction'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <?php if($data->get("country") == 1): ?>
    <tr>
        <th class="required-icon">
            体育会所属経験
        </th>
        <td class="<?php echo e(!empty($errors->has('affiliationExperience')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline">
                <?php $__currentLoopData = $data->get('affiliationExperienceLabelList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $affiliationExperienceLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mx-2">
                        <?php echo e(Form::radio('affiliationExperience',$id, ($data->get("affiliationExperience") == $id ? "checked='checked'":''), ["class" => (!empty($errors->has('affiliationExperience')) ? "invalid-control" : ""), "id"=>"affiliationExperience_$id"])); ?>

                        <label for="affiliationExperience_<?php echo e($id); ?>"><?php echo e($affiliationExperienceLabel); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'affiliationExperience'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <?php endif; ?>
    <tr>
        
        <th>
            インスタフォロワー数
        </th>
        <td class="<?php echo e(!empty($errors->has('instagramFollowerNumber')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline">
                <?php $__currentLoopData = $data->get('instagramFollowerNumberLabelList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $instagramFollowerNumberLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mx-2">
                        <?php echo e(Form::radio('instagramFollowerNumber',$id, ($data->get("instagramFollowerNumber") === $id ? "checked='checked'":''), ["class" => (!empty($errors->has('instagramFollowerNumber')) ? "invalid-control" : ""), "id"=>"instagramFollowerNumber_$id"])); ?>

                        <label for="instagramFollowerNumber_<?php echo e($id); ?>"><?php echo e($instagramFollowerNumberLabel); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'instagramFollowerNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
    <?php $__currentLoopData = $data->get("selfIntroductions"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $displayNumber => $selfIntroductions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th>
                <?php if($displayNumber === 10): ?>
                    自由入力
                <?php else: ?>
                    <?php echo e($selfIntroductions['title']); ?>

                <?php endif; ?>
            </th>
            <td class="invalid-form">
                <?php if($displayNumber === 10): ?>
                    <div class="mb-2">
                        <?php echo e(Form::text('selfIntroduction10Title', $data->get("selfIntroduction10Title"), ["class" => (!empty($errors->has('selfIntroduction10Title')) ? "form-control invalid-control" : "form-control"), "id"=>"selfIntroduction10Title", "maxlength" =>24, "placeholder"=>"自由にタイトルを入力してください"])); ?>

                        <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroduction10Title'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <div class="mb-2">
                        <?php echo e(Form::textarea('selfIntroductions['.$displayNumber.']' , $selfIntroductions['content'], ["class" => (!empty($errors->has('selfIntroductions')) || !empty($errors->has('selfIntroductions.'.$displayNumber)) ? "form-control invalid-control" : "form-control"), "id"=>"selfIntroduction".$displayNumber,"rows"=>"10", "maxlength" =>400, 'placeholder'=>'※自由に本文を入力してください。400文字以内で作成してください。',])); ?>

                        <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions.'.$displayNumber], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                <?php else: ?>
                    <?php echo e(Form::textarea('selfIntroductions['.$displayNumber.']' , $selfIntroductions['content'], ["class" => (!empty($errors->has('selfIntroductions')) || !empty($errors->has('selfIntroductions.'.$displayNumber)) ? "form-control invalid-control" : "form-control"), "id"=>"selfIntroduction".$displayNumber,"rows"=>"10", "maxlength" =>400, 'placeholder'=>'※内容は具体的にご記載ください。400文字以内で作成してください。',])); ?>

                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'selfIntroductions.'.$displayNumber], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('industry1')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('industry1', $data->get("businessTypeList"), $data->get("industry1"), ["class" => (!empty($errors->has('industry1')) ? "form-control invalid-control" : "form-control"), "id"=>"industry1","placeholder" => "選択してください"])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('industry2')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('industry2', $data->get("businessTypeList"), $data->get("industry2"), ["class" => (!empty($errors->has('industry2')) ? "form-control invalid-control" : "form-control"), "id"=>"industry2","placeholder" => "選択してください"])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('industry3')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('industry3', $data->get("businessTypeList"), $data->get("industry3"), ["class" => (!empty($errors->has('industry3')) ? "form-control invalid-control" : "form-control"), "id"=>"industry3","placeholder" => "選択してください"])); ?>

                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'industry1'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'industry2'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'industry3'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        
        <th>
            志望職種（最大３つ）
        </th>
        <td class="invalid-form">
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('jobType1')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('jobType1', $data->get("jobTypeList"), $data->get("jobType1"), ["class" => (!empty($errors->has('jobType1')) ? "form-control invalid-control" : "form-control"), "id"=>"jobType1","placeholder" => "選択してください"])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('jobType2')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('jobType2', $data->get("jobTypeList"), $data->get("jobType2"), ["class" => (!empty($errors->has('jobType2')) ? "form-control invalid-control" : "form-control"), "id"=>"jobType2","placeholder" => "選択してください"])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('jobType3')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('jobType3', $data->get("jobTypeList"), $data->get("jobType3"), ["class" => (!empty($errors->has('jobType3')) ? "form-control invalid-control" : "form-control"), "id"=>"jobType3","placeholder" => "選択してください"])); ?>

                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType1'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType2'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType3'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            志望勤務地（最大３つ）
        </th>
        <td class="invalid-form">
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 <?php echo e(!empty($errors->has('location1')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('location1', $data->get("prefectureList"), $data->get("location1"), ["class" => (!empty($errors->has('location1')) ? "form-control invalid-control" : "form-control"), "id"=>"location1","placeholder" => "選択してください"])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('location2')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('location2', $data->get("prefectureList"), $data->get("location2"), ["class" => (!empty($errors->has('location2')) ? "form-control invalid-control" : "form-control"), "id"=>"location2","placeholder" => "選択してください"])); ?>

                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 <?php echo e(!empty($errors->has('location3')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::select('location3', $data->get("prefectureList"), $data->get("location3"), ["class" => (!empty($errors->has('location3')) ? "form-control invalid-control" : "form-control"), "id"=>"location3","placeholder" => "選択してください"])); ?>

                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'location1'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'location2'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'location3'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            インターン希望
        </th>
        <td class="<?php echo e(!empty($errors->has('internNeeded')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline">
                <div class="mx-2">
                    <?php echo e(Form::radio('internNeeded', 1, ($data->get("internNeeded")) == 1 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"internNeeded_true"])); ?>

                    <label for="internNeeded_true"><span>有り</span></label>
                </div>
                <div class="mx-2">
                    <?php echo e(Form::radio('internNeeded', 0, ($data->get("internNeeded")) == 0 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"internNeeded_false"])); ?>

                    <label for="internNeeded_false"><span>無し</span></label>
                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'internNeeded'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            就活イベントやその他就職活動に関 する情報取得について
        </th>
        <td class="<?php echo e(!empty($errors->has('recruitInfoNeeded')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline">
                <div class="mx-2">
                    <?php echo e(Form::radio('recruitInfoNeeded', 1, ($data->get("recruitInfoNeeded")) == 1 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"recruitInfoNeeded_true"])); ?>

                    <label for="recruitInfoNeeded_true"><span>有り</span></label>
                </div>
                <div class="mx-2">
                    <?php echo e(Form::radio('recruitInfoNeeded', 0, ($data->get("recruitInfoNeeded")) == 0 ? "checked='checked'":'', ["class" => "invalid-control", "id"=>"recruitInfoNeeded_false"])); ?>

                    <label for="recruitInfoNeeded_false"><span>無し</span></label>
                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitInfoNeeded'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
        <td class="<?php echo e(!empty($errors->has('toeicScore')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::tel('toeicScore', $data->get("toeicScore"), ["class" => "form-control invalid-control w-25", 'placeholder'=>'例）456点', "maxlength" => 3])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'toeicScore'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th>
            TOEFL
        </th>
        <td class="<?php echo e(!empty($errors->has('toeflScore')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::tel('toeflScore', $data->get("toeflScore"), ["class" => "form-control invalid-control w-25", 'placeholder'=>'例）123点', "maxlength" => 3])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'toeflScore'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th>
            保有資格・検定など
        </th>
        <td class="invalid-form">
            <additional v-cloak id="licences" data="<?php echo e($data->toJsonQualifications($errors)); ?>" :max="10" class="licences-container" :initial-add="true">
                <template slot="field" slot-scope="component" class="licences-wrap">
                    <div v-for="(certificationList, index) in component.data" class="row mb-2">
                        <div class="input-group col-sm-6 col-xl-8 <?php echo e(!empty($errors->has('year')) ? 'invalid-form' : ''); ?>">
                            <?php echo e(Form::text('certificationList[]', null, ["v-model"=>"certificationList.certification", "class" => "form-control","v-bind:class"=>"[certificationList.certificationListErrors||certificationList.certificationListsErrors? 'invalid-control':'']", "id"=>"certificationList","placeholder"=>"例）秘書検定1級", "maxlength" =>32])); ?>

                        </div>
                        <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-secondary" v-if="index !== 0" v-on:click="component.remove(index)">
                                <span>削除</span>
                            </button>
                        </div>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'certificationList.certificationListErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'certificationList.certificationListsErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
            <additional v-cloak id="careers" data="<?php echo e($data->toJsonCareers($errors)); ?>" :max="20" :initial-add="true">
                <template slot="field" slot-scope="component">
                    <div v-for="(career,index) in component.data" class="career mb-2">
                        <div class="row mb-2">
                            <div class="input-group col-sm-6 col-xl-2">
                                <?php echo e(Form::select('careerPeriodYears[]', $data->get("yearList"), null, ["v-model"=>"career.periodYear","class" => "form-control","v-bind:class"=>"[career.periodYearErrors||career.periodYearsErrors? 'invalid-control':'']","placeholder" => "選択してください"])); ?>

                            </div>
                            <div class="input-group col-sm-6 col-xl-2 mt-2 mt-sm-0">
                                <?php echo e(Form::select('careerPeriodMonths[]', $data->get("monthList"), null, ["v-model"=>"career.periodMonth", "class" => "form-control","v-bind:class"=>"[career.periodMonthErrors||career.periodMonthsErrors? 'invalid-control':'']","placeholder" => "選択してください"])); ?>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="input-group col-sm-6 col-xl-8">
                                <?php echo e(Form::text('careerNames[]', null, ["v-model"=>"career.name", "class" => "form-control","v-bind:class"=>"[career.nameErrors||career.namesErrors? 'invalid-control':'']","placeholder"=>"例）明治大学付属明治高等学校　卒業", "maxlength" =>32])); ?>

                            </div>
                            <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0">
                                <button type="button" class="btn btn-secondary" v-if="index !== 0" v-on:click="component.remove(index)">
                                    <span>削除</span>
                                </button>
                            </div>
                        </div>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'career.periodYearErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'career.periodYearsErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'career.periodMonthErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'career.periodMonthsErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'career.nameErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('admin.common.vue_input_error', ['target' => 'career.namesErrors'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
            <div class="<?php echo e(!empty($errors->has('managementMemo')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::textarea('managementMemo', $data->get("managementMemo"), ["class" => "form-control invalid-control", "maxlength" => 4000])); ?>

            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'managementMemo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            ステータス
        </th>
        <td class="<?php echo e(!empty($errors->has('status')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline">
                <?php $__currentLoopData = $data->get('statusList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mx-2">
                        <?php echo e(Form::radio('status', $id, ($data->get("status") === $id ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"status_".$id])); ?>

                        <label for="status_<?php echo e($id); ?>"><span><?php echo e($status); ?></span></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'status'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            メール送信
        </th>
        <td class="<?php echo e(!empty($errors->has('sendMail')) ? 'invalid-form' : ''); ?>">
            <div class="custom-control-inline">
                <div class="mx-2">
                    <?php echo e(Form::radio('sendMail', 1, ($data->get("sendMail") == 1 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail_1"])); ?>

                    <label for="send-mail_1"><span>送信する</span></label>
                </div>
                <div class="mx-2">
                    <?php echo e(Form::radio('sendMail', 0, ($data->get("sendMail") == 0 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail_0"])); ?>

                    <label for="send-mail_0"><span>送信しない</span></label>
                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'sendMail'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    </tbody>
</table>
