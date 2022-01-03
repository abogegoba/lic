<?php $__env->startSection('title','学生向けログイン｜次世代の就活ならLinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/login/index.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h2>ログイン</h2>
    <?php echo e(Form::open(['url'=>route('front.member.login.execute'),'class'=>"main__form"])); ?>

        <div class="invalid-form">
            <label for="mailAddress" class="required">メールアドレス</label>
            <?php echo e(Form::email('mailAddress', $data->get("mailAddress"), ["class" => (!empty($errors->has('mailAddress')) ? "invalid-control width100" : "width100"), "id"=>"mail","placeholder"=>"例）example@linkt.jp"])); ?>

            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['mailAddress']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="invalid-form">
            <label for="password" class="required">パスワード</label>
            <?php echo e(Form::password('password', $data->get("member.password"), ["class" => (!empty($errors->has('password')) ? "invalid-control" : ""), "id"=>"password"])); ?>

            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['password']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('front.common.business_error', ['errors'=>$errors, 'target'=>'authentication_failed_front'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="form__controls">
            <input type="submit" value="ログインする">
        </div>
        <div style="text-align: center; margin-top: 30px;">会員登録がまだの方はこちら</div>
        <div class="form__controls">
            <?php
                $entryUrl = route('front.static.select_entry');
            ?>
            <input
                type="button"
                onclick="location.href='<?php echo e($entryUrl); ?>'"
                value="会員登録"
                style="background-color: #E60012; margin-top: 10px;"
            >
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>