<?php $__env->startSection('title','学校情報入力│会員登録｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/entry/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header id="main__hdr">
        <img src="<?php echo e(asset('img/entry/icon_title_entry03.png')); ?>" alt="学校情報入力">
        <div>
            <h1>学校情報入力</h1>
            <p>最終学歴をご入力ください。</p>
        </div>
    </header>
    <div id="main__content">
        <?php echo e(Form::open(['url'=>route('front.member-entry.three-next')])); ?>

        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="schoolType">学校種別</label></th>
                <td>
                    <div class="selectBox__wrapper width75">
                        <?php echo e(Form::select('schoolType', $data->get("schoolTypeList"), $data->get("schoolType"), ["class" => (!empty($errors->has('schoolType')) ? "invalid-control" : ""), "id"=>"schoolType","placeholder" => "選択してください"])); ?>

                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['schoolType']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="name">学校名</label></th>
                <td>
                    <?php echo e(Form::text('name', $data->get("name"), ["class" => (!empty($errors->has('name')) ? "invalid-control width100" : "width100"), "id"=>"name", "placeholder" => "例）東京大学", "maxlength" =>24])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['name']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="departmentName">学部・学科名</label></th>
                <td>
                    <?php echo e(Form::text('departmentName', $data->get("departmentName"), ["class" => (!empty($errors->has('departmentName')) ? "invalid-control width100" : "width100"), "id"=>"departmentName", "placeholder" => "例）経済学部経済学科", "maxlength" =>24])); ?>

                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['departmentName']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="facultyType">学部系統</label></th>
                <td>
                    <div class="selectBox__wrapper width100">
                    <?php echo e(Form::select('facultyType', $data->get("facultyTypeList"), $data->get("facultyType"), ["class" => (!empty($errors->has('facultyType')) ? "invalid-control width100" : "width100"), "id"=>"facultyType", "placeholder" => "選択して下さい",])); ?>

                    </div>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['facultyType']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="graduationPeriodYear">卒業年月</label></th>
                <td>
                    <div class="flex--bet">

                        <div class="selectBox__wrapper width45">
                            <?php echo e(Form::select('graduationPeriodYear', $data->get("yearList"), $data->get("graduationPeriodYear"), ["class" => ((!empty($errors->has('graduationPeriodYear'))|| !empty($errors->get("business_exception")['business.graduationPeriodMonth'])) ? "invalid-control" : ""), "id"=>"graduationPeriodYear"])); ?>

                        </div>
                        <div class="selectBox__wrapper width45">
                            <?php echo e(Form::select('graduationPeriodMonth', $data->get("monthList"), $data->get("graduationPeriodMonth")? $data->get("graduationPeriodMonth"):"3", ["class" => (!empty($errors->has('graduationPeriodMonth')) ? "invalid-control" : ""), "id"=>"graduationPeriodMonth" ,"placeholder" => "選択してください"])); ?>

                        </div>
                    </div>
                    <?php echo $__env->make('front.common.business_error', ['errors'=>$errors, 'target'=>'cant_store_graduation_period'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['graduationPeriodYear','graduationPeriodMonth']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="form__controls__prev js-btn-link" data-href="<?php echo e(route('front.member-entry.revise-two')); ?>">
            <input type="submit" value="次に進む" class="form__controls__next">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>