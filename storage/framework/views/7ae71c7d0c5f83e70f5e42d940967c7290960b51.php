<!-- <?php $__env->startSection('description','新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】の学生向け会員登録ページです。会員登録に必要な情報を入力すればアカウント取得が完了します。アカウント取得後は発行されたIDとパスワードでLinkTマイページにログインすることができます。'); ?> -->

<?php $__env->startSection('title','基本情報入力│会員登録｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/entry/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('front.common.photo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vue'); ?>
    <script src="<?php echo e(asset('js/photo_vue.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header id="main__hdr">
        <img src="<?php echo e(asset('img/entry/icon_title_entry01.png')); ?>" alt="基本情報入力">
        <div>
            <h1>基本情報入力</h1>
            <p>お名前と生年月日をご入力下さい。</p>
        </div>
    </header>
    <div id="main__content">
        <?php echo e(Form::open(['url'=>route('front.overseas-member-entry.one-next')])); ?>

            <table class="form__table" >
                <tr class="invalid-form">
                    <th class="required"><label for="name1">氏名</label></th>
                    <td>
                        <div class="flex--bet">
                        <?php echo e(Form::text('lastName', $data->get("lastName"), ["class" => (!empty($errors->has('lastName')) ? "invalid-control" : ""), "id"=>"name1","placeholder" => "例）陸", "maxlength" =>16])); ?>

                        <?php echo e(Form::text('firstName', $data->get("firstName"), ["class" => (!empty($errors->has('firstName')) ? "invalid-control" : ""),"placeholder" => "例）太郎", "maxlength" =>16])); ?>

                        </div>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['lastName','firstName']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="kana1">氏名(カタカナ)</label></th>
                    <td>
                        <div class="flex--bet">
                            <?php echo e(Form::text('lastNameKana', $data->get("lastNameKana"), ["class" => (!empty($errors->has('lastNameKana')) ? "invalid-control" : ""), "id"=>"kana1","placeholder" => "例）リク", "maxlength" =>16])); ?>

                            <?php echo e(Form::text('firstNameKana', $data->get("firstNameKana"), ["class" => (!empty($errors->has('firstNameKana')) ? "invalid-control" : ""),"placeholder" => "例）タロウ", "maxlength" =>16])); ?>

                        </div>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['lastNameKana','firstNameKana']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th><label for="englishName">English Name</label></th>
                    <td>
                        <div class="flex--bet">
                        <?php echo e(Form::text('englishName', $data->get("englishName"), ["class" => (!empty($errors->has('englishName')) ? "invalid-control" : ""), "id"=>"englishName","placeholder" => "例）Riku Taro", "maxlength" =>32])); ?>

                        </div>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['englishName']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="birthday">生年月日</label></th>
                    <td>
                        <?php echo e(Form::number('birthday', $data->get("birthday"), ["class" => (!empty($errors->has('birthday')) ? "invalid-control" : ""), "id"=>"birthday", "placeholder" => "例）19910814", "maxlength" =>8])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['birthday']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
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
                    <td v-cloak>
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

                            <?php echo e(Form::hidden('idPhotoUrl',null,["v-bind:value" => "idPhoto.url","id"=>"idPhotoUrl"])); ?>

                        </div>
                        <?php echo $__env->make('front.common.vue_input_error', ['target' => 'idPhotoErrors.photo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['idPhoto','idPhotoName','idPhotoPath']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
            </table>
            <div class="form__controls">
                <input type="submit" value="次に進む" class="form__controls__next">
            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>