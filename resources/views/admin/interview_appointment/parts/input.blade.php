<strong>基本情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th class="required-icon">
            対象企業
        </th>
        <td>
            <data-list-select v-cloak list-json="{{json_encode($data->get('companyList'))}}" {{!empty($data->has('companyId')) ? ':selected-id="'.$data->get('companyId').'"' : ''}}>
                <template slot="field" slot-scope="component">
                    <div class="input-group {{!empty($errors->has('companyId')) ? 'invalid-form' : ''}}">
                        {{Form::text('companyName', '', [
                                'list' => 'companyList',
                                'autocomplete' => 'off',
                                'class' => 'form-control col-md-8 invalid-control','placeholder' => '会社名、かなを入力して選択',
                                'maxlength' => '255',
                                'v-bind:value' => "component.selectedDataName",
                                'v-on:change' => 'component.selectData'
                            ]
                        )}}
                        <datalist id="companyList">
                            <template v-for="(data, id) in component.dataList">
                                <option v-bind:value="id + ':' + data.name">
                                    @{{data.nameKana}}
                                </option>
                            </template>
                        </datalist>
                    </div>
                    @include('admin.common.input_error', ['errors' => $errors, 'target' => 'companyId'])
                    @include('admin.common.business_error', ['errors' => $errors, 'target' => 'not_found_target_company'])
                    <template v-if="component.selectedData.id">
                        {{Form::hidden('companyId', null, ["v-bind:value"=>"component.selectedData.id"])}}
                        <div class="text-muted">
                            ID：@{{component.selectedData.id}}
                        </div>
                        <div class="text-muted">
                            会社名：@{{component.selectedData.name}}
                        </div>
                    </template>
                </template>
            </data-list-select>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            対象会員
        </th>
        <td>
            <data-list-select v-cloak list-json="{{json_encode($data->get('memberList'))}}" {{!empty($data->has('memberId')) ? ':selected-id="'.$data->get('memberId').'"' : ''}}>
                <template slot="field" slot-scope="component">
                    <div class="input-group {{!empty($errors->has('memberId')) ? 'invalid-form' : ''}}">
                        {{Form::text('mamberName', '', [
                                'list' => 'memberList',
                                'autocomplete' => 'off',
                                'class' => 'form-control col-md-8 invalid-control','placeholder' => '会員名、かなを入力して選択',
                                'maxlength' => '255',
                                'v-bind:value' => "component.selectedDataName",
                                'v-on:change' => 'component.selectData'
                            ]
                        )}}
                        <datalist id="memberList">
                            <template v-for="(data, id) in component.dataList">
                                <option v-bind:value="id + ':' + data.name">
                                    @{{data.nameKana}}
                                </option>
                            </template>
                        </datalist>
                    </div>
                    @include('admin.common.input_error', ['errors' => $errors, 'target' => 'memberId'])
                    @include('admin.common.business_error', ['errors' => $errors, 'target' => 'not_found_target_member'])
                    <template v-if="component.selectedData.id">
                        {{Form::hidden('memberId', null, ["v-bind:value"=>"component.selectedData.id"])}}
                        <div class="text-muted">
                            ID：@{{component.selectedData.id}}
                        </div>
                        <div class="text-muted">
                            会員名：@{{component.selectedData.name}}
                        </div>
                        <div class="text-muted">
                            連絡先電話番号：@{{component.selectedData.phoneNumber}}
                        </div>
                        <div class="text-muted">
                            メールアドレス：@{{component.selectedData.mailAddress}}
                        </div>
                    </template>
                </template>
            </data-list-select>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            予約日時
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-6 col-xl-4 date-calendar-wrap {{!empty($errors->has('appointmentDate')) ? 'invalid-form' : ''}}">
                    {{Form::text('appointmentDate',$data->get("appointmentDate"),["id" => "appointmentDate","class"=>"form-control invalid-control js-datepicker border-right-0","placeholder"=>"2019/12/09"])}}
                    <div class="input-group-append invalid-control">
                        <button type="button" class="btn js-datepicker-focus">
                            <i aria-hidden="true" class="iconfont iconfont-calendar"></i>
                        </button>
                    </div>
                </div>
                <div class="input-group col-sm-6 col-xl-4 mt-2 mt-sm-0 date-calendar-wrap {{!empty($errors->has('appointmentTime')) ? 'invalid-form' : ''}}">
                    {{Form::text('appointmentTime',$data->get("appointmentTime"),["id" => "appointmentTime","class"=>"form-control invalid-control js-timepicker border-right-0","placeholder"=>"11:00"])}}
                    <div class="input-group-append invalid-control">
                        <button type="button" class="btn js-timepicker-focus">
                            <i aria-hidden="true" class="iconfont iconfont-time"></i>
                        </button>
                    </div>
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'appointmentDate'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'appointmentTime'])
        </td>
    </tr>
    <tr>
        <th>
            内容
        </th>
        <td>
            <div class="{{!empty($errors->has('content')) ? 'invalid-form' : ''}}">
                {{Form::textarea('content', $data->get("content"), ["class" => "form-control invalid-control", "maxlength" => 400])}}
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'content'])
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