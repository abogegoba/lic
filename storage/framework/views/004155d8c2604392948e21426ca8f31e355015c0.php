<?php $__env->startSection('description','新卒、第二新卒向けの就活・インターンサイト【LinkT(リンクト)】の学生向け会員登録フォームです。最初に国籍を選択し、流れに沿って氏名や大学名など基本情報の入力を行えば仮登録が完了します。その後、登録したメールアドレスに送られてくるURLをタップすれば本登録が完了します。'); ?>

<?php $__env->startSection('title','国籍選択│会員登録｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .main__content__headline,.term__content {text-align: center;}
        .term__content a {background: #0080CC;color: #fff;padding: 11px 120px;border-radius: 5px;font-size: 30px;}
        .term__content a:hover {opacity: 1}
        .student_type {margin-bottom: 120px !important;}
        .student_type>li {margin: auto;width: 360px;height: 60px;position: relative;margin-bottom: 15px;}
        .student_type>li>label,.student_type>li>input {display: block;position: absolute;left: 0;right: 0;}
        .student_type>li>input[type="radio"] {opacity: 0.01;z-index: 100;}
        .student_type>li>input[type="radio"]:checked+label,.Checked+label {background: #0080CC;}
        .student_type>li>label {padding: 15px 5px;background: #BCBCBC;cursor: pointer;z-index: 90;color: #fff;
            text-align: center;font-size: 30px;border-radius: 5px;}
        input[type='radio'] + label::before,input[type='radio']:checked + label::after {content: none;}
        .content__term li {line-height: unset;}
        @media  only screen and (min-width: 320px) and (max-width: 480px)  {
            .main__content {margin-top: 60px;}
            .student_type {margin-bottom: 60px;}
            .student_type>li {width: 200px;height: 40px;}
            .student_type>li>label {padding: 10px 5px;font-size: 20px;}
            .term__content a {padding: 7px 60px;font-size: 20px;}
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){
            $(".student").click(function(){
                var input_value = $(this).val();
                var url = '';
                if(input_value == 1){
                    url = "<?php echo e(route('front.member-entry.one')); ?>";
                }else if(input_value == 2){
                    url = "<?php echo e(route('front.overseas-member-entry.one')); ?>";
                }
                $('#transfared_url').attr('href', url);
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li>国籍選択</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main__content content__term">
        <h2 class="main__content__headline">国籍を選択してください。</h2>
        <div class="term__content">
            <ul class="student_type">
                <li>
                    <input type="radio" class="student" id="japan_student" name="student_type" value="1" />
                    <label for="japan_student">日本国籍</label>
                </li>
                <li>
                    <input type="radio" class="student" id="overseas_student" name="student_type" value="2" />
                    <label for="overseas_student">外国籍</label>
                </li>
            </ul>
            <a id="transfared_url" href="">次に進む</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>