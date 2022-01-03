<?php $__env->startSection('description','次世代型新卒・第二新卒採用サービス【LinkT(リンクト)】の企業向けお問い合わせフォームです。LinkTに関してご不明な点がある場合は、お問い合わせフォームに必要事項を入力して送信ください。'); ?>

<?php $__env->startSection('title','企業向けお問い合わせ｜新卒・第二新卒採用ならLinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/contact/common.css')); ?>">
    <style>
        @media  only screen and (max-width: 413px) and (min-width: 320px){
            input[type='checkbox'] + label::before {width: 30px;}
            input[type='checkbox']:checked + label::after {top: 5px;}
        }
        @media  only screen and (max-width: 639px) and (min-width: 414px){
            input[type='checkbox'] + label::before {width: 24px;}
            input[type='checkbox']:checked + label::after {top: 5px;}
        }
        @media  only screen and (max-width: 767px) and (min-width: 640px){
            input[type='checkbox']:checked + label::after {top: -8px;}
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li>お問合せ入力</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="main__content content__term" id="contact">
        <h2 class="main__content__headline">ご不明点等ございましたら、下記のフォームよりお問合せ下さい。</h2>
        <p>※土日祝日のお問合せへのご回答はお時間がかかる場合がございます。</p>
        <?php echo e(Form::open(['url'=>route('client.contact.to-confirm')])); ?>

            <table class="form__table">
                <tr class="invalid-form">
                    <th class="required">
                        <label for="kind">お問合せ項目</label>
                    </th>
                    <td>
                        <div class="selectBox__wrapper width100">
                            <?php echo e(Form::select('kind', $data->get("kind"),'', ["class" => (!empty($errors->has('kind')) ? "invalid-control" : ""), "id"=>"kind", "placeholder" => "選択してください",])); ?>

                        </div>
                        <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['kind']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="name1">氏名</label></th>
                    <td>
                        <div class="flex--bet">
                            <?php echo e(Form::text('lastName', $data->get("lastName"), ["class" => (!empty($errors->has('lastName')) ? "invalid-control" : ""), "id"=>"name1","placeholder" => "例）陸", "maxlength" =>16])); ?>

                            <?php echo e(Form::text('firstName', $data->get("firstName"), ["class" => (!empty($errors->has('firstName')) ? "invalid-control" : ""),"placeholder" => "例）太郎", "maxlength" =>16])); ?>

                            <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['lastName','firstName']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="kana1">氏名(かな)</label></th>
                    <td>
                        <div class="flex--bet">
                            <?php echo e(Form::text('lastNameKana', $data->get("lastNameKana"), ["class" => (!empty($errors->has('lastNameKana')) ? "invalid-control" : ""), "id"=>"kana1","placeholder" => "例）りく", "maxlength" =>16])); ?>

                            <?php echo e(Form::text('firstNameKana', $data->get("firstNameKana"), ["class" => (!empty($errors->has('firstNameKana')) ? "invalid-control" : ""),"placeholder" => "例）たろう", "maxlength" =>16])); ?>

                            <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['lastNameKana','firstNameKana']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="companyName">会社名</label></th>
                    <td>
                        <?php echo e(Form::text('companyName', $data->get("companyName"), ["class" => (!empty($errors->has('companyName')) ? "invalid-control width100" : "width100"), "id"=>"companyName", "placeholder" => "例）株式会社infit","maxlength" =>56])); ?>

                        <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['companyName']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="departmentName">部署名</label></th>
                    <td>
                        <?php echo e(Form::text('departmentName', $data->get("departmentName"), ["class" => (!empty($errors->has('departmentName')) ? "invalid-control width100" : "width100"), "id"=>"departmentName", "placeholder" => "例）システム開発部","maxlength" =>56])); ?>

                        <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['departmentName']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="tel">電話番号</label></th>
                    <td>
                        <?php echo e(Form::tel('tel', $data->get("tel"), ["class" => (!empty($errors->has('tel')) ? "invalid-control width100" : "width100"), "id"=>"tel", "placeholder" => "例）0364449999","maxlength" =>15])); ?>

                        <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['tel']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="mail">メールアドレス</label></th>
                    <td>
                        <?php echo e(Form::email('mail', $data->get("mail"), ["class" => (!empty($errors->has('mail')) ? "invalid-control width100" : "width100"), "id"=>"mail", "placeholder" => "例）example@linkt.jp","maxlength" =>256])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['mail']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="confirmMail">メールアドレス（確認用）</label></th>
                    <td>
                        <?php echo e(Form::email('confirmMail', $data->get("confirmMail"), ["class" => (!empty($errors->has('confirmMail')) ? "invalid-control width100" : "width100"), "placeholder" => "例）example@linkt.jp","id"=>"confirmMail", "maxlength" =>255])); ?>

                        <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['confirmMail']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for="contact">お問合せ内容</label></th>
                    <td>
                        <?php echo e(Form::textarea('contact', $data->get("contact"), ["class" => (!empty($errors->has('contact')) ? "invalid-control width100" : "width100"), "id"=>"free","cols"=>"40", "rows"=>"10", "placeholder" => "お問合せ内容を具体的にご記載ください。","maxlength" =>400])); ?>

                        <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['contact']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                </tr>
            </table>
        <div class="agreeTerms invalid-form">
            <p>お問合せの際は「ご利用規約」を必ずお読みいただき、<br class="pc">ご利用規約にご同意の上、送信へお進みください。</p>
            <ul>
                <li><a href="/term/">ご利用規約</a></li>
                <li><a href="<?php echo e(route('client.static.personal')); ?>">取り扱いについて</a></li>
            </ul>
            <div class="agreeTerms__consent">
                <?php echo e(Form::checkbox('consent', 1, '', ["id"=>"consent"])); ?><label for="consent">ご利用規約および取り扱いについて同意する</label>
            </div>
            <?php echo $__env->make('client.common.input_error', ['errors' => $errors, 'targets' => ['consent']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
            <div class="form__controls">
                <input type="submit" class="js-btn-confirm" value="確認する">
            </div>
        <?php echo e(Form::close()); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>