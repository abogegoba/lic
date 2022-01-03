@extends('admin.common.root')

@section('title','予約一覧')

@section('js')
    <script src="{{ asset('js/datetime-picker.js') }}"></script>
    <script src="{{ asset('js/interview-appointment/list.js') }}"></script>
    <script>
        $(function () {
            @if(session('success') === 'create')
            $("#create-complete").show();
            setTimeout(function () {
                $("#create-complete").fadeOut(1500);
            }, 7000);
            @endif
            @if(session('success') === 'cancel')
            $("#cancel-complete").show();
            setTimeout(function () {
                $("#cancel-complete").fadeOut(1500);
            }, 7000);
            @endif
        });
    </script>
@stop

@section('content')
    <h1 class="content-title">予約一覧</h1>

    @if(session('success') === 'create')
        {{--登録完了モーダル--}}
        @include('admin.common.create_complete')
    @endif
    @if(session('success') === 'cancel')
        {{--キャンセル完了モーダル--}}
        @include('admin.common.cancel_complete')
    @endif
    @if(!empty($errors->get("business_exception")))
        @include("admin.common.input_error",["target"=>"business_exception"])
    @endif

    <async-search v-cloak id="interviewAppointment-search"
                  url="{{route("admin.interview-appointment.search")}}"
                  :initial-search="true" @if($data->has("pager.index"))
                  :initial-page-index="{{$data->get("pager.index")}}" @endif>

        <div slot="condition-field" slot-scope="component">

            <div class="form-group row">
                <label for="companyName" class="col-form-label-lg col-sm-4 col-lg-2">会社名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyName ? 'invalid-form' : '']">
                    {{Form::text('companyName',$data->get("companyName"),["id"=>"companyName","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.companyName"])
                </div>
                <label for="memberName" class="col-form-label-lg col-sm-4 col-lg-2">会員名</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberName ? 'invalid-form' : '']">
                    {{Form::text('memberName',$data->get("memberName"),["id"=>"memberName","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.memberName"])
                </div>
            </div>

            <div class="form-group row">
                <label for="companyNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会社名かな</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.companyNameKana ? 'invalid-form' : '']">
                    {{Form::text('companyNameKana',$data->get("companyNameKana"),["id"=>"companyNameKana","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.companyNameKana"])
                </div>
                <label for="memberNameKana" class="col-form-label-lg col-sm-4 col-lg-2">会員名かな</label>
                <div class="col-sm-9 col-lg-4" v-bind:class="[component.errors.memberNameKana ? 'invalid-form' : '']">
                    {{Form::text('memberNameKana',$data->get("memberNameKana"),["id"=>"memberNameKana","class"=>"form-control form-control-lg invalid-control", 'maxlength' => 255])}}
                    @include("admin.common.search_error",["target"=>"component.errors.memberNameKana"])
                </div>
            </div>

            <div class="form-group row">
                <label for="interviewAppointmentStatus" class="col-form-label-lg col-sm-3 col-lg-2">ステータス</label>
                <div class="col-sm-9 col-lg-10" v-bind:class="[component.errors.interviewAppointmentStatus ? 'invalid-form' : '']">
                    <div class="custom-control custom-radio custom-control-inline custom-control-lg col-xl-1 col-sm-6 {{!empty($errors->has('interviewAppointmentStatus')) ? 'invalid-form' : ''}}">
                        {{Form::radio('interviewAppointmentStatus', \App\Domain\Entities\interviewAppointment::STATUS_RESERVATION, 1, ["id" => "interviewAppointmentStatusReservation", "class" => "custom-control-input invalid-control"])}}
                        <label for="interviewAppointmentStatusReservation" class="custom-control-label">予約受付</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline custom-control-lg col-xl-3 col-sm-6 {{!empty($errors->has('availablePeriodNecessity')) ? 'invalid-form' : ''}}">
                        {{Form::radio('interviewAppointmentStatus', \App\Domain\Entities\interviewAppointment::STATUS_CANCEL, "", ["id" => "interviewAppointmentStatusCancel", "class" => "custom-control-input invalid-control"])}}
                        <label for="interviewAppointmentStatusCancel" class="custom-control-label">キャンセル</label>
                    </div>
                    @include("admin.common.search_error",["target"=>"component.errors.interviewAppointmentStatus"])
                </div>
                <label for="appointmentDate" class="col-sm-3 col-lg-2">予約日</label>
                <div class="col-sm-9 col-lg-10">
                    <div class="row align-items-center justify-content-start">
                        <div class="input-group date-calendar-wrap col-11 col-sm-5 col-xl-3 mb-2 mb-sm-0"
                             v-bind:class="[component.errors.startDateOfAppointmentPeriod ? 'invalid-form' : '']">
                            {{Form::text('startDateOfAppointmentPeriod',$data->getWithFormat("startDateOfAppointmentPeriod","Y/m/d"), ["class"=>"form-control invalid-control js-datepicker border-right-0"])}}
                            <div class="input-group-append invalid-control">
                                <button type="button" class="btn js-datepicker-focus">
                                    <i aria-hidden="true" class="iconfont iconfont-calendar"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto px-0">～</div>
                        <div class="input-group date-calendar-wrap col-11 col-sm-5 col-xl-3"
                             v-bind:class="[component.errors.endDateOfAppointmentPeriod ? 'invalid-form' : '']">
                            {{Form::text('endDateOfAppointmentPeriod',$data->getWithFormat("endDateOfAppointmentPeriod","Y/m/d"), ["class"=>"form-control invalid-control js-datepicker border-right-0"])}}
                            <div class="input-group-append invalid-control">
                                <button type="button" class="btn js-datepicker-focus">
                                    <i aria-hidden="true" class="iconfont iconfont-calendar"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-bind:class="[component.errors.startDateOfAppointmentPeriod || component.errors.endDateOfAppointmentPeriod ? 'invalid-form' : '']">
                        @include("admin.common.vue_input_error",["target"=>"component.errors.startDateOfAppointmentPeriod"])
                        @include("admin.common.vue_input_error",["target"=>"component.errors.endDateOfAppointmentPeriod"])
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
            @include('admin.common.create_button',["route"=>'admin.interview-appointment.create'])
        </div>

        <div slot="result-field" slot-scope="component">
            <div v-if="component.searched">
                @include('admin.common.vue_pagination')
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
                                @{{ interviewAppointment.id }}
                            </td>
                            <td>
                                    @{{ interviewAppointment.companyName }}
                            </td>
                            <td>
                                <a v-bind:href="interviewAppointment.memberEditUrl">
                                @{{ interviewAppointment.memberName }}
                                </a>
                            </td>
                            <td>
                                @{{ interviewAppointment.appointmentDate }}<br>
                                @{{ interviewAppointment.appointmentTime }}
                            </td>
                            <td>
                                @{{ interviewAppointment.status }}
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
                @include('admin.common.vue_pagination')
                <div v-if="!component.hasResults" class="alert alert-light no-data" role="alert">
                    検索結果はございません
                </div>
            </div>
        </div>
    </async-search>
    {{--キャンセル確認モーダル--}}
    {{ Form::open(["url" => route("admin.interview-appointment.cancel", ["id" => "js-interview-appointment-id"]), "id" => "js-interview-appointment-cancel-form"])}}
    @include('admin.common.modals.cancel_confirm_modal')
    {{ Form::close() }}
@stop
