@extends('admin.common.root')

@section('title','予約詳細')

@section('content')
    <h1 class="content-title">予約詳細</h1>

    <div style="margin-bottom: 2em;">
        <a href="{{route('admin.interview-appointment.reload')}}">< 予約一覧に戻る</a>
    </div>

    <strong>基本情報</strong>
    <table class="table table-form mb-5">
        <colgroup>
            <col class="w-20">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th>
                ID
            </th>
            <td>
                {{$data->get("interviewAppointment.id")}}
            </td>
        </tr>
        <tr>
            <th>
                対象企業
            </th>
            <td>
                <div>
                    ID：{{$data->get("interviewAppointment.companyUserAccount.companyAccount.company.id")}}
                </div>
                <div>
                    会社名：{{$data->get("interviewAppointment.companyUserAccount.companyAccount.company.name")}}（{{$data->get("interviewAppointment.companyUserAccount.companyAccount.company.nameKana")}}）
                </div>
            </td>
        </tr>
        <tr>
            <th>
                対象会員
            </th>
            <td>
                <div>
                    ID：{{$data->get("interviewAppointment.memberUserAccount.member.id")}}
                </div>
                <div>
                    会員名：{{$data->get("interviewAppointment.memberUserAccount.member.lastName")}}&nbsp;{{$data->get("interviewAppointment.memberUserAccount.member.firstName")}}（{{$data->get("interviewAppointment.memberUserAccount.member.lastNameKana")}}&nbsp;{{$data->get("interviewAppointment.memberUserAccount.member.firstNameKana")}}）
                </div>
                <div>
                    連絡先電話番号：{{$data->get("interviewAppointment.memberUserAccount.member.phoneNumber")}}
                </div>
                <div>
                    メールアドレス：{{$data->get("interviewAppointment.memberUserAccount.mailAddress")}}
                </div>
            </td>
        </tr>
        <tr>
            <th>
                予約日時
            </th>
            <td>
                {{$data->getWithFormat("interviewAppointment.appointmentDatetime","Y年m月d日 h:i")}}
            </td>
        </tr>
        <tr>
            <th>
                面接URL
            </th>
            <td>
                <div>
                    会員用：　<a target="_blank" href="{{env("FRONT_APP_URL")}}/mypage/video/{{$data->get("interviewAppointment.id")}}/reservation-detail">{{env("FRONT_APP_URL")}}/mypage/video/{{$data->get("interviewAppointment.id")}}/reservation-detail</a>
                </div>
                <div>
                    担当者用：<a target="_blank" href="{{env("CLIENT_APP_URL")}}/mypage/video/{{$data->get("interviewAppointment.id")}}/reservation-detail">{{env("CLIENT_APP_URL")}}/mypage/video/{{$data->get("interviewAppointment.id")}}/reservation-detail</a>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                内容
            </th>
            <td>
                {!!nl2br($data->get("interviewAppointment.content"))!!}
            </td>
        </tr>
        </tbody>
    </table>

    {{ Form::open(["url" => route("admin.interview-appointment.cancel", ["interviewAppointmentId" => $data->get("interviewAppointment.id")])])}}
    <strong>キャンセル情報</strong>
    <table class="table table-form mb-5">
        <colgroup>
            <col class="w-20">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th>
                キャンセルメッセージ
            </th>
            <td>
                <div class="{{!empty($errors->has('cancelMessage')) ? 'invalid-form' : ''}}">
                    {{Form::textarea('cancelMessage', $data->get("cancelMessage"), ["class" => "form-control invalid-control", "maxlength" => 400])}}
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'cancelMessage'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                会員へメール送信
            </th>
            <td class="{{!empty($errors->has('sendMailToMember')) ? 'invalid-form' : ''}}">
                <div class="custom-control-inline">
                    <div class="mx-2">
                        {{Form::radio('sendMailToMember', 1, ($data->get("sendMailToMember") == 1 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail-to-member_1"])}}
                        <label for="send-mail-to-member_1"><span>送信する</span></label>
                    </div>
                    <div class="mx-2">
                        {{Form::radio('sendMailToMember', 0, ($data->get("sendMailToMember") == 0 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail-to-member_0"])}}
                        <label for="send-mail-to-member_0"><span>送信しない</span></label>
                    </div>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'sendMailToMember'])
            </td>
        </tr>
        <tr>
            <th class="required-icon">
                担当者へメール送信
            </th>
            <td class="{{!empty($errors->has('sendMailToCompany')) ? 'invalid-form' : ''}}">
                <div class="custom-control-inline">
                    <div class="mx-2">
                        {{Form::radio('sendMailToCompany', 1, ($data->get("sendMailToCompany") == 1 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail-to-company_1"])}}
                        <label for="send-mail-to-company_1"><span>送信する</span></label>
                    </div>
                    <div class="mx-2">
                        {{Form::radio('sendMailToCompany', 0, ($data->get("sendMailToCompany") == 0 ? "checked='checked'":""), ["class" =>  "invalid-control", "id"=>"send-mail-to-company_0"])}}
                        <label for="send-mail-to-company_0"><span>送信しない</span></label>
                    </div>
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'sendMailToCompany'])
            </td>
        </tr>
        </tbody>
    </table>
    {{ Form::close() }}

    <div class="btn-row btn-row" style="margin-bottom: 2em;">
        <div class="btn-col btn-row-sm">
            <button type="button" class="btn btn-secondary btn-lg js-btn-link" data-href="{{route("admin.interview-appointment.reload")}}">
                <i class="iconfont iconfont-times-circle icon-lg" aria-hidden="true"></i>
                <span>一覧に戻る</span>
            </button>
        </div>
        <div class="btn-col btn-row-sm">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-cancel">
                <i class="iconfont iconfont-plus-circle icon-lg" aria-hidden="true"></i>
                <span>キャンセルする</span>
            </button>
        </div>
    </div>

    <a href="{{route('admin.interview-appointment.reload')}}">< 予約一覧に戻る</a>

    {{--キャンセル確認モーダル--}}
    @include('admin.common.modals.cancel_confirm_modal')
@stop