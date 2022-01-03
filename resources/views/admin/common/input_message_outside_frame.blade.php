@if (count($errors)>0 && !empty($errors->getBags()) && empty(session('success')))
    <div class="alert alert-danger">
        <i class="fas fa-ban icon"></i>
        入力エラーです。入力し直してください。
    </div>
@endif