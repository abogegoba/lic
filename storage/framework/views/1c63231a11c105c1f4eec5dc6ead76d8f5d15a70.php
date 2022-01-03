<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','ID・パスワード│プロフィール変更│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/profile/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li>プロフィール変更入力（ID・パスワード）</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content">
        <?php echo e(Form::open(['url'=>route('front.profile.id-and-pass.edit.store')])); ?>

        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="mailAddress">メールアドレス</label></th>
                <td>
                    <?php echo e(Form::email('mailAddress', $data->get("mailAddress"), ["class" => ((!empty($errors->has('mailAddress')) || !empty($errors->get("business_exception")['business.duplication.mail_address'])) ? "invalid-control width100" : "width100"), "id"=>"mailAddress", "placeholder" => "例）example@linkt.jp","maxlength" =>255])); ?>

                    <p class="notice">※メールアドレスはログインIDとしても使います。</p>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['mailAddress']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="password">パスワード</label></th>
                <td>

                    <?php echo e(Form::password('password', ["class" => (!empty($errors->has('password')) ? "invalid-control" : ""), "id"=>"password", "maxlength" =>14])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['password']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="confirmPassword">パスワード確認用</label></th>
                <td>
                    <?php echo e(Form::password('confirmPassword',  ["class" => (!empty($errors->has('confirmPassword')) ? "invalid-control" : ""), "id"=>"confirmPassword","maxlength" =>14])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['confirmPassword']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="<?php echo e(route("front.profile")); ?>">
            <input type="submit" value="保存する" class="save">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>