{{-- @section('script') 内にincludeする --}}
<style>
        *, ::after, ::before {
            box-sizing: unset;
        }
        .button.remove {
            padding: 0.5em 1.2em;
            background: #434343;
            font-size: 100%;
        }

        table.form__table picture + input + label {
            max-width: 150px;
            margin-right: 5%;
        }
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }

</style>
<link rel="stylesheet" href="{{asset('css/mypage/cropper.min.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap_custom.min.css')}}">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/mypage/cropper.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#js-id-photo").change(function() {
            var p_id = 'idPhotoName';
            $('#cropImage').attr("pic_type","idPhoto");
            readURL(this,p_id);
        });

        $("#js-private-photo").change(function() {
            var p_id = 'privatePhotoName';
            $('#cropImage').attr("pic_type","privatePhoto");
            readURL(this,p_id);
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
    });

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
                var uploadImageType = button.getAttribute('pic_type');
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
        // どのファイルでも確実にUploadできるようにするため一時ファイル名をつける
        const tmpFileName = 'cropped_image.'+file_ext;
        let fileName = ''


        if(uploadImageType == 'idPhoto'){
            fileName = $('#idPhotoName').val()
            var existingPic = document.getElementById('existingPic');
        }else{
            fileName = $('#privatePhotoName').val()
            var existingPic = document.getElementById('existingPic2');
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetch(dataurl)
            .then(res => res.blob())
            .then(blob => {
                const file = new File([blob], tmpFileName, {
                    type: 'image/png'
                });
                var fd = new FormData();
                fd.append("photo", file);
                $("#loader").show();
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: '{!! route('front.profile.photo.edit.upload-photo') !!}',
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
                        const json_response = jQuery.parseJSON( response.responseText );
                        const name = json_response.name;
                        const path = json_response.path;
                        const url = json_response.url

                        // 以下、appはVueインスタンスを示す
                        if(uploadImageType == 'idPhoto'){
                            // 本来は上の方にあるreadURLでnameに関しては動的にセットされているのだが、
                            // app.$setでname以外の項目を代入するとvueが変更を検知してDOMに反映し、
                            // nameが初期値に戻る等、想定外の値になることがある。
                            // そのためfileNameに関しても別途保存して再度setしている
                            app.$set(app.idPhoto, 'name', fileName);
                            app.$set(app.idPhoto, 'path', path);
                            app.$set(app.idPhoto, 'url', url);
                        }else{
                            app.$set(app.privatePhoto, 'name', fileName);
                            app.$set(app.privatePhoto, 'path', path);
                            app.$set(app.privatePhoto, 'url', url);
                        }
                    }
                });
            });
    }
</script>

<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="img-container">
                    <img id="blah" src="#" alt="your image" />
                </div>
            </div>
            <div class="modal-footer">
                <button id="cropImage" type="button" class="button" pic_type="" data-dismiss="modal">トリミング</button>
            </div>
        </div>
    </div>
</div>
<div id="loader" style="display: none;">
    <div class="loading-overlay">
        <div class="loading">
            <div class="loading-icon mb-5">
                <img src="{{ asset('img/icon_loading.png') }}" alt="">
            </div>
            <span>アップロード中...</span>
        </div>
    </div>
</div>
