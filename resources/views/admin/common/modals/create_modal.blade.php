<!-- 登録確認 -->
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="modal-title">
                    ご入力の内容にて登録します。 <br>
                    よろしいですか?
                </p>
                <p>
                    再度確認の上、登録する場合は<br>
                    下記のキャンセルするボタンをクリックしてください。
                </p>
            </div>
            <div class="modal-footer">
                <div class="btn-row btn-row-sm">
                    <div class="btn-col">
                        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times-circle icon icon-lg"></i>
                            <span>キャンセルする</span>
                        </button>
                    </div>
                    <div class="btn-col">
                        <button type="button" class="btn btn-primary btn-lg js-btn-submit" @if(isset($submitWithDismiss) && $submitWithDismiss === true) data-dismiss="modal" @endif>
                            <i class="fas fa-plus-circle icon icon-lg"></i>
                            <span>登録する</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>