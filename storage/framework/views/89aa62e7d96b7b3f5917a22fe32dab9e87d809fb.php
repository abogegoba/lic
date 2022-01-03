

<?php $__env->startSection('title','企業一覧'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="content-title">企業一覧</h1>

    <?php if(session('success') === 'delete'): ?>
        
        <?php echo $__env->make('admin.common.delete_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(session('success') === 'edit'): ?>
        
        <?php echo $__env->make('admin.common.edit_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(!empty($errors->get("business_exception"))): ?>
        <?php echo $__env->make("admin.common.input_error",["target"=>"business_exception"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <async-search v-cloak id="company-search"
                  url="<?php echo e(route("admin.company.search")); ?>"
                  :initial-search="true" <?php if($data->has("pager.index")): ?>
                  :initial-page-index="<?php echo e($data->get("pager.index")); ?>" <?php endif; ?>>

        <div slot="condition-field" slot-scope="component">

            <div class="form-group row">
                <label for="companyName" class="col-form-label-lg col-sm-4 col-lg-2">会社名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyName ? 'invalid-form' : '']">
                    <?php echo e(Form::text('companyName',$data->get("companyName"),["id"=>"companyName","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）株式会社infit",'maxlength' => 255])); ?>

                    <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.companyName"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <label for="companyStatus" class="col-form-label-lg col-sm-3 col-lg-2">ステータス</label>
                <div class="col-sm-9 col-lg-4">
                    <?php $__currentLoopData = $data->get("companyStatusList"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $companyStatusLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="custom-control custom-checkbox custom-control-inline custom-control-lg col-xl-4 col-sm-4" v-bind:class="[component.errors.companyStatus ? 'invalid-form' : '']">
                            <?php echo e(Form::checkbox("companyStatusList[$value]", $value, ($data->get("companyStatus") == $value) ? "checked='checked'": $value === "1",
                            ["id" => "companyStatus$value", "class" => "custom-control-input"])); ?>

                            <label for="companyStatus<?php echo e($value); ?>" class="custom-control-label"><?php echo e($companyStatusLabel); ?></label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div v-bind:class="[component.errors.companyStatus ? 'invalid-form' : '']">
                        <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.companyStatus"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="companyNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会社名かな</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyNameKana ? 'invalid-form' : '']">
                    <?php echo e(Form::text('companyNameKana',$data->get("companyNameKana"),["id"=>"companyNameKana","class"=>"form-control form-control-lg invalid-control", "placeholder"=>"例）かぶしきがいしゃいんふぃっと",'maxlength' => 255])); ?>

                    <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.companyNameKana"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <label for="jobApplicationAvailableNumber" class="col-form-label-lg col-sm-3 col-lg-2">求人枠</label>
                <div class="col-sm-9 col-lg-4">
                    <div class="row align-items-center justify-content-start">
                        <div class="input-group col-11 col-sm-3 mb-2 mb-sm-0"
                             v-bind:class="[component.errors.minJobApplicationAvailableNumber ? 'invalid-form' : '']">
                            <?php echo e(Form::select("minJobApplicationAvailableNumber", $data->get("jobApplicationAvailableNumberList"), $data->get("minJobApplicationAvailableNumber"), ['class'=>'form-control invalid-control form-control-lg border-right-0', "placeholder" => ""])); ?>

                        </div>
                        <div class="col-auto px-0">～</div>
                        <div class="input-group col-11 col-sm-3"
                             v-bind:class="[component.errors.maxJobApplicationAvailableNumber ? 'invalid-form' : '']">
                            <?php echo e(Form::select("maxJobApplicationAvailableNumber", $data->get("jobApplicationAvailableNumberList"), $data->get("maxJobApplicationAvailableNumber"), ['class'=>'form-control invalid-control form-control-lg border-right-0', "placeholder" => ""])); ?>

                        </div>
                    </div>
                    <div v-bind:class="[component.errors.minJobApplicationAvailableNumber || component.errors.maxJobApplicationAvailableNumber ? 'invalid-form' : '']">
                        <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.minJobApplicationAvailableNumber"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make("admin.common.vue_input_error",["target"=>"component.errors.maxJobApplicationAvailableNumber"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </div>

            <div class="btn-row mb-5">
                <div class="btn-col btn-row-sm">
                    <button type="button" v-on:click="component.search" class="btn btn-lg btn-primary">
                        <i aria-hidden="true" class="iconfont iconfont-search icon-xl"></i>
                        <span>検索する</span>
                    </button>
                </div>
            </div>
            <?php echo $__env->make('admin.common.create_button',["route"=>'admin.company.create'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div slot="result-field" slot-scope="component">
            <div v-if="component.searched">
                <?php echo $__env->make('admin.common.vue_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div v-if="component.hasResults" class="table-responsive-md my-3">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="tw-5">
                            <col class="tw-30">
                            <col class="tw-25">
                            <col class="tw-15">
                            <col class="tw-10">
                            <col class="tw-10">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">
                                企業名
                            </th>
                            <th scope="col">
                                連絡先電話番号
                            </th>
                            <th scope="col">
                                求人枠
                            </th>
                            <th scope="col">
                                公開求人数
                            </th>
                            <th scope="col">
                                ステータス
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="company in component.result.companies">
                            <td class="text-center">
                                {{ company.id }}
                            </td>
                            <td>
                                <a v-bind:href="company.editUrl">
                                {{ company.companyName }}
                                </a>
                            </td>
                            <td>
                                {{ company.picPhoneNumber }}
                            </td>
                            <td>
                                {{ company.jobApplicationAvailableNumber }}
                            </td>
                            <td>
                                {{ company.publishJobApplication }}
                            </td>
                            <td>
                                {{ company.status }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php echo $__env->make('admin.common.vue_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div v-if="!component.hasResults" class="alert alert-light no-data" role="alert">
                    検索結果はございません
                </div>
            </div>
        </div>
    </async-search>
    
    <?php echo e(Form::open(["url" => '#',"id" => "js-member-delete-form"])); ?>

    <?php echo $__env->make('admin.common.modals.delete_confirm_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>