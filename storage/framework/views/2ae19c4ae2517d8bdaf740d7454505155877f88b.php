<button type="button" class="d-md-none btn-menu" data-toggle="collapse" data-target="#main-menu"
        aria-controls="main-menu" aria-expanded="false" aria-label="Toggle">
    <span class="icon-menu"></span>
</button>
<aside id="main-menu" class="col-12 col-md-3 col-xl-2 main-menu d-md-block collapse">
    <nav>
        <ul>
            <li>
                <a href="#menu-company" class="menu-item collapsed" data-toggle="collapse" aria-controls="#menu-company" aria-expanded="false">
                    <i class="fas fa-building fa-fw menu-icon"></i>
                    企業管理
                    <i class="fas fa-angle-left menu-icon-accordion"></i>
                </a>
                <ul id="menu-company" class="collapse" data-parent="#main-menu">
                    <li>
                        <a href="<?php echo e(route('admin.company.list')); ?>" class="menu-list">企業一覧</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.company.create')); ?>" class="menu-list">企業登録</a>
                    </li>
                </ul>
                <a href="#menu-member" class="menu-item collapsed" data-toggle="collapse" aria-controls="#menu-member" aria-expanded="false">
                    <i class="fas fa-id-card fa-fw menu-icon"></i>
                    会員管理
                    <i class="fas fa-angle-left menu-icon-accordion"></i>
                </a>
                <ul id="menu-member" class="collapse" data-parent="#main-menu">
                    <li>
                        <a href="<?php echo e(route('admin.member.list')); ?>" class="menu-list">会員一覧</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.member.create')); ?>" class="menu-list">会員登録</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#menu-jobApplication" class="menu-item collapsed" data-toggle="collapse" aria-controls="#menu-jobApplication" aria-expanded="false">
                    <i class="fas fa-user-friends fa-fw menu-icon"></i>
                    求人管理
                    <i class="fas fa-chevron-left menu-icon-accordion"></i>
                </a>
                <ul id="menu-jobApplication" class="collapse" data-parent="#main-menu">
                    <li>
                        <a href="<?php echo e(route('admin.jobApplication.list')); ?>" class="menu-list">求人一覧</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.job-application.create')); ?>" class="menu-list">求人登録</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#menu-interview-appointment" class="menu-item collapsed" data-toggle="collapse" aria-controls="#menu-interview-appointment" aria-expanded="false">
                    <i class="fas fa-calendar-check fa-fw menu-icon"></i>
                    予約管理
                    <i class="fas fa-chevron-left menu-icon-accordion"></i>
                </a>
                <ul id="menu-interview-appointment" class="collapse" data-parent="#main-menu">
                    <li>
                        <a href="<?php echo e(route('admin.interview-appointment.list')); ?>" class="menu-list">予約一覧</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.interview-appointment.create')); ?>" class="menu-list">予約登録</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#menu-video-interview" class="menu-item collapsed" data-toggle="collapse" aria-controls="#menu-video-interview" aria-expanded="false">
                    <i class="fas fa-comment-dots fa-fw menu-icon"></i>
                    ビデオ通話管理
                    <i class="fas fa-chevron-left menu-icon-accordion"></i>
                </a>
                <ul id="menu-video-interview" class="collapse" data-parent="#main-menu">
                    <li>
                        <a href="<?php echo e(route('admin.video-interview.list')); ?>" class="menu-list">ビデオ通話履歴一覧</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#menu-message" class="menu-item collapsed" data-toggle="collapse" aria-controls="#menu-message" aria-expanded="false">
                    <i class="fas fa-comment-dots fa-fw menu-icon"></i>
                    メッセージ管理
                    <i class="fas fa-chevron-left menu-icon-accordion"></i>
                </a>
                <ul id="menu-message" class="collapse" data-parent="#main-menu">
                    <li>
                        <a href="<?php echo e(route('admin.message.list')); ?>" class="menu-list">メッセージ一覧</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#menu-model-sentence" class="menu-item collapsed" data-toggle="collapse" aria-controls="#menu-model-sentence" aria-expanded="false">
                    <i class="fas fa-comment-dots fa-fw menu-icon"></i>
                    例文管理
                    <i class="fas fa-chevron-left menu-icon-accordion"></i>
                </a>
                <ul id="menu-model-sentence" class="collapse" data-parent="#main-menu">
                    <li>
                        <a href="<?php echo e(route('admin.model-sentence.list')); ?>" class="menu-list">例文一覧</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button" class="menu-item collapsed" data-toggle="modal" data-target="#modal-logout">
                    <i class="fas fa-sign-out-alt fa-fw menu-icon"></i>
                    ログアウト
                </button>
            </li>
        </ul>
    </nav>
    
    <?php echo $__env->make('admin.common.modals.logout_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</aside>