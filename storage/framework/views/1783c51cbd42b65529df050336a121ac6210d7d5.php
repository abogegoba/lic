<strong>基本情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <?php if($viewType === 'edit'): ?>
        <tr>
            <th>
                ID
            </th>
            <td>
                <?php echo e($data->get('jobApplication.id')); ?>

            </td>
        </tr>
    <?php endif; ?>
    <tr>
        <th class="required-icon">
            対象企業
        </th>
        <td>
            <div class="input-group <?php echo e(!empty($errors->has('companyName')) || !empty($errors->has('selectedCompanyId')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('companyName', '', ['list' => 'companyList', 'autocomplete' => 'off', 'class' => 'form-control col-md-4 invalid-control js-company',
                'placeholder' => '会社名、かなを入力して選択', 'maxlength' => '255'])); ?>

                <datalist id="companyList">
                    <?php $__currentLoopData = $data->get('companyList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $companyData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="test" name="<?php echo e($companyData['name']); ?>" id="<?php echo e($key); ?>" value="<?php echo e($companyData['name']); ?>"><?php echo e($companyData['nameKana']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </datalist>
                <input name="selectedCompanyId" type="hidden" class="js-selected-company-id" value="">
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'companyName'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'selectedCompanyId'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.business_error', ['errors' => $errors, 'target' => 'not_found_target_company'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div id="js-company-id" class="text-muted display-company-data"></div>
            <div id="js-company-name" class="text-muted display-company-data"></div>
            <?php if($viewType === 'edit'): ?>
                <input name="registeredCompanyId" type="hidden" class="js-registered-company-id" value="<?php echo e($data->get('company.id')); ?>">
                <input name="registeredCompanyName" type="hidden" class="js-registered-company-name" value="<?php echo e($data->get('company.name')); ?>">
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            タイトル
        </th>
        <td>
            <div class="input-group <?php echo e(!empty($errors->has('title')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('title', $data->get('jobApplication.title'), ['class' => 'form-control invalid-control',
                'placeholder' => '例）本気で世界進出を目指している方、お待ちしてます。', 'maxlength' => '400'])); ?>

            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'title'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            募集職種
        </th>
        <td>
            <div class="row <?php echo e(!empty($errors->has('jobType')) ? 'invalid-form' : ''); ?>">
                <div class="col-xl-4 col-md-6 mb-xl-0 mb-3">
                    <?php $__currentLoopData = $data->get('firstRowInJobTypeList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $firstRowInJobTypeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="custom-control custom-radio">
                            <?php echo e(Form::radio('jobType', $key, ($data->get('jobType') === $key) ? "checked='checked'":"",
                             ["id" => "jobType_$key", 'class' => 'custom-control-input invalid-control'])); ?>

                            <label for="jobType_<?php echo e($key); ?>" class="custom-control-label">
                                <span><?php echo e($firstRowInJobTypeLabel); ?></span>
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-xl-4 col-md-6 mb-xl-0 mb-3">
                    <?php $__currentLoopData = $data->get('secondRowInJobTypeList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $secondRowInJobTypeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="custom-control custom-radio">
                            <?php echo e(Form::radio('jobType', $key, ($data->get('jobType') === $key) ? "checked='checked'":"",
                             ["id" => "jobType_$key", 'class' => 'custom-control-input invalid-control'])); ?>

                            <label for="jobType_<?php echo e($key); ?>" class="custom-control-label">
                                <span><?php echo e($secondRowInJobTypeLabel); ?></span>
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-xl-4 col-md-6">
                    <?php $__currentLoopData = $data->get('thirdRowInJobTypeList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $thirdRowInJobTypeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="custom-control custom-radio">
                            <?php echo e(Form::radio('jobType', $key, ($data->get('jobType') === $key) ? "checked='checked'":"",
                             ["id" => "jobType_$key", 'class' => 'custom-control-input invalid-control'])); ?>

                            <label for="jobType_<?php echo e($key); ?>" class="custom-control-label">
                                <span><?php echo e($thirdRowInJobTypeLabel); ?></span>
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            募集職種説明
        </th>
        <td class="<?php echo e(!empty($errors->has('recruitmentJobTypeDescription')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('recruitmentJobTypeDescription', $data->get('jobApplication.recruitmentJobTypeDescription'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）技術職を担当していただきます。', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentJobTypeDescription'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            仕事内容
        </th>
        <td class="<?php echo e(!empty($errors->has('jobDescription')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('jobDescription', $data->get('jobApplication.jobDescription'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）各種システムのUI・UXデザイン', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'jobDescription'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            雇用形態
        </th>
        <td>
            <?php $__currentLoopData = $data->get('employmentTypeList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employmentTypeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="custom-control custom-radio custom-control-inline col-md-3 <?php echo e(!empty($errors->has('employmentType')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::radio('employmentType', $key, ($data->get('jobApplication.employmentType') === $key) ? "checked='checked'":$key === \App\Domain\Entities\JobApplication::EMPLOYMENT_TYPE_REGULAR,
                 ["id" => "employment_$key", 'class' => 'custom-control-input invalid-control'])); ?>

                    <label for="employment_<?php echo e($key); ?>" class="custom-control-label"><?php echo e($employmentTypeLabel); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'employmentType'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            求める人物像
        </th>
        <td class="<?php echo e(!empty($errors->has('statue')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('statue', $data->get('jobApplication.statue'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）仕事の場での自己実現を通して人間性を高め、さらに会社を一緒に創っていく意欲のある方と共に働きたいと考えています。', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'statue'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            選考方法
        </th>
        <td class="<?php echo e(!empty($errors->has('screeningMethod')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('screeningMethod', $data->get('jobApplication.screeningMethod'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）Web面接', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'screeningMethod'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            給与
        </th>
        <td class="<?php echo e(!empty($errors->has('compensation')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('compensation', $data->get('jobApplication.compensation'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）2019年3月卒&#13;&#10;月給19万5000円&#13;&#10;※2019年4月見込', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'compensation'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            賞与・昇給・手当
        </th>
        <td class="<?php echo e(!empty($errors->has('bonus')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('bonus', $data->get('jobApplication.bonus'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）昇給年1回（4月）&#13;&#10;賞与年2回（7月、12月）&#13;&#10;住宅手当、家族手当、時間外手当、通勤手当', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'bonus'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            勤務地
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area1')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area1',  $data->get('prefectureList'), $data->get('area1'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area2')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area2',  $data->get('prefectureList'), $data->get('area2'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area3')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area3',  $data->get('prefectureList'), $data->get('area3'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area4')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area4',  $data->get('prefectureList'), $data->get('area4'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area5')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area5',  $data->get('prefectureList'), $data->get('area5'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area6')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area6',  $data->get('prefectureList'), $data->get('area6'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area7')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area7',  $data->get('prefectureList'), $data->get('area7'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area8')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area8',  $data->get('prefectureList'), $data->get('area8'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area9')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area9',  $data->get('prefectureList'), $data->get('area9'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
                <div class="input-group col-sm-5 col-xl-3 <?php echo e(!empty($errors->has('area10')) ? 'invalid-form' : ''); ?>" style="margin-bottom: 1em;">
                    <?php echo e(Form::select('area10',  $data->get('prefectureList'), $data->get('area10'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])); ?>

                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area1'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area2'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area3'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area4'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area5'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area6'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area7'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area8'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area9'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'area10'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.common.business_error', ['errors' => $errors, 'target' => 'duplication.recruitment_work_location'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            勤務時間
        </th>
        <td class="<?php echo e(!empty($errors->has('dutyHours')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('dutyHours', $data->get('jobApplication.dutyHours'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）9:00～17:45（実働7時間45分）&#13;&#10;始業時刻は、営業所により異なります。', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'dutyHours'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            待遇・福利厚生
        </th>
        <td class="<?php echo e(!empty($errors->has('compensationPackage')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('compensationPackage', $data->get('jobApplication.compensationPackage'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）労働組合あり、退職金制度あり、確定拠出年金制度あり', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'compensationPackage'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            休日・休暇
        </th>
        <td class="<?php echo e(!empty($errors->has('nonWorkDay')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('nonWorkDay', $data->get('jobApplication.nonWorkDay'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）週休2日制、年間休日数120日、有給休暇、夏季休暇（3日）、リフレッシュ休暇（5日）、年末年始休暇', 'maxlength' => '400'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'nonWorkDay'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            採用予定数
        </th>
        <td>
            <div class="input-group <?php echo e(!empty($errors->has('recruitmentNumber')) ? 'invalid-form' : ''); ?>">
                <?php echo e(Form::text('recruitmentNumber', $data->get('jobApplication.recruitmentNumber'), ['class' => 'form-control col-md-3 invalid-control',
                'placeholder' => '例）5', 'maxlength' => 4])); ?>

                <div class="input-group-append">
                    <div class="input-group-text input-group-transparent pr-0">名</div>
                </div>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentNumber'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
        <td class="<?php echo e(!empty($errors->has('managementMemo')) ? 'invalid-form' : ''); ?>">
            <?php echo e(Form::textarea('managementMemo', $data->get('jobApplication.managementMemo'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）2019/10/21採用担当の鈴木さまから内定のため掲載終了の連絡あり。ステータスを非表示にしました。', 'maxlength' => '4000'])); ?>

            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'managementMemo'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            ステータス
        </th>
        <td>
            <?php $__currentLoopData = $data->get('statusDisplayList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $statusDisplayLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="custom-control custom-radio custom-control-inline col-md-3 <?php echo e(!empty($errors->has('status')) ? 'invalid-form' : ''); ?>">
                    <?php echo e(Form::radio('status', $key, ($data->get('jobApplication.status') === $key) ? "checked='checked'":$key === \App\Domain\Entities\JobApplication::STATUS_DISPLAY,
                 ["id" => "status_$key", 'class' => 'custom-control-input invalid-control'])); ?>

                    <label for="status_<?php echo e($key); ?>" class="custom-control-label"><?php echo e($statusDisplayLabel); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div>
                <small class="text-muted">
                    ※求人ステータスは学生掲載版からも変更可能です。求人を制限する際は企業の求人枠で調整してください。
                </small>
            </div>
            <?php echo $__env->make('admin.common.input_error', ['errors' => $errors, 'target' => 'status'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
    </tr>
    </tbody>
</table>