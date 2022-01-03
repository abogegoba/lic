<template>
    <div class="additional">
        <slot name="field"
              v-bind:data="dataObjects"
              v-bind:addable="addable"
              v-bind:add="add"
              v-bind:remove="remove">
        </slot>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                type: String,
                required: true
            },
            data: {
                type: String,
                required: true
            },
            errors: {
                type: String,
                default: null
            },
            max: {
                type: Number,
                default: 0
            },
            initialAdd: {
                type: Boolean,
                default: false
            }
        },
        mounted: function () {
            this.dataObjects = JSON.parse(this.data);
            if (this.initialAdd !== false && this.dataObjects.length === 0) {
                 this.add();
            }
        },
        data: function () {
            return {
                dataObjects: []
            }
        },
        computed: {
            addable: function () {
                if (this.max == 0) {
                    return true;
                } else if (this.max > 0) {
                    if (this.max > Object.keys(this.dataObjects).length) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        methods: {
            add: function () {
                if (this.max == 0 || (this.max > 0 && this.max > Object.keys(this.dataObjects).length)) {
                    this.dataObjects.push({});
                }
            },
            remove: function (index) {
                this.dataObjects.splice(index, 1);
            }
        }
    }
</script>
