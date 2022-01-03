<template>
</template>
<script>
    export default {
        props: {
            interval: {
                type: Number,
                default: 1000
            }
        },
        created: function () {
            dispatcher.$on(dispatcher.EVENT.JOB_CHECK_START, this.start);
        },
        methods: {
            start: function (url) {
                var jobShowUrl = url;
                var requesting = false;
                var jobCheckInterval = setInterval(function () {
                    if (!requesting) {
                        requesting = true;
                        axios.get(jobShowUrl).then(function (response) {
                            if (response.data.status === 1 || response.data.status === 2) {
                                requesting = false;
                            } else if (response.data.status === 3) {
                                clearInterval(jobCheckInterval);
                                dispatcher.$emit(dispatcher.EVENT.JOB_CHECK_ERROR, response.data.outputValue);
                            } else if (response.data.status === 4) {
                                clearInterval(jobCheckInterval);
                                dispatcher.$emit(dispatcher.EVENT.JOB_CHECK_SUCCESS, response.data.outputValue);
                            } else if (response.data.status === 5) {
                                clearInterval(jobCheckInterval);
                                dispatcher.$emit(dispatcher.EVENT.JOB_CHECK_FAILED, response.data.outputValue);
                            }
                        }).catch(function (error) {
                            clearInterval(jobCheckInterval);
                            dispatcher.$emit(dispatcher.EVENT.HANDLE_EXCEPTION, error.response.status, error.response.data.errors);
                        });
                    }
                }, this.interval);
            }
        }
    }
</script>