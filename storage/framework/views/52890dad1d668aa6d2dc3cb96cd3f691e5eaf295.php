<?php $__env->startSection('title','写真・ハッシュタグ│プロフィール変更│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/profile/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('front.common.photo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vue'); ?>
    <script src="<?php echo e(asset('js/photo_vue.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li>プロフィール変更入力（写真・ハッシュタグ）</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content" id="photo" data-upload-url="<?php echo e(route("front.profile.photo.edit.upload-photo")); ?>">
        <?php echo e(Form::open(['url'=>route('front.profile.photo.edit.update')])); ?>

        <table v-cloak class="form__table">
            <tr class="invalid-form">
                <th>
                    <label for="photo1">証明写真</label>
                    <input type="checkbox" class="photo-sample__input" id="photo-sample__modal">
                    <label class="photo-sample__open" for="photo-sample__modal">？</label>
                    <div class="photo-sample">
                        <div class="photo-sample__inner">
                            <label class="photo-sample__close" for="photo-sample__modal">×</label>
                            <img src="<?php echo e(asset('img/mypage/profile/profile_sample.jpg')); ?>" alt="参考写真">
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
                            <img v-else src="<?php echo e(asset('img/mypage/profile/img_self.jpg')); ?>" alt="証明写真">
                        </picture>
                        <input type="file" id="js-id-photo" class="width100" data-data="<?php echo e($data->toJsonIdPhoto()); ?>">
                        
                        <label for="js-id-photo" class="css-select-btn">写真を選択</label>
                        <button type="button" class="button remove css-delete-btn" v-if="idPhoto.url" v-on:click="deletePhoto">写真を削除する</button>
                        <?php echo e(Form::hidden('idPhotoName',null,["v-bind:value" => "idPhoto.name","id"=>"idPhotoName"])); ?>

                        <?php echo e(Form::hidden('idPhotoPath',null,["v-bind:value" => "idPhoto.path","id"=>"idPhotoPath"])); ?>

                    </div>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'idPhotoErrors.photo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['idPhoto','idPhotoName','idPhotoPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th><label for="photo2">プライベート写真</label></th>
                <td>
                    <div class="flex photo">
                        <picture id="existingPic2">
                            <img v-if="privatePhoto.url" v-bind:src="privatePhoto.url" alt="プライベート写真">
                            <img v-else src="<?php echo e(asset('img/mypage/profile/img_self.jpg')); ?>" alt="プライベート写真">
                        </picture>
                        <input type="file" id="js-private-photo" class="width100" data-data="<?php echo e($data->toJsonPrivatePhoto()); ?>">
                        
                        <label for="js-private-photo" class="css-select-btn">写真を選択</label>
                        <button type="button" class="button remove css-delete-btn" v-if="privatePhoto.url" v-on:click="deletePrivatePhoto">写真を削除する</button>
                        <?php echo e(Form::hidden('privatePhotoName',null,["v-bind:value" => "privatePhoto.name","id"=>"privatePhotoName"])); ?>

                        <?php echo e(Form::hidden('privatePhotoPath',null,["v-bind:value" => "privatePhoto.path","id"=>"privatePhotoPath"])); ?>

                    </div>
                    <?php echo $__env->make('front.common.vue_input_error', ['target' => 'privatePhotoErrors.photo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['privatePhoto','privatePhotoName','privatePhotoPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="hashTag">ハッシュタグ（最大16文字）</label></th>
                <td>
                    <div class="flex--ctr">
                        #<?php echo e(Form::text('hashTag', $data->get("hashTag"), ["class" => (!empty($errors->has('hashTag')) ? "invalid-control width100" : "width100"), "id"=>"hashTag", "placeholder"=>"例）元甲子園球児", "maxlength" =>16])); ?>

                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['hashTag']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="red">ハッシュタグカラー</label></th>
                <td>
                    <div class="flex color">
                        <?php $__currentLoopData = $data->get('hashTagColorClassList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hashTagColor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="radio__color">
                                <?php echo e(Form::radio('hashTagColor', $key , ($data->get("hashTagColor") === $key) || ($key === 1 && empty($data->get("hashTagColor"))? "checked='checked'":''), ["class" => (!empty($errors->has('hashTagColor')) ? "invalid-control" : ""), "id"=>"hashTag$key"])); ?>

                                <label for="hashTag<?php echo e($key); ?>"><span
                                            class="<?php echo e($data->get('hashTagColorClassList')[$key]); ?>"><?php echo e($data->get('hashTagColorCodeList')[$key]); ?></span></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['hashTagColor']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="<?php echo e(route("front.profile")); ?>">
            <input type="submit" value="保存する" class="save js-btn-submit">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
    <?php echo $__env->make('front.common.indicator', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>