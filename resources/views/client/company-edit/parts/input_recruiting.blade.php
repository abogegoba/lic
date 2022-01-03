<table class="form__table">
    <tr class="invalid-form">
        <th class="required"><label for="title">求人タイトル</label></th>
        <td>
            {{Form::text('title', $data->get("title"), ["class" => (!empty($errors->has('title')) ? "invalid-control width100" : "width100"), "id"=>"title", "placeholder" => "例）本気で世界進出を目指している方、お待ちしてます。","maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['title']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="jobType">募集職種</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('jobType', $data->get('jobTypeList'),  $data->get("jobType"), ["class" => (!empty($errors->has('jobType')) ? "invalid-control" : ""), "id"=>"jobType", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['jobType']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="recruitmentJobTypeDescription">募集職種説明</label></th>
        <td>
            {{Form::textarea('recruitmentJobTypeDescription', $data->get("recruitmentJobTypeDescription"), ["class" => (!empty($errors->has('recruitmentJobTypeDescription')) ? "invalid-control width100" : "width100"), "id"=>"recruitmentJobTypeDescription","placeholder" => "例）営業職を担当していただきます。","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['recruitmentJobTypeDescription']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="jobDescription">仕事内容</label></th>
        <td>
            {{Form::textarea('jobDescription', $data->get("jobDescription"), ["class" => (!empty($errors->has('jobDescription')) ? "invalid-control width100" : "width100"), "id"=>"jobDescription","placeholder" => "例）人材プラットフォームを通じた新しいビジネスの創造","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['jobDescription']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="employmentType">雇用形態</label></th>
        <td>
            <div class="flex">
                {{Form::radio('employmentType', 10, (empty($data->get("employmentType"))|| $data->get("employmentType") === 10)? "checked='checked'":'', ["class" => (!empty($errors->has('employmentType')) ? "invalid-control" : ""), "id"=>"fullTime"])}}
                <label for="fullTime">正社員</label>
                {{Form::radio('employmentType', 20,($data->get("employmentType") === 20)? "checked='checked'":'', ["class" => (!empty($errors->has('employmentType')) ? "invalid-control" : ""), "id"=>"contractEmployee"])}}
                <label for="contractEmployee">契約社員</label>
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['employmentType']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="statue">求める人物像</label></th>
        <td>
            {{Form::textarea('statue', $data->get("statue"), ["class" => (!empty($errors->has('statue')) ? "invalid-control width100" : "width100"), "id"=>"statue","placeholder" => "例）プレッシャーを背負って戦える方","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['statue']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="screeningMethod">選考方法</label></th>
        <td>
            {{Form::textarea('screeningMethod', $data->get("screeningMethod"), ["class" => (!empty($errors->has('screeningMethod')) ? "invalid-control width100" : "width100"), "id"=>"screeningMethod","placeholder" => "例）1次面接～LinkTによるオンライン面接、2次面接～実際にお会いして面接","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['screeningMethod']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="compensation">給与</label></th>
        <td>
            {{Form::textarea('compensation', $data->get("compensation"), ["class" => (!empty($errors->has('compensation')) ? "invalid-control width100" : "width100"), "id"=>"compensation","placeholder" => "例）基本給400,000円","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['compensation']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="bonus">賞与／昇給／手当</label></th>
        <td>
            {{Form::textarea('bonus', $data->get("bonus"), ["class" => (!empty($errors->has('bonus')) ? "invalid-control width100" : "width100"), "id"=>"bonus","placeholder" => "例）年に一度昇給あり、年に二度賞与あり（6月・11月）","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['bonus']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="area1">勤務地（1）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area1', $data->get('prefectureList'),  $data->get("area1"), ["class" => (!empty($errors->has('area1')) ? "invalid-control" : ""), "id"=>"area1", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area1']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area2">勤務地（2）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area2', $data->get('prefectureList'),  $data->get("area2"), ["class" => (!empty($errors->has('area2')) ? "invalid-control" : ""), "id"=>"area2", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area2']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area3">勤務地（3）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area3', $data->get('prefectureList'),  $data->get("area3"), ["class" => (!empty($errors->has('area3')) ? "invalid-control" : ""), "id"=>"area3", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area3']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area4">勤務地（4）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area4', $data->get('prefectureList'),  $data->get("area4"), ["class" => (!empty($errors->has('area4')) ? "invalid-control" : ""), "id"=>"area4", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area4']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area5">勤務地（5）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area5', $data->get('prefectureList'),  $data->get("area5"), ["class" => (!empty($errors->has('area5')) ? "invalid-control" : ""), "id"=>"area5", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area5']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area6">勤務地（6）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area6', $data->get('prefectureList'),  $data->get("area6"), ["class" => (!empty($errors->has('area6')) ? "invalid-control" : ""), "id"=>"area6", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area6']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area7">勤務地（7）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area7', $data->get('prefectureList'),  $data->get("area7"), ["class" => (!empty($errors->has('area7')) ? "invalid-control" : ""), "id"=>"area7", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area7']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area8">勤務地（8）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area8', $data->get('prefectureList'),  $data->get("area8"), ["class" => (!empty($errors->has('area8')) ? "invalid-control" : ""), "id"=>"area8", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area8']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area9">勤務地（9）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area9', $data->get('prefectureList'),  $data->get("area9"), ["class" => (!empty($errors->has('area9')) ? "invalid-control" : ""), "id"=>"area9", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area9']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th><label for="area10">勤務地（10）</label></th>
        <td>
            <div class="selectBox__wrapper width100">
                {{Form::select('area10', $data->get('prefectureList'),  $data->get("area10"), ["class" => (!empty($errors->has('area10')) ? "invalid-control" : ""), "id"=>"area10", "placeholder" => "選択してください",])}}
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['area10']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="dutyHours">勤務時間</label></th>
        <td>
            {{Form::textarea('dutyHours', $data->get("dutyHours"), ["class" => (!empty($errors->has('dutyHours')) ? "invalid-control width100" : "width100"), "id"=>"dutyHours","placeholder" => "例）10:00～18:00","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['dutyHours']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="compensationPackage">待遇／福利厚生</label></th>
        <td>
            {{Form::textarea('compensationPackage', $data->get("compensationPackage"), ["class" => (!empty($errors->has('compensationPackage')) ? "invalid-control width100" : "width100"), "placeholder" => "例）育休・産休制度","id"=>"compensationPackage","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['compensationPackage']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="nonWorkDay">休日・休暇</label></th>
        <td>
            {{Form::textarea('nonWorkDay', $data->get("nonWorkDay"), ["class" => (!empty($errors->has('nonWorkDay')) ? "invalid-control width100" : "width100"), "id"=>"nonWorkDay","placeholder" => "例）暦通り","rows"=>"4", "maxlength" => 400])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['nonWorkDay']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="recruitmentNumber">採用予定人数</label></th>
        <td>
            {{Form::number('recruitmentNumber', $data->get("recruitmentNumber"), ["class" => (!empty($errors->has('recruitmentNumber')) ? "invalid-control width100" : "width100"), "id"=>"recruitmentNumber", "placeholder" => "例）3","maxlength" => 4, "min" => 0])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['recruitmentNumber']])
        </td>
    </tr>
    <tr class="invalid-form">
        <th class="required"><label for="status">ステータス</label></th>
        <td>
            <div class="flex">
                {{Form::radio('status', \App\Domain\Entities\JobApplication::STATUS_DISPLAY, (empty($data->get("status"))|| $data->get("status") === \App\Domain\Entities\JobApplication::STATUS_DISPLAY)? "checked='checked'":'', ["class" => (!empty($errors->has('status')) ? "invalid-control" : ""), "id"=>"visible"])}}
                <label for="visible">表示</label>
                {{Form::radio('status', \App\Domain\Entities\JobApplication::STATUS_HIDE_DISPLAY,($data->get("status") === \App\Domain\Entities\JobApplication::STATUS_HIDE_DISPLAY)? "checked='checked'":'', ["class" => (!empty($errors->has('status')) ? "invalid-control" : ""), "id"=>"hidden"])}}
                <label for="hidden">非表示</label>
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['status']])
        </td>
    </tr>
</table>
