<strong>基本情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    @if($viewType === 'edit')
        <tr>
            <th>
                ID
            </th>
            <td>
                {{$data->get('jobApplication.id')}}
            </td>
        </tr>
    @endif
    <tr>
        <th class="required-icon">
            対象企業
        </th>
        <td>
            <div class="input-group {{!empty($errors->has('companyName')) || !empty($errors->has('selectedCompanyId')) ? 'invalid-form' : ''}}">
                {{Form::text('companyName', '', ['list' => 'companyList', 'autocomplete' => 'off', 'class' => 'form-control col-md-4 invalid-control js-company',
                'placeholder' => '会社名、かなを入力して選択', 'maxlength' => '255'])}}
                <datalist id="companyList">
                    @foreach($data->get('companyList') as $key => $companyData)
                        <option class="test" name="{{$companyData['name']}}" id="{{$key}}" value="{{$companyData['name']}}">{{$companyData['nameKana']}}</option>
                    @endforeach
                </datalist>
                <input name="selectedCompanyId" type="hidden" class="js-selected-company-id" value="">
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'companyName'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'selectedCompanyId'])
            @include('admin.common.business_error', ['errors' => $errors, 'target' => 'not_found_target_company'])
            <div id="js-company-id" class="text-muted display-company-data"></div>
            <div id="js-company-name" class="text-muted display-company-data"></div>
            @if($viewType === 'edit')
                <input name="registeredCompanyId" type="hidden" class="js-registered-company-id" value="{{$data->get('company.id')}}">
                <input name="registeredCompanyName" type="hidden" class="js-registered-company-name" value="{{$data->get('company.name')}}">
            @endif
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            タイトル
        </th>
        <td>
            <div class="input-group {{!empty($errors->has('title')) ? 'invalid-form' : ''}}">
                {{Form::text('title', $data->get('jobApplication.title'), ['class' => 'form-control invalid-control',
                'placeholder' => '例）本気で世界進出を目指している方、お待ちしてます。', 'maxlength' => '400'])}}
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'title'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            募集職種
        </th>
        <td>
            <div class="row {{!empty($errors->has('jobType')) ? 'invalid-form' : ''}}">
                <div class="col-xl-4 col-md-6 mb-xl-0 mb-3">
                    @foreach($data->get('firstRowInJobTypeList') as $key => $firstRowInJobTypeLabel)
                        <div class="custom-control custom-radio">
                            {{Form::radio('jobType', $key, ($data->get('jobType') === $key) ? "checked='checked'":"",
                             ["id" => "jobType_$key", 'class' => 'custom-control-input invalid-control'])}}
                            <label for="jobType_{{$key}}" class="custom-control-label">
                                <span>{{$firstRowInJobTypeLabel}}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-xl-4 col-md-6 mb-xl-0 mb-3">
                    @foreach($data->get('secondRowInJobTypeList') as $key => $secondRowInJobTypeLabel)
                        <div class="custom-control custom-radio">
                            {{Form::radio('jobType', $key, ($data->get('jobType') === $key) ? "checked='checked'":"",
                             ["id" => "jobType_$key", 'class' => 'custom-control-input invalid-control'])}}
                            <label for="jobType_{{$key}}" class="custom-control-label">
                                <span>{{$secondRowInJobTypeLabel}}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-xl-4 col-md-6">
                    @foreach($data->get('thirdRowInJobTypeList') as $key => $thirdRowInJobTypeLabel)
                        <div class="custom-control custom-radio">
                            {{Form::radio('jobType', $key, ($data->get('jobType') === $key) ? "checked='checked'":"",
                             ["id" => "jobType_$key", 'class' => 'custom-control-input invalid-control'])}}
                            <label for="jobType_{{$key}}" class="custom-control-label">
                                <span>{{$thirdRowInJobTypeLabel}}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                @include('admin.common.input_error', ['errors' => $errors, 'target' => 'jobType'])
            </div>
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            募集職種説明
        </th>
        <td class="{{!empty($errors->has('recruitmentJobTypeDescription')) ? 'invalid-form' : ''}}">
            {{Form::textarea('recruitmentJobTypeDescription', $data->get('jobApplication.recruitmentJobTypeDescription'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）技術職を担当していただきます。', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentJobTypeDescription'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            仕事内容
        </th>
        <td class="{{!empty($errors->has('jobDescription')) ? 'invalid-form' : ''}}">
            {{Form::textarea('jobDescription', $data->get('jobApplication.jobDescription'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）各種システムのUI・UXデザイン', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'jobDescription'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            雇用形態
        </th>
        <td>
            @foreach($data->get('employmentTypeList') as $key => $employmentTypeLabel)
                <div class="custom-control custom-radio custom-control-inline col-md-3 {{!empty($errors->has('employmentType')) ? 'invalid-form' : ''}}">
                    {{Form::radio('employmentType', $key, ($data->get('jobApplication.employmentType') === $key) ? "checked='checked'":$key === \App\Domain\Entities\JobApplication::EMPLOYMENT_TYPE_REGULAR,
                 ["id" => "employment_$key", 'class' => 'custom-control-input invalid-control'])}}
                    <label for="employment_{{$key}}" class="custom-control-label">{{$employmentTypeLabel}}</label>
                </div>
            @endforeach
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'employmentType'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            求める人物像
        </th>
        <td class="{{!empty($errors->has('statue')) ? 'invalid-form' : ''}}">
            {{Form::textarea('statue', $data->get('jobApplication.statue'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）仕事の場での自己実現を通して人間性を高め、さらに会社を一緒に創っていく意欲のある方と共に働きたいと考えています。', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'statue'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            選考方法
        </th>
        <td class="{{!empty($errors->has('screeningMethod')) ? 'invalid-form' : ''}}">
            {{Form::textarea('screeningMethod', $data->get('jobApplication.screeningMethod'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）Web面接', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'screeningMethod'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            給与
        </th>
        <td class="{{!empty($errors->has('compensation')) ? 'invalid-form' : ''}}">
            {{Form::textarea('compensation', $data->get('jobApplication.compensation'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）2019年3月卒&#13;&#10;月給19万5000円&#13;&#10;※2019年4月見込', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'compensation'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            賞与・昇給・手当
        </th>
        <td class="{{!empty($errors->has('bonus')) ? 'invalid-form' : ''}}">
            {{Form::textarea('bonus', $data->get('jobApplication.bonus'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）昇給年1回（4月）&#13;&#10;賞与年2回（7月、12月）&#13;&#10;住宅手当、家族手当、時間外手当、通勤手当', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'bonus'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            勤務地
        </th>
        <td>
            <div class="row">
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area1')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area1',  $data->get('prefectureList'), $data->get('area1'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area2')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area2',  $data->get('prefectureList'), $data->get('area2'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area3')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area3',  $data->get('prefectureList'), $data->get('area3'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area4')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area4',  $data->get('prefectureList'), $data->get('area4'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area5')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area5',  $data->get('prefectureList'), $data->get('area5'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area6')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area6',  $data->get('prefectureList'), $data->get('area6'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area7')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area7',  $data->get('prefectureList'), $data->get('area7'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area8')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area8',  $data->get('prefectureList'), $data->get('area8'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area9')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area9',  $data->get('prefectureList'), $data->get('area9'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
                <div class="input-group col-sm-5 col-xl-3 {{!empty($errors->has('area10')) ? 'invalid-form' : ''}}" style="margin-bottom: 1em;">
                    {{Form::select('area10',  $data->get('prefectureList'), $data->get('area10'), ['class' => 'form-control invalid-control', 'placeholder' => '選択してください'])}}
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area1'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area2'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area3'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area4'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area5'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area6'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area7'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area8'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area9'])
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'area10'])
            @include('admin.common.business_error', ['errors' => $errors, 'target' => 'duplication.recruitment_work_location'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            勤務時間
        </th>
        <td class="{{!empty($errors->has('dutyHours')) ? 'invalid-form' : ''}}">
            {{Form::textarea('dutyHours', $data->get('jobApplication.dutyHours'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）9:00～17:45（実働7時間45分）&#13;&#10;始業時刻は、営業所により異なります。', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'dutyHours'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            待遇・福利厚生
        </th>
        <td class="{{!empty($errors->has('compensationPackage')) ? 'invalid-form' : ''}}">
            {{Form::textarea('compensationPackage', $data->get('jobApplication.compensationPackage'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）労働組合あり、退職金制度あり、確定拠出年金制度あり', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'compensationPackage'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            休日・休暇
        </th>
        <td class="{{!empty($errors->has('nonWorkDay')) ? 'invalid-form' : ''}}">
            {{Form::textarea('nonWorkDay', $data->get('jobApplication.nonWorkDay'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）週休2日制、年間休日数120日、有給休暇、夏季休暇（3日）、リフレッシュ休暇（5日）、年末年始休暇', 'maxlength' => '400'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'nonWorkDay'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            採用予定数
        </th>
        <td>
            <div class="input-group {{!empty($errors->has('recruitmentNumber')) ? 'invalid-form' : ''}}">
                {{Form::text('recruitmentNumber', $data->get('jobApplication.recruitmentNumber'), ['class' => 'form-control col-md-3 invalid-control',
                'placeholder' => '例）5', 'maxlength' => 4])}}
                <div class="input-group-append">
                    <div class="input-group-text input-group-transparent pr-0">名</div>
                </div>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'recruitmentNumber'])
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
        <td class="{{!empty($errors->has('managementMemo')) ? 'invalid-form' : ''}}">
            {{Form::textarea('managementMemo', $data->get('jobApplication.managementMemo'), ['rows' => '3', 'class' => 'form-control invalid-control',
            'placeholder' => '例）2019/10/21採用担当の鈴木さまから内定のため掲載終了の連絡あり。ステータスを非表示にしました。', 'maxlength' => '4000'])}}
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'managementMemo'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            ステータス
        </th>
        <td>
            @foreach($data->get('statusDisplayList') as $key => $statusDisplayLabel)
                <div class="custom-control custom-radio custom-control-inline col-md-3 {{!empty($errors->has('status')) ? 'invalid-form' : ''}}">
                    {{Form::radio('status', $key, ($data->get('jobApplication.status') === $key) ? "checked='checked'":$key === \App\Domain\Entities\JobApplication::STATUS_DISPLAY,
                 ["id" => "status_$key", 'class' => 'custom-control-input invalid-control'])}}
                    <label for="status_{{$key}}" class="custom-control-label">{{$statusDisplayLabel}}</label>
                </div>
            @endforeach
            <div>
                <small class="text-muted">
                    ※求人ステータスは学生掲載版からも変更可能です。求人を制限する際は企業の求人枠で調整してください。
                </small>
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'status'])
        </td>
    </tr>
    </tbody>
</table>