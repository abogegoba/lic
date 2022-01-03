<!-- ログアウト -->
<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="modal-logout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <p class="modal-title">
                    ログアウトします。<br>
                    よろしいですか？
                </p>
                <p>
                    ※作業中のデータは全て消去されます。
                </p>
            </div>
            <div class="modal-footer">
                <div class="btn-row btn-row-sm">
                    <div class="btn-col">
                        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times-circle icon icon-lg"></i>
                            <span>キャンセル</span>
                        </button>
                    </div>
                    <div class="btn-col">
                        <button type="button" class="btn btn-lg btn-primary js-btn-link" data-href="{{route("admin.logout")}}">
                            <i class="fas fa-sign-out-alt icon icon-lg"></i>
                            <span>ログアウト</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>