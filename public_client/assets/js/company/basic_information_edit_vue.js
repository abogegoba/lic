const app = new Vue({
    el: '#app',
    data: {
        prVideo: {},
        video5s: {},
        video5sThumb: {},
        video10s: {},
        video10sThumb: {},
        video15s: {},
        video15sThumb: {},
        logo: {},
        logoErrors: [],
        companyImageErrors: [],
        prVideoErrors: [],
        video5sErrors: [],
        video5sThumbErrors: [],
        video10sErrors: [],
        video10sThumbErrors: [],
        video15sErrors: [],
        video15sThumbErrors: [],
        featureErrors: [],
    },
    created: function () {
        this.logo = $('#logo').data('data');
        this.prVideo = $('#prVideo').data('data');
        this.video5s = $('#video5s').data('data');
        this.video5sThumb = $('#video5sThumb').data('data');
        this.video10s = $('#video10s').data('data');
        this.video10sThumb = $('#video10sThumb').data('data');
        this.video15s = $('#video15s').data('data');
        this.video15sThumb = $('#video15sThumb').data('data');
    },
    methods: {
        // 企業ロゴをアップロード
        changeLogo: function (e) {
            let vm = this;
            vm.logoErrors = [];
            this.uploadImage(e, function (response) {
                $('#logo').val("");
                vm.logo = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#logo').val("");
                vm.logoErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        // 企業ロゴを削除
        deleteLogo: function (e) {
            let vm = this;
            vm.logo = {};
            vm.logoErrors = [];
        },

        // 企業画像をアップロード
        changeCompanyImage: function (e) {
            let vm = this;
            let id = e.target.id;
            let index = id.replace("js-companyImage_", "");
            vm.companyImageErrors = [];
            this.uploadImage(e, function (response) {
                $('#'+id).val("");
                app.$refs.companyImage.dataObjects[index] = response.data;
                if (Object.keys(app.$refs.companyImage.dataObjects).length === 1) {
                    app.$refs.companyImage.dataObjects[index].checked = true;
                }
                app.$refs.companyImage.$forceUpdate();
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#'+id).val("");
                vm.companyImageErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },

        // PRビデオをアップロード
        uploadPrVideo: function (e) {
            let vm = this;
            vm.prVideoErrors = [];
            this.uploadVideo(e, function (response) {
                $('#prVideo').val("");
                vm.prVideo = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#prVideo').val("");
                vm.prVideoErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        // PRビデオを削除
        deletePrVideo: function (e) {
            let vm = this;
            vm.prVideo = {};
            vm.prVideoErrors = [];
        },

        // 5秒ビデオをアップロード
        uploadVideo5s: function (e) {
            let vm = this;
            vm.video5sErrors = [];
            this.uploadVideo(e, function (response) {
                $('#video5s').val("");
                vm.video5s = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#video5s').val("");
                vm.video5sErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        // 5秒ビデオを削除
        deleteVideo5s: function (e) {
            let vm = this;
            vm.video5s = {};
            vm.video5sErrors = [];
        },
        // 5秒動画サムネイルをアップロード
        changeVideo5sThumb: function (e) {
            let vm = this;
            vm.video5sThumbErrors = [];
            this.uploadImage(e, function (response) {
                $('#video5sThumb').val("");
                vm.video5sThumb = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#video5sThumb').val("");
                vm.video5sThumbErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
       },
        // 5秒動画サムネイルを削除
        deleteVideo5sThumb: function (e) {
            let vm = this;
            vm.video5sThumb = {};
            vm.video5sThumbErrors = [];
         },

        // 10秒ビデオをアップロード
        uploadVideo10s: function (e) {
            let vm = this;
            vm.video10sErrors = [];
            this.uploadVideo(e, function (response) {
                $('#video10s').val("");
                vm.video10s = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#video10s').val("");
                vm.video10sErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        // 10秒ビデオを削除
        deleteVideo10s: function (e) {
            let vm = this;
            vm.video10s = {};
            vm.video10sErrors = [];
        },
        // 10秒動画サムネイルをアップロード
        changeVideo10sThumb: function (e) {
            let vm = this;
            vm.video10sThumbErrors = [];
            this.uploadImage(e, function (response) {
                $('#video10sThumb').val("");
                vm.video10sThumb = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#video10sThumb').val("");
                vm.video10sThumbErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        // 10秒動画サムネイルを削除
        deleteVideo10sThumb: function (e) {
            let vm = this;
            vm.video10sThumb = {};
            vm.video10sThumbErrors = [];
        },

        // 15秒ビデオをアップロード
        uploadVideo15s: function (e) {
            let vm = this;
            vm.video15sErrors = [];
            this.uploadVideo(e, function (response) {
                $('#video15s').val("");
                vm.video15s = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#video15s').val("");
                vm.video15sErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        // 15秒ビデオを削除
        deleteVideo15s: function (e) {
            let vm = this;
            vm.video15s = {};
            vm.video15sErrors = [];
        },
        // 15秒動画サムネイルをアップロード
        changeVideo15sThumb: function (e) {
            let vm = this;
            vm.video15sThumbErrors = [];
            this.uploadImage(e, function (response) {
                $('#video15sThumb').val("");
                vm.video15sThumb = response.data;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#video15sThumb').val("");
                vm.video15sThumbErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        // 15秒動画サムネイルを削除
        deleteVideo15sThumb: function (e) {
            let vm = this;
            vm.video15sThumb = {};
            vm.video15sThumbErrors = [];
        },

        // 当社の特徴 動画をアップロード
        uploadFeatureVideo: function (e) {
            let vm = this;
            let id = e.target.id;
            let index = id.replace("js-feature-video_", "");
            vm.featureErrors = [];
            this.uploadVideo(e, function (response) {
                $('#'+id).val("");
                app.$refs.feature.dataObjects[index].name = response.data.name;
                app.$refs.feature.dataObjects[index].url = response.data.url;
                app.$refs.feature.dataObjects[index].path = response.data.path;
                app.$refs.feature.dataObjects[index].type = 20;
                app.$refs.feature.$forceUpdate();
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#'+id).val("");
                vm.featureErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },

        // 当社の特徴 画像をアップロード
        uploadFeatureImage: function (e) {
            let vm = this;
            let id = e.target.id;
            let index = id.replace("js-feature-image_", "");
            vm.featureErrors = [];
            this.uploadImage(e, function (response) {
                $('#'+id).val("");
                app.$refs.feature.dataObjects[index].name = response.data.name;
                app.$refs.feature.dataObjects[index].url = response.data.url;
                app.$refs.feature.dataObjects[index].path = response.data.path;
                app.$refs.feature.dataObjects[index].type = 10;
                app.$refs.feature.$forceUpdate();
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            }, function (error) {
                $('#'+id).val("");
                vm.featureErrors = error.response.data.errors;
                dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
            });
        },
        setFeatureTitle: function (e) {
            let vm = this;
            let id = e.target.id;
            let index = id.replace("feature-title_", "");
            app.$refs.feature.dataObjects[index].title = e.target.value;
        },
        setFeatureDescription: function (e) {
            let vm = this;
            let id = e.target.id;
            let index = id.replace("feature-description_", "");
            app.$refs.feature.dataObjects[index].description = e.target.value;
        },

        uploadImage: function (e, success, error) {
            this.upload('uploadImage', e, success, error);
        },

        uploadVideo: function (e, success, error) {
            this.upload('uploadVideo', e, success, error);
        },

        upload: function(type, e, success, error) {
            const files = e.target.files || e.dataTransfer.files;
            let vm = this;
            let formData = new FormData();
            if (type === 'uploadImage'){
                formData.append('uploadImage', files[0]);
            } else if (type === 'uploadVideo') {
                formData.append('uploadVideo', files[0]);
            }
            vm.errors = [];
            dispatcher.$emit(dispatcher.EVENT.SHOW_INDICATOR, "アップロード中...", true);
            axios.post($('#edit-client').data("upload-url"), formData, {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }).then(success).catch(error);
        }
    }
});
