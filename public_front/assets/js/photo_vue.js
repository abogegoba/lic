const app = new Vue({
    el: '#app',
    data: {
        photo: {},
        errors: [],
        idPhoto: {},
        idPhotoErrors: [],
        privatePhoto: {},
        privatePhotoErrors: [],
    },
    created: function () {
        this.idPhoto = $('#js-id-photo').data('data') || {};
        this.privatePhoto = $('#js-private-photo').data('data') || {};
    },
    methods: {
        uploadIdPhoto: function (e) {
            let vm = this;
            this.upload(e, function (response) {
                vm.idPhoto = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                vm.idPhotoErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
            $('#js-id-photo').val("");
        },
        deletePhoto: function (e) {
            let vm = this;
            vm.idPhoto = {};
            vm.idPhotoErrors = [];
        },
        uploadPrivatePhoto: function (e) {
            let vm = this;
            this.upload(e, function (response) {
                vm.privatePhoto = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                vm.privatePhotoErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
            $('#js-private-photo').val("");
        },
        deletePrivatePhoto: function (e) {
            let vm = this;
            vm.privatePhoto = {};
            vm.privatePhotoErrors = [];
        },
        upload: function (e, success, error) {
            const files = e.target.files || e.dataTransfer.files;
            let vm = this;
            let formData = new FormData();
            formData.append('photo', files[0]);
            vm.photo = {};
            vm.errors = [];
            dispatcher.$emit(dispatcher.EVENT.SHOW_INDICATOR, "アップロード中...", true);
            axios.post($('#photo').data("upload-url"), formData, {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }).then(success).catch(error);
        }
    }
});
