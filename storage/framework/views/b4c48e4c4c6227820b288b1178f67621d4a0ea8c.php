<?php $__env->startSection('title','会員登録'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/cropper.min.css')); ?>">
    <style>
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/datetime-picker.js')); ?>"></script>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
    <script>
        $(function () {
            $('.js-zip').on('click', function () {
                AjaxZip3.zip2addr('zipCode', '', 'prefecture', 'city');
                return false;
            });
        });
    </script>
    <script src="<?php echo e(asset('js/cropper.min.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            $("#js-private-photo").change(function() {
                var p_id = 'privatePhotoName';
                $('#cropImage').attr("pic_type","privatePhotoName");
                readURL(this,p_id);
            });

            $("#js-id-photo").change(function() {
                var p_id = 'idPhotoName';
                $('#cropImage').attr("pic_type","idPhotoName");
                readURL(this,p_id);
            });

        });

        function readURL(input,p_id) {
            if (input.files && input.files[0]) {
                $('#'+p_id).val(input.files[0].name);

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);

                $('#imgModal').modal('show');
                // 参考: https://qiita.com/_Keitaro_/items/57b1c5dd36b7bed08ad8
                $(input).val('');
            }
        }

        function getRoundedCanvas(sourceCanvas) {
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');
            var width = sourceCanvas.width;
            var height = sourceCanvas.height;

            canvas.width = width;
            canvas.height = height;
            context.imageSmoothingEnabled = true;
            context.drawImage(sourceCanvas, 0, 0, width, height);
            context.globalCompositeOperation = 'destination-in';
            context.beginPath();
            context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
            context.fill();
            return canvas;
        }

        window.addEventListener('DOMContentLoaded', function () {
            var image = document.getElementById('blah');
            var button = document.getElementById('cropImage');
            var croppable = false;
            var cropBoxData;
            var canvasData;
            var cropper;

            $('#imgModal').on('shown.bs.modal', function () {
                var uploadImageType = button.getAttribute('pic_type');

                cropper = new Cropper(image, {
                    autoCropArea: 1,
                    aspectRatio: 1,
                    viewMode: 1,
                    ready: function () {
                        //Should set crop box data first here
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                        croppable = true;
                    }
                });

                button.onclick = function () {
                    var croppedCanvas;
                    var roundedCanvas;
                    var croppedImg;

                    if (!croppable) {
                        return;
                    }
                    // Crop
                    croppedCanvas = cropper.getCroppedCanvas();
                    // Round
                    roundedCanvas = getRoundedCanvas(croppedCanvas);
                    // Show
                    croppedImg = document.createElement('img');
                    //croppedImg.src = croppedCanvas.toDataURL();
                    croppedImg.src = roundedCanvas.toDataURL();
                    //Usage example:
                    dataURLtoFile(croppedImg,croppedImg.src,uploadImageType);
                };
            }).on('hidden.bs.modal', function () {
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();
                cropper.destroy();
            });
        });

        function dataURLtoFile(croppedImg,dataurl,uploadImageType) {
            var arr = dataurl.split(',');
            var mime = arr[0].match(/:(.*?);/)[1];
            var temp_extention = mime.split('/');
            var file_ext = temp_extention[1];
            var filename = 'cropped_image.'+file_ext;
            if(uploadImageType == 'privatePhotoName'){
                var existingPic = document.getElementById('existingPrivatePhoto');
            }else if(uploadImageType == 'idPhotoName'){
                var existingPic = document.getElementById('existingIdPhoto');
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch(dataurl)
                .then(res => res.blob())
                .then(blob => {
                    const file = new File([blob], filename, {
                        type: 'image/png'
                    });
                    var fd = new FormData();
                    fd.append("uploadImage", file);
                    $("#loader").show();
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: '<?php echo route('admin.upload'); ?>',
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: (data) => {
                            $("#loader").hide();
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                        },
                        complete: function (response) {
                            //result.innerHTML = '';
                            //result.appendChild(croppedImg);
                            //existingPic.style.display = "none";
                            //result.style.display = "block";
                            var json_response = jQuery.parseJSON( response.responseText );
                            var path = json_response.path;
                            var url = json_response.url;
                            if(uploadImageType == 'privatePhotoName'){
                                $('#existingPrivatePhoto img').attr('src',url);
                                $('#privatePhotoPath').val(path);
                            }else if(uploadImageType == 'idPhotoName'){
                                $('#existingIdPhoto img').attr('src',url);
                                $('#idPhotoPath').val(path);
                            }

                        }
                    });
                });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vue'); ?>
    <script src="<?php echo e(asset('js/member/upload_vue.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="content-title" id="upload-content" data-upload-url="<?php echo e(route('admin.upload')); ?>">会員登録</h1>

    <div style="margin-bottom: 2em;">
        <a href="<?php echo e(route('admin.member.reload')); ?>">< 会員一覧に戻る</a>
    </div>

    <?php echo e(Form::open(['url'=>route('admin.member.create')])); ?>


    <?php echo $__env->make('admin.member.parts.input', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="btn-row btn-row" style="margin-bottom: 2em;">
        <div class="btn-col btn-row-sm">
            <button type="button" class="btn btn-secondary btn-lg js-btn-link" data-href="<?php echo e(route("admin.member.reload")); ?>">
                <i class="iconfont iconfont-times-circle icon-lg" aria-hidden="true"></i>
                <span>キャンセルする</span>
            </button>
        </div>
        <div class="btn-col btn-row-sm">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-create">
                <i class="iconfont iconfont-plus-circle icon-lg" aria-hidden="true"></i>
                <span>登録する</span>
            </button>
        </div>
    </div>

    <a href="<?php echo e(route('admin.member.reload')); ?>">< 会員一覧に戻る</a>
    <?php echo e(Form::close()); ?>

    <?php echo $__env->make('admin.common.modals.create_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- Modal -->
    <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="img-container">
                        <img id="blah" src="#" alt="your image" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cropImage" type="button" class="btn btn-info" pic_type="" data-dismiss="modal">トリミング</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>