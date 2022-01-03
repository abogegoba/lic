<template>
</template>
<script>
    export default {
        created: function () {
            dispatcher.$on(dispatcher.EVENT.HANDLE_EXCEPTION, this.handle);
        },
        methods: {
            handle: function (status, errors) {
                if (status == '403') {
                    Object.entries(errors.exception.messages).forEach(([key, value]) => {
                        location.href = "/403/" + key;
                    });
                } else if (status == '404') {
                    location.href = "/404";
                } else if (status == '500') {
                    location.href = "/500";
                }
            }
        }
    }
</script>