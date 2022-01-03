<?php $__env->startSection('title','ID・パスワード入力│会員登録｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/entry/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/entry/index5.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header id="main__hdr">
        <img src="<?php echo e(asset('img/entry/icon_title_entry05.png')); ?>" alt="ID・パスワード入力">
        <div>
            <h1>ID・パスワード入力</h1>
            <p>本サービスのログイン情報をご入力ください。</p>
        </div>
    </header>
    <div id="main__content">
        <?php echo e(Form::open(['url'=>route('front.overseas-member-entry.to-confirm')])); ?>

            <table class="form__table">
                <tr class="invalid-form">
                    <th class="required"><label for="mailAddress">メールアドレス</label></th>
                    <td>
                        <?php echo e(Form::email('mailAddress', $data->get("mailAddress"), ["class" => ((!empty($errors->has('mailAddress')) || !empty($errors->get("business_exception")['business.duplication.mail_address'])) ? "invalid-control width100" : "width100"), "id"=>"mailAddress", "placeholder" => "例）example@linkt.jp","maxlength" =>255])); ?>

                        <p>※メールアドレスはログインIDとしても使います。</p>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['mailAddress']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('front.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for=pass1>パスワード</label></th>
                    <td>
                        <?php echo e(Form::password('password',["class" => (!empty($errors->has('password')) ? "invalid-control width100" : "width100"), "id"=>"password", "maxlength" =>14])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['password']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for=pass2>パスワード確認用</label></th>
                    <td>
                        <?php echo e(Form::password('confirmPassword', ["class" => (!empty($errors->has('confirmPassword')) ? "invalid-control width100" : "width100"), "id"=>"confirmPassword", "maxlength" =>14])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['confirmPassword']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
            </table>
            <div class="form__controls">
                <input type="button" value="戻る" class="form__controls__prev js-btn-link" data-href="<?php echo e(route('front.overseas-member-entry.revise-four')); ?>">
                <input type="submit" value="次に進む" class="form__controls__next">
            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>