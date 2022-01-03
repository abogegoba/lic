<strong>基本情報</strong>
<table class="table table-form mb-5">
    <colgroup>
        <col class="w-20">
        <col>
    </colgroup>
    <tbody>
    @if(!empty($data->get('modelSentenceId')))
        <tr>
            <th>
                ID
            </th>
            <td>
                {{$data->get('modelSentenceId')}}
            </td>
        </tr>
    @endif
    <tr>
        <th>
            例文種別
        </th>
        <td>
            <div class="{{!empty($errors->has('modelSentenceType')) ? 'invalid-form' : ''}}">
                {{Form::select('modelSentenceType',  $data->get('modelSentenceTypeList'), $data->get('modelSentence.modelSentenceType'), ['class' => 'form-control invalid-control'])}}
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'modelSentenceType'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            例文名
        </th>
        <td>
            <div class="{{!empty($errors->has('name')) ? 'invalid-form' : ''}}">
                {{Form::text('name', $data->get("modelSentence.name"), ["class" => "form-control invalid-control", "placeholder"=>"例）面接希望メッセージ", "maxlength" => 32])}}
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'name'])
        </td>
    </tr>
    <tr>
        <th class="required-icon">
            本文
        </th>
        <td>
            <div class="{{!empty($errors->has('content')) ? 'invalid-form' : ''}}">
                {{Form::textarea('content', $data->get("modelSentence.content"), ["class" => "form-control invalid-control", "placeholder"=>"※ 400文字以内で入してください。", "maxlength" => 400])}}
            </div>
            @include('admin.common.input_error', ['errors' => $errors, 'target' => 'content'])
        </td>
    </tr>
    </tbody>
</table>