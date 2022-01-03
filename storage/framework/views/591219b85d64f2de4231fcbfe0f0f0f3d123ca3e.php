<?php $__env->startSection('title','志望情報│プロフィール変更│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/profile/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li>プロフィール変更入力（志望情報）</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="main__content">
        <?php echo e(Form::open(['url'=>route('front.profile.desired.edit.store')])); ?>

            <table class="form__table">
                <tr class="invalid-form">
                    <th class="required"><label for="industry1">志望業種</label></th>
                    <td>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('industry1', $data->get("businessTypeList"), $data->get("industry1"), ["class" => (!empty($errors->has('industry1')) ? "invalid-control width100" : "width100"), "id"=>"industry1","placeholder" => "選択してください"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['industry1']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('industry2', $data->get("businessTypeList"), $data->get("industry2"), ["class" => (!empty($errors->has('industry2')) ? "invalid-control width100" : "width100"), "id"=>"industry2","placeholder" => "選択してください"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['industry2']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('industry3', $data->get("businessTypeList"), $data->get("industry3"), ["class" => (!empty($errors->has('industry3')) ? "invalid-control width100" : "width100"), "id"=>"industry3","placeholder" => "選択してください"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['industry3']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th><label for="jobType1">志望職種</label></th>
                    <td>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('jobType1', $data->get("jobTypeList"), $data->get("jobType1"), ["class" => (!empty($errors->has('jobType1')) ? "invalid-control width100" : "width100"), "id"=>"jobType1","placeholder" => "選択してください"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['jobType1']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('jobType2', $data->get("jobTypeList"), $data->get("jobType2"), ["class" => (!empty($errors->has('jobType2')) ? "invalid-control width100" : "width100"), "id"=>"jobType2","placeholder" => "選択してください"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['jobType2']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('jobType3', $data->get("jobTypeList"), $data->get("jobType3"), ["class" => (!empty($errors->has('jobType3')) ? "invalid-control width100" : "width100"), "id"=>"jobType3","placeholder" => "選択してください"])); ?>

                            <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['jobType3']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="location1">志望勤務地</label></th>
                    <td>
                        <div class="selectBox__wrapper width100">
                            <div class="selectBox__wrapper width100">
                                <?php echo e(Form::select('location1', $data->get("prefectureList"), $data->get("location1"), ["class" => (!empty($errors->has('location1')) ? "invalid-control width100" : "width100"), "id"=>"location1","placeholder" => "選択してください"])); ?>

                                <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['location1']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>
                        <div class="selectBox__wrapper width100">
                            <div class="selectBox__wrapper width100">
                                <?php echo e(Form::select('location2', $data->get("prefectureList"), $data->get("location2"), ["class" => (!empty($errors->has('location2')) ? "invalid-control width100" : "width100"), "id"=>"location2","placeholder" => "選択してください"])); ?>

                                <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['location2']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>
                        <div class="selectBox__wrapper width100">
                            <div class="selectBox__wrapper width100">
                                <?php echo e(Form::select('location3', $data->get("prefectureList"), $data->get("location3"), ["class" => (!empty($errors->has('location3')) ? "invalid-control width100" : "width100"), "id"=>"location3","placeholder" => "選択してください"])); ?>

                                <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['location3']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th><label for="intern">インターン</label></th>
                    <td>
                        
                        <?php echo e(Form::checkbox('intern', 1, ($data->get("intern") === true)? "checked":"", ["class" => (!empty($errors->has('intern')) ? "invalid-control" : ""), "id"=>"intern"])); ?>

                        <label for="intern">希望する</label>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['intern']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th><label for="recruitInfo">就活イベントやその他就職活動に関する情報取得について</label></th>
                    <td>
                        
                        <?php echo e(Form::checkbox('recruitInfo', 1, ($data->get("recruitInfo") === true)? "checked":"", ["class" => (!empty($errors->has('recruitInfo')) ? "invalid-control" : ""), "id"=>"recruitInfo"])); ?>

                        <label for="recruitInfo">希望する</label>
                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['recruitInfo']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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