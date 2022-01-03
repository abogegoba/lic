<header class="row">
    <div class="col-12 main-header">
        <nav class="navbar navbar-expand-lg">
            <?php if(!empty($adminAuthentication)): ?>
                <a href="<?php echo e(route('admin.company.list')); ?>" class="navbar-brand text-center mx-auto ml-sm-0">
                    <img src="<?php echo e(asset('img/common/logo_header.png')); ?>" alt="LinkT">
                    <span class="font-weight-bold align-middle d-inline-block">管理システム</span>
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('admin.top')); ?>" class="navbar-brand text-center mx-auto ml-sm-0">
                    <img src="<?php echo e(asset('img/common/logo_header.png')); ?>" alt="LinkT">
                    <span class="font-weight-bold align-middle d-inline-block">管理システム</span>
                </a>
            <?php endif; ?>

            <div class="navbar-text mx-auto mr-sm-0">
                <button type="button" class="nav-link dropdown-toggle btn-transparent" id="navbarDropdownMenuLink-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <i class="fas fa-user mr-2 align-middle icon"></i>
                    <span class="font-weight-bold">
                        <span class="mr-2"><?php echo e($adminAuthentication->get("lastName")); ?>　<?php echo e($adminAuthentication->get("firstName")); ?></span>様
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdownMenuLink-user">
                    <div class="dropdown-item-text">
                        <span class="mr-2"><?php echo e($adminAuthentication->get("lastName")); ?>　<?php echo e($adminAuthentication->get("firstName")); ?></span>様
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="px-3 py-1">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-logout">
                            <i class="fas fa-sign-out-alt fa-fw icon"></i>
                            <span>ログアウト</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
    <?php echo $__env->make('admin.common.modals.logout_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</header>
