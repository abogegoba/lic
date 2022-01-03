<template>
    <div v-if="this.visible" v-on:click="cancel()">
        <slot name="field" v-bind:label="label"></slot>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                visible: false,
                cancelDisable: false,
                label: "Loading..."
            }
        },
        created: function () {
            dispatcher.$on(dispatcher.EVENT.SHOW_INDICATOR, this.show);
            dispatcher.$on(dispatcher.EVENT.HIDE_INDICATOR, this.hide);
        },
        methods: {
            show: function (label, cancelDisable) {
                if (label) {
                    this.label = label;
                } else {
                    this.label = "Loading...";
                }
                if (cancelDisable === true) {
                    this.cancelDisable = cancelDisable;
                } else {
                    this.cancelDisable = false;
                }
                this.visible = true;
            },
            hide: function () {
                this.visible = false;
            },
            cancel: function () {
                if (!this.cancelDisable) {
                    this.hide();
                    dispatcher.$emit(dispatcher.EVENT.CANCEL_INDICATOR);
                }
            }
        }
    }
</script>
