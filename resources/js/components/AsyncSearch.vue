<template>
    <div class="async-search">
        <slot name="header-field"
              v-bind:result="result"
              v-bind:status="status"
              v-bind:errors="errors"
              v-bind:hasResults="hasResults"
              v-bind:searched="searched"
              v-bind:currentPageIndex="currentPageIndex"
              v-bind:lastPageIndex="lastPageIndex"
              v-bind:isFirstPage="isFirstPage"
              v-bind:isLastPage="isLastPage"
              v-bind:pageIndexes="pageIndexes"
              v-bind:paging="paging"
              v-bind:next="next"
              v-bind:prev="prev"
              v-bind:search="search">
        </slot>
        <form v-bind:id="id" v-on:submit.prevent="search">
            <slot name="condition-field"
                  v-bind:result="result"
                  v-bind:status="status"
                  v-bind:errors="errors"
                  v-bind:hasResults="hasResults"
                  v-bind:searched="searched"
                  v-bind:currentPageIndex="currentPageIndex"
                  v-bind:lastPageIndex="lastPageIndex"
                  v-bind:isFirstPage="isFirstPage"
                  v-bind:isLastPage="isLastPage"
                  v-bind:pageIndexes="pageIndexes"
                  v-bind:paging="paging"
                  v-bind:next="next"
                  v-bind:prev="prev"
                  v-bind:search="search">
            </slot>
        </form>
        <slot name="middle-field"
              v-bind:result="result"
              v-bind:status="status"
              v-bind:errors="errors"
              v-bind:hasResults="hasResults"
              v-bind:searched="searched"
              v-bind:currentPageIndex="currentPageIndex"
              v-bind:lastPageIndex="lastPageIndex"
              v-bind:isFirstPage="isFirstPage"
              v-bind:isLastPage="isLastPage"
              v-bind:pageIndexes="pageIndexes"
              v-bind:paging="paging"
              v-bind:next="next"
              v-bind:prev="prev"
              v-bind:search="search">
        </slot>
        <slot name="result-field"
              v-bind:result="result"
              v-bind:status="status"
              v-bind:errors="errors"
              v-bind:hasResults="hasResults"
              v-bind:searched="searched"
              v-bind:currentPageIndex="currentPageIndex"
              v-bind:lastPageIndex="lastPageIndex"
              v-bind:isFirstPage="isFirstPage"
              v-bind:isLastPage="isLastPage"
              v-bind:pageIndexes="pageIndexes"
              v-bind:paging="paging"
              v-bind:next="next"
              v-bind:prev="prev"
              v-bind:search="search">
        </slot>
        <slot name="footer-field"
              v-bind:result="result"
              v-bind:status="status"
              v-bind:errors="errors"
              v-bind:hasResults="hasResults"
              v-bind:searched="searched"
              v-bind:currentPageIndex="currentPageIndex"
              v-bind:lastPageIndex="lastPageIndex"
              v-bind:isFirstPage="isFirstPage"
              v-bind:isLastPage="isLastPage"
              v-bind:pageIndexes="pageIndexes"
              v-bind:paging="paging"
              v-bind:next="next"
              v-bind:prev="prev"
              v-bind:search="search">
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
            url: {
                type: String,
                required: true
            },
            initialSearch: {
                type: Boolean,
                default: false
            },
            initialPageIndex: {
                type: Number,
                default: 1
            },
            pageRange: {
                type: Number,
                default: 10
            },
            pageRequest: {
                type: String,
                default: 'pager[index]'
            },
            isPager: {
                type: Boolean,
                default: false
            },
        },
        mounted: function () {
            if (this.initialSearch) {
                this.setCondition();
                if (this.isPager) {
                    this.paging(this.initialPageIndex);
                } else {
                    this.showResult();
                }
            }
        },
        data: function () {
            return {
                cond: {},
                status: 0,
                errors: {},
                result: null,
                pager: {},
                searched: false
            }
        },
        computed: {
            hasResults: function () {
                var hasResult = false;
                if(this.pager){
                    hasResult = this.pager.allCount > 0;
                }
                return hasResult;
            },
            currentPageIndex: function () {
                return this.pager.index;
            },
            lastPageIndex: function () {
                return Math.ceil(this.pager.allCount / this.pager.limit);
            },
            isFirstPage: function () {
                return this.currentPageIndex === 1;
            },
            isLastPage: function () {
                return this.currentPageIndex === this.lastPageIndex;
            },
            pageIndexes: function () {
                var indexes = [];
                if (this.pageRange >= this.lastPageIndex) {
                    for (var index = 1; index <= this.lastPageIndex; index++) {
                        indexes.push(index);
                    }
                } else {
                    var leftRange = Math.floor(this.pageRange / 2);
                    var rightRange = Math.ceil(this.pageRange / 2);
                    if (leftRange < rightRange) {
                        rightRange--;
                    } else {
                        leftRange--;
                    }

                    var displayStartIndex = this.currentPageIndex - leftRange;
                    if (displayStartIndex <= 0) {
                        displayStartIndex = 1;
                        rightRange += leftRange - this.currentPageIndex + 1;
                    }
                    var displayEndIndex = this.currentPageIndex + rightRange;
                    if (displayEndIndex > this.lastPageIndex) {
                        displayStartIndex -= (displayEndIndex - this.lastPageIndex);
                        displayEndIndex = this.lastPageIndex;
                    }

                    if (this.pageRange < 5) {
                        for (var index = displayStartIndex; index <= displayEndIndex; index++) {
                            indexes.push(index);
                        }
                    } else {
                        if (displayStartIndex > 1 && displayStartIndex + 2 <= this.currentPageIndex) {
                            indexes.push(1);
                            indexes.push('...');
                            displayStartIndex += 2;
                            for (var index = displayStartIndex; index <= this.currentPageIndex; index++) {
                                indexes.push(index);
                            }
                        } else {
                            for (var index = 1; index <= this.currentPageIndex; index++) {
                                indexes.push(index);
                            }
                        }
                        if (this.lastPageIndex > displayEndIndex && displayEndIndex - 2 >= this.currentPageIndex) {
                            displayEndIndex -= 2;
                            for (var index = this.currentPageIndex + 1; index <= displayEndIndex; index++) {
                                indexes.push(index);
                            }
                            indexes.push('...');
                            indexes.push(this.lastPageIndex);
                        } else {
                            for (var index = this.currentPageIndex + 1; index <= this.lastPageIndex; index++) {
                                indexes.push(index);
                            }
                        }
                    }
                }
                return indexes;
            }
        },
        methods: {
            setCondition: function () {
                this.cond = {};
                var data = JSON.parse(JSON.stringify($("#" + this.id).serializeArray()));
                for (var index = 0; index < data.length; index++) {
                    this.cond[data[index].name] = data[index].value;
                }
            },
            search: function () {
                this.setCondition();
                if (this.isPager) {
                    this.paging(1);
                } else {
                    this.showResult();
                }
            },
            paging: function (paginationIndex) {
                var component = this;
                component.errors = {};
                this.cond[this.pageRequest] = paginationIndex;
                dispatcher.$emit(dispatcher.EVENT.SHOW_INDICATOR);
                axios.get(this.url, {params: this.cond}).then(function (response) {
                    dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
                    component.searched = true;
                    component.status = response.status;
                    component.result = response.data.result;
                    component.pager = response.data.pager;
                }).catch(function (error) {
                    component.status = error.response.status;
                    component.errors = error.response.data.errors;
                    dispatcher.$emit(dispatcher.EVENT.HANDLE_EXCEPTION, component.status, component.errors);
                    dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
                });
            },
            showResult: function () {
                var component = this;
                component.errors = {};
                dispatcher.$emit(dispatcher.EVENT.SHOW_INDICATOR);
                axios.get(this.url, {params: this.cond}).then(function (response) {
                    dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
                    component.searched = true;
                    component.status = response.status;
                    component.result = response.data.result;
                    if(response.data.pager){
                        component.pager = response.data.pager;
                    }
                }).catch(function (error) {
                    component.status = error.response.status;
                    component.errors = error.response.data.errors;
                    dispatcher.$emit(dispatcher.EVENT.HANDLE_EXCEPTION, component.status, component.errors);
                    dispatcher.$emit(dispatcher.EVENT.HIDE_INDICATOR);
                });
            },
            next: function () {
                this.paging(this.currentPageIndex + 1)
            },
            prev: function () {
                this.paging(this.currentPageIndex - 1)
            }
        }
    }
</script>
