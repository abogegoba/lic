<?php $__env->startSection('title','現住所・連絡先入力│会員登録｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/entry/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header id="main__hdr">
        <img src="<?php echo e(asset('img/entry/icon_title_entry02.png')); ?>" alt="現住所・連絡先入力">
        <div>
            <h1>現住所・連絡先入力</h1>
            <p>ご住所と日中の連絡先をご入力ください。</p>
        </div>
    </header>
    <div id="main__content">
        <?php echo e(Form::open(['url'=>route('front.overseas-member-entry.two-next')])); ?>

        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="country">国籍</label></th>
                <td>
                    <div class="selectBox__wrapper width100">
                        <?php echo e(Form::select('country', $data->get("overseasList"),  $data->get("country"), ["class" => (!empty($errors->has('country')) ? "invalid-control" : ""), "id"=>"country", "placeholder" => '選択してください'])); ?>

                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['country']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="zipCode">郵便番号</label></th>
                <td>
                    <?php echo e(Form::tel('zipCode', $data->get("zipCode"), ["class" => (!empty($errors->has('zipCode')) ? "invalid-control width100" : "width100"), "id"=>"zipCode", "placeholder" => '例）100',"maxlength" =>7])); ?>

                    
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['zipCode']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="city">住所</label></th>
                <td>
                    <?php echo e(Form::text('city', $data->get("city"), ["class" => (!empty($errors->has('city')) ? "invalid-control width100" : "width100"), "id"=>"city", "placeholder" => '例 ）Taipei',"maxlength" =>56])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['city']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="phoneNumber">電話番号</label></th>
                <td>
                    <?php echo e(Form::tel('phoneNumber', $data->get("phoneNumber"), ["class" => (!empty($errors->has('phoneNumber')) ? "invalid-control width100" : "width100"), "id"=>"phoneNumber", "placeholder" => '例）0364449999',"maxlength" =>15])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['phoneNumber']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="form__controls__prev js-btn-link" data-href="<?php echo e(route('front.overseas-member-entry.revise-one')); ?>">
            <input type="submit" value="次に進む" class="form__controls__next">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>