

<?php $__env->startSection('title','予約一覧'); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/datetime-picker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/interview-appointment/list.js')); ?>"></script>
    <script>
        $(function () {
            <?php if(session('success') === 'create'): ?>
            $("#create-complete").show();
            setTimeout(function () {
                $("#create-complete").fadeOut(1500);
            }, 7000);
            <?php endif; ?>
            <?php if(session('success') === 'cancel'): ?>
            $("#cancel-complete").show();
            setTimeout(function () {
                $("#cancel-complete").fadeOut(1500);
            }, 7000);
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="content-title">予約一覧</h1>

    <?php if(session('success') === 'create'): ?>
        
        <?php echo $__env->make('admin.common.create_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(session('success') === 'cancel'): ?>
        
        <?php echo $__env->make('admin.common.cancel_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(!empty($errors->get("business_exception"))): ?>
        <?php echo $__env->make("admin.common.input_error",["target"=>"business_exception"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <async-search v-cloak id="interviewAppointment-search"
                  url="<?php echo e(route("admin.interview-appointment.search")); ?>"
                  :initial-search="true" <?php if($data->has("pager.index")): ?>
                  :initial-page-index="<?php echo e($data->get("pager.index")); ?>" <?php endif; ?>>

        <div slot="condition-field" slot-scope="component">

            <div class="form-group row">
                <label for="companyName" class="col-form-label-lg col-sm-4 col-lg-2">会社名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyName ? 'invalid-form' : '']">
                    <?php echo e(Form::text('companyName',$data->get("companyName"),["id"=>"companyName","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])); ?>

                    <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.companyName"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <label for="memberName" class="col-form-label-lg col-sm-4 col-lg-2">会員名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberName ? 'invalid-form' : '']">
                    <?php echo e(Form::text('memberName',$data->get("memberName"),["id"=>"memberName","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])); ?>

                    <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.memberName"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="companyNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会社名かな</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyNameKana ? 'invalid-form' : '']">
                    <?php echo e(Form::text('companyNameKana',$data->get("companyNameKana"),["id"=>"companyNameKana","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])); ?>

                    <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.companyNameKana"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <label for="memberNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会員名かな</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberNameKana ? 'invalid-form' : '']">
                    <?php echo e(Form::text('memberNameKana',$data->get("memberNameKana"),["id"=>"memberNameKana","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])); ?>

                    <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.memberNameKana"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="interviewAppointmentStatus" class="col-form-label-lg col-sm-3 col-lg-2">ステータス</label>
                <div class="col-sm-9 col-lg-10" v-bind:class="[component.errors.interviewAppointmentStatus ? 'invalid-form' : '']">
                    <div class="custom-control custom-radio custom-control-inline custom-control-lg col-xl-1 col-sm-6 <?php echo e(!empty($errors->has('interviewAppointmentStatus')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::radio('interviewAppointmentStatus', \App\Domain\Entities\interviewAppointment::STATES_RESERVATION, 1, ["id" => "interviewAppointmentStatusReservation", "class" => "custom-control-input invalid-control"])); ?>

                        <label for="interviewAppointmentStatusReservation" class="custom-control-label">予約受付</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline custom-control-lg col-xl-3 col-sm-6 <?php echo e(!empty($errors->has('availablePeriodNecessity')) ? 'invalid-form' : ''); ?>">
                        <?php echo e(Form::radio('interviewAppointmentStatus', \App\Domain\Entities\interviewAppointment::STATES_CANCEL, "", ["id" => "interviewAppointmentStatusCancel", "class" => "custom-control-input invalid-control"])); ?>

                        <label for="interviewAppointmentStatusCancel" class="custom-control-label">キャンセル</label>
                    </div>
                    <?php echo $__env->make("admin.common.search_error",["target"=>"component.errors.interviewAppointmentStatus"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <label for="appointmentDate" class="col-sm-3 col-lg-2">予約日</label>
                <div class="col-sm-9 col-lg-10">
                    <div class="row align-items-center justify-content-start">
                        <div class="input-group date-calendar-wrap col-11 col-sm-5 col-xl-3 mb-2 mb-sm-0"
                             v-bind:class="[component.errors.startDateOfAppointmentPeriod ? 'invalid-form' : '']">
                            <?php echo e(Form::text('startDateOfAppointmentPeriod',$data->getWithFormat("startDateOfAppointmentPeriod","Y/m/d"), ["class"=>"form-control invalid-control js-datepicker border-right-0"])); ?>

                            <div class="input-group-append invalid-control">
                                <button type="button" class="btn js-datepicker-focus">
                                    <i aria-hidden="true" class="iconfont iconfont-calendar"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto px-0">～</div>
                        <div class="input-group date-calendar-wrap col-11 col-sm-5 col-xl-3"
                             v-bind:class="[component.errors.endDateOfAppointmentPeriod ? 'invalid-form' : '']">
                            <?php echo e(Form::text('endDateOfAppointmentPeriod',$data->getWithFormat("endDateOfAppointmentPeriod","Y/m/d"), ["class"=>"form-control invalid-control js-datepicker border-right-0"])); ?>

                            <div class="input-group-append invalid-control">
                                <button type="button" class="btn js-datepicker-focus">
                                    <i aria-hidden="true" class="iconfont iconfont-calendar"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-bind:class="[component.errors.startDateOfAppointmentPeriod || component.errors.endDateOfAppointmentPeriod ? 'invalid-form' : '']">
                        <?php echo $__env->make("admin.common.vue_input_error",["target"=>"component.errors.startDateOfAppointmentPeriod"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make("admin.common.vue_input_error",["target"=>"component.errors.endDateOfAppointmentPeriod"], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
            <?php echo $__env->make('admin.common.create_button',["route"=>'admin.interview-appointment.create'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

        <div slot="result-field" slot-scope="component">
            <div v-if="component.searched">
                <?php echo $__env->make('admin.common.vue_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div v-if="component.hasResults" class="table-responsive-md my-3">
                    <table class="table table-bordered table-striped">
                        <colgroup>
                            <col class="tw-5">
                            <col class="tw-25">
                            <col class="tw-25">
                            <col class="tw-15">
                            <col class="tw-15">
                            <col class="tw-5">
                        </colgroup>
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">
                                会社名
                            </th>
                            <th scope="col">
                                会員名
                            </th>
                            <th scope="col">
                                予約日時
                            </th>
                            <th scope="col">
                                ステータス
                            </th>
                            <th scope="col">
                                詳細
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="interviewAppointment in component.result.interviewAppointments">
                            <td class="text-center">
                                {{ interviewAppointment.id }}
                            </td>
                            <td>
                                    {{ interviewAppointment.companyName }}
                            </td>
                            <td>
                                <a v-bind:href="interviewAppointment.memberEditUrl">
                                {{ interviewAppointment.memberName }}
                                </a>
                            </td>
                            <td>
                                {{ interviewAppointment.appointmentDate }}<br>
                                {{ interviewAppointment.appointmentTime }}
                            </td>
                            <td>
                                {{ interviewAppointment.status }}
                            </td>
                            <td class="text-center cell-btn">
                                <button type="button" class="cell-btn-icon js-btn-link" v-bind:data-href="interviewAppointment.detailUrl">
                                    <i aria-hidden="true" class="iconfont iconfont-file"></i>
                                </button>
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
    
    <?php echo e(Form::open(["url" => route("admin.interview-appointment.cancel", ["id" => "js-interview-appointment-id"]), "id" => "js-interview-appointment-cancel-form"])); ?>

    <?php echo $__env->make('admin.common.modals.cancel_confirm_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>